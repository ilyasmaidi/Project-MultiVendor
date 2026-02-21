<div class="bg-white">
    <div class="relative min-h-[80vh] flex items-center overflow-hidden bg-trico-dark">
        <div class="absolute inset-0 opacity-20">
            <div class="absolute top-0 -left-20 w-96 h-96 bg-trico-primary rounded-full blur-[120px]"></div>
            <div class="absolute bottom-0 -right-20 w-96 h-96 bg-trico-primary rounded-full blur-[120px]"></div>
        </div>

        <div class="container mx-auto px-4 lg:px-10 relative z-10">
            <div class="max-w-4xl mx-auto text-center">
                <span class="inline-block py-1 px-4 rounded-full bg-trico-primary/10 text-trico-primary text-[10px] font-black uppercase tracking-[0.3em] mb-6 animate-fade-in">
                    صناعة الأناقة الرجالية
                </span>
                <h1 class="logo-font text-5xl md:text-7xl text-white mb-8 leading-tight">
                    {{ \App\Models\Setting::get('hero_title', 'أعد تعريف مظهرك الخاص') }}
                </h1>
                <p class="text-gray-400 text-lg md:text-xl mb-12 max-w-2xl mx-auto font-light leading-relaxed">
                    {{ \App\Models\Setting::get('hero_subtitle', 'اكتشف مجموعات حصرية من الملابس الرجالية من أرقى المتاجر والمصممين المبدعين.') }}
                </p>
                
                <div class="max-w-2xl mx-auto bg-white/10 backdrop-blur-md p-2 rounded-[2.5rem] border border-white/10 shadow-2xl">
                    <livewire:ad-search />
                </div>
                
                <div class="mt-8 flex justify-center gap-6 text-gray-500 text-xs font-bold uppercase tracking-widest">
                    <span>#Trico_Style</span>
                    <span class="text-trico-primary">•</span>
                    <span>#Luxury_Men</span>
                    <span class="text-trico-primary">•</span>
                    <span>#Algerian_Fashion</span>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-trico-lightGreen/50 py-8 border-b border-trico-lightGreen">
        <div class="container mx-auto px-4 lg:px-10">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div>
                    <p class="text-2xl font-black text-trico-dark">+500</p>
                    <p class="text-[10px] text-gray-400 uppercase tracking-tighter">متجر معتمد</p>
                </div>
                <div>
                    <p class="text-2xl font-black text-trico-dark">24/7</p>
                    <p class="text-[10px] text-gray-400 uppercase tracking-tighter">دعم فني متخصص</p>
                </div>
                <div>
                    <p class="text-2xl font-black text-trico-dark">100%</p>
                    <p class="text-[10px] text-gray-400 uppercase tracking-tighter">ضمان الجودة</p>
                </div>
                <div>
                    <p class="text-2xl font-black text-trico-dark">أصلي</p>
                    <p class="text-[10px] text-gray-400 uppercase tracking-tighter">ماركات عالمية</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 py-24 lg:px-10">
        <div class="text-center mb-16">
            <h2 class="text-xs font-black text-trico-primary uppercase tracking-[0.4em] mb-4">التصنيفات</h2>
            <p class="logo-font text-4xl text-trico-dark">تسوق حسب النوع</p>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
            @foreach($categories as $category)
                <a href="{{ route('ads.by-category', $category->slug) }}"
                   class="group bg-trico-surface rounded-[2rem] p-8 text-center transition-all duration-500 hover:bg-trico-primary border border-transparent hover:border-trico-primary shadow-sm hover:shadow-2xl hover:shadow-trico-primary/30">
                    <div class="mb-4 inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-white text-trico-primary group-hover:scale-110 group-hover:bg-white transition-all duration-500">
                        @if($category->icon)
                            <i class="{{ $category->icon }} text-2xl"></i>
                        @else
                            <i class="fas fa-tshirt text-2xl"></i>
                        @endif
                    </div>
                    <h3 class="font-bold text-trico-dark group-hover:text-white transition-colors duration-500 tracking-tight">{{ $category->name }}</h3>
                    <p class="text-[10px] text-gray-400 group-hover:text-trico-lightGreen mt-2 uppercase">{{ $category->ads_count ?? '120+' }} قطعة</p>
                </a>
            @endforeach
        </div>
    </div>

    @if($featuredAds->count() > 0)
    <div class="bg-trico-dark py-24 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-1/2 h-full bg-trico-primary/5 -skew-x-12"></div>
        
        <div class="container mx-auto px-4 lg:px-10 relative z-10">
            <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-4">
                <div>
                    <h2 class="text-xs font-black text-trico-primary uppercase tracking-[0.4em] mb-4">اختيارات المحرر</h2>
                    <p class="logo-font text-4xl text-white">قطع مميزة لا تفوتك</p>
                </div>
                <a href="#" class="text-white text-sm font-bold border-b-2 border-trico-primary pb-1 hover:text-trico-primary transition-colors">مشاهدة الكل</a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($featuredAds as $featuredAd)
                    @php $ad = $featuredAd->ad; @endphp
                    @if($ad)
                        <div class="group">
                            <div class="relative aspect-[3/4] rounded-[2.5rem] overflow-hidden bg-gray-800 mb-6">
                                <img src="{{ asset('storage/' . $ad->images->first()->image_path) }}" 
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 opacity-90 group-hover:opacity-100">
                                
                                <div class="absolute top-6 left-6 flex flex-col gap-2">
                                    <span class="bg-trico-primary text-white text-[10px] font-black px-4 py-1.5 rounded-full shadow-2xl">مميز</span>
                                </div>
                                
                                <a href="{{ route('ads.show', $ad->slug) }}" class="absolute inset-0 flex items-center justify-center bg-trico-dark/40 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <span class="bg-white text-trico-dark px-6 py-3 rounded-2xl font-bold text-sm">عرض التفاصيل</span>
                                </a>
                            </div>
                            <h3 class="text-white font-bold text-lg mb-2 truncate">{{ $ad->title }}</h3>
                            <p class="text-trico-primary font-black text-xl">{{ number_format($ad->price, 0) }} <span class="text-xs">د.ج</span></p>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    @endif

    <div class="container mx-auto px-4 py-24 lg:px-10">
        <div class="flex items-center justify-between mb-16 border-b border-gray-100 pb-8">
            <h2 class="logo-font text-4xl text-trico-dark">وصل حديثاً</h2>
            <div class="flex gap-2">
                <div class="w-12 h-[1px] bg-trico-primary"></div>
                <div class="w-4 h-[1px] bg-gray-300"></div>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10">
            @foreach($recentAds as $ad)
                <div class="group cursor-pointer">
                    <div class="relative aspect-square rounded-[2rem] overflow-hidden bg-trico-surface mb-6 border border-gray-50 group-hover:border-trico-primary/20 transition-all">
                        @if($ad->images->count() > 0)
                            <img src="{{ asset('storage/' . $ad->images->first()->image_path) }}" 
                                 class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-gray-50"><i class="fas fa-image text-gray-200 text-4xl"></i></div>
                        @endif
                        
                        <div class="absolute bottom-4 right-4 bg-white/90 backdrop-blur px-4 py-2 rounded-xl shadow-sm">
                            <span class="text-trico-dark font-black text-sm">{{ number_format($ad->price, 0) }} د.ج</span>
                        </div>
                    </div>
                    
                    <div class="px-2">
                        <div class="flex items-center justify-between text-[10px] font-black text-trico-primary uppercase tracking-widest mb-2">
                            <span>{{ $ad->category->name ?? 'Casual' }}</span>
                            <span class="text-gray-300">{{ $ad->created_at->diffForHumans() }}</span>
                        </div>
                        <h3 class="font-bold text-trico-dark text-md truncate mb-4">{{ $ad->title }}</h3>
                        <a href="{{ route('ads.show', $ad->slug) }}" class="inline-flex items-center text-xs font-bold text-gray-400 group-hover:text-trico-primary transition-colors">
                            التفاصيل <i class="fas fa-arrow-left mr-2 group-hover:mr-4 transition-all"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-center mt-20">
            <a href="{{ route('ads.index') }}" class="inline-flex items-center gap-4 bg-trico-dark text-white px-12 py-5 rounded-full hover:bg-trico-primary transition-all duration-500 shadow-2xl shadow-trico-dark/20 group">
                <span class="text-sm font-black uppercase tracking-widest">استكشف المتجر بالكامل</span>
                <div class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center group-hover:bg-white group-hover:text-trico-dark transition-all">
                    <i class="fas fa-chevron-left text-xs"></i>
                </div>
            </a>
        </div>
    </div>
</div>