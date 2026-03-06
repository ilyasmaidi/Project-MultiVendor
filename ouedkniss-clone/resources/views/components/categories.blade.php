@php
    // مصفوفة الصور العالمية - تأكد أن المفاتيح (Keys) تطابق الـ Slugs في الـ Seeder تماماً
    $categoryImages = [
        'women'       => 'https://images.unsplash.com/photo-1581044777550-4cfa60707c03?q=80&w=1000&auto=format&fit=crop',
        'men'         => 'https://www.wearecasual.com/46993-large_default/slim-fit-t-shirt-men.jpg',
        'kids'        => 'https://pteam.b-cdn.net/wp-content/uploads/2022/10/F1-3-scaled.jpg-1.webp',
        'collections' => 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?q=80&w=1000&auto=format&fit=crop',
    ];

    // جلب الأقسام الرئيسية فقط التي ليس لها أب (Parent) من قاعدة البيانات
    $mainCategories = \App\Models\Category::whereNull('parent_id')->take(4)->get();
@endphp

<section class="container mx-auto px-4 py-24 relative overflow-hidden">
    {{-- العنوان --}}
    <div class="flex flex-col mb-16 space-y-2 text-right">
        <span class="text-brand font-black tracking-[0.4em] text-[10px] uppercase block">Explore TRICO</span>
        <h2 class="text-4xl md:text-6xl font-black tracking-tighter text-zinc-900 dark:text-white uppercase leading-none">
            تسوق حسب <span class="text-brand">الفئة.</span>
        </h2>
    </div>

    {{-- شبكة التصنيفات --}}
    <div class="grid grid-cols-1 md:grid-cols-4 md:grid-rows-2 gap-6 h-auto md:h-[750px]">
        @foreach($mainCategories as $index => $category)
            @php
                // جلب الصورة بناءً على الـ slug من المصفوفة أعلاه
                $image = $categoryImages[$category->slug] ?? 'https://via.placeholder.com/800';
                
                // تحديد شكل الكارد في الشبكة (Bento Style)
                $isLarge = $index === 0; // أول عنصر (نسائي) كبير
                $isWide = $index === 1;  // ثاني عنصر (رجالي) عريض
                $gridClass = $isLarge ? 'md:col-span-2 md:row-span-2' : ($isWide ? 'md:col-span-2 md:row-span-1' : 'md:col-span-1 md:row-span-1');
            @endphp

            <a href="{{ route('ads.index', ['category' => $category->slug]) }}" 
               class="{{ $gridClass }} group relative overflow-hidden rounded-[3.5rem] bg-zinc-100 dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 shadow-sm transition-all duration-700">
                
                {{-- الصورة --}}
                <img src="{{ $image }}" 
                     alt="{{ $category->name }}"
                     class="w-full h-full object-cover transition-transform duration-[1.5s] ease-out group-hover:scale-110">
                
                {{-- الطبقة الشفافة والنصوص --}}
                <div class="absolute inset-0 bg-gradient-to-t from-zinc-950/90 via-zinc-950/20 to-transparent flex flex-col justify-end p-8 md:p-10 text-right">
                    <div class="transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                        <h3 class="{{ $isLarge ? 'text-4xl md:text-5xl' : 'text-2xl md:text-3xl' }} text-white font-black uppercase tracking-tighter mb-4">
                            {{ $category->name }}
                        </h3>
                        
                        @if($isLarge)
                            <div class="inline-flex w-14 h-14 rounded-full bg-white/10 backdrop-blur-xl border border-white/20 items-center justify-center text-white group-hover:bg-brand group-hover:text-black group-hover:border-brand transition-all duration-500">
                                <i class="fa-solid fa-arrow-left-long text-xl"></i>
                            </div>
                        @endif
                    </div>
                </div>
            </a>
        @endforeach
    </div>
</section>