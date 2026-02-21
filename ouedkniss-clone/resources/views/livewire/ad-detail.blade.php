<div class="max-w-7xl mx-auto px-4 py-12 lg:px-8 bg-gradient-subtle min-h-screen text-right" dir="rtl">
    {{-- Breadcrumbs - مسار التنقل --}}
    <nav class="mb-8 flex items-center gap-2 text-xs font-bold text-gray-500 uppercase tracking-widest">
        <a href="/" class="hover:text-emerald-500 transition-colors">الرئيسية</a>
        <i class="fa-solid fa-chevron-left text-[8px]"></i>
        <a href="#" class="hover:text-emerald-500 transition-colors">{{ $ad->category->name ?? 'الأزياء' }}</a>
        <i class="fa-solid fa-chevron-left text-[8px]"></i>
        <span class="text-emerald-500">{{ $ad->title }}</span>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-16">
        
        {{-- القسم الأيمن: معرض الصور الفاخر --}}
        <div class="lg:col-span-7 space-y-4">
            <div class="relative group overflow-hidden rounded-3xl bg-zinc-900 border border-white/5 shadow-2xl">
                {{-- شارة الحالة --}}
                <div class="absolute top-6 right-6 z-10">
                    <span class="bg-emerald-500 text-black px-4 py-1.5 text-xs font-black uppercase rounded-full shadow-lg">إصدار حصري</span>
                </div>
                
                <img src="{{ $ad->image_url }}" alt="{{ $ad->title }}" 
                     class="w-full aspect-[4/5] object-cover transition-transform duration-1000 group-hover:scale-110">
                
                {{-- تكبير الصورة --}}
                <button class="absolute bottom-6 left-6 w-12 h-12 bg-black/50 backdrop-blur-md rounded-full flex items-center justify-center text-white hover:bg-emerald-500 hover:text-black transition-all">
                    <i class="fa-solid fa-expand"></i>
                </button>
            </div>

            {{-- الصور المصغرة --}}
            <div class="grid grid-cols-4 gap-4">
                @foreach($ad->gallery as $img)
                <div class="aspect-square rounded-2xl overflow-hidden border-2 border-transparent hover:border-emerald-500 transition-all cursor-pointer bg-zinc-900">
                    <img src="{{ $img->url }}" class="w-full h-full object-cover opacity-70 hover:opacity-100 transition-opacity">
                </div>
                @endforeach
            </div>
        </div>

        {{-- القسم الأيسر: تفاصيل المنتج --}}
        <div class="lg:col-span-5 flex flex-col">
            {{-- معلومات المتجر العلوي --}}
            <div class="flex items-center justify-between mb-8 pb-8 border-b border-white/5">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-full bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-center text-emerald-500 font-black">
                        {{ substr($ad->user->store_name ?? $ad->user->name, 0, 1) }}
                    </div>
                    <div>
                        <h4 class="font-bold text-sm text-white">{{ $ad->user->store_name ?? $ad->user->name }}</h4>
                        <div class="flex items-center gap-1 text-[10px] text-emerald-500">
                            <i class="fa-solid fa-circle-check"></i>
                            <span class="font-bold uppercase tracking-tighter">متجر موثوق</span>
                        </div>
                    </div>
                </div>
                <button wire:click="followStore" class="text-xs font-bold text-gray-400 hover:text-white transition-colors underline decoration-emerald-500 underline-offset-8">متابعة المتجر</button>
            </div>

            {{-- اسم المنتج والسعر --}}
            <div class="mb-8">
                <h1 class="text-5xl font-black text-white leading-tight mb-4 tracking-tighter">{{ $ad->title }}</h1>
                <div class="flex items-center gap-4">
                    <span class="text-3xl font-black text-emerald-500 font-international">{{ number_format($ad->price) }} د.ج</span>
                    @if($ad->old_price)
                    <span class="text-xl text-gray-600 line-through font-bold">{{ number_format($ad->old_price) }} د.ج</span>
                    @endif
                </div>
            </div>

            {{-- الوصف التقني --}}
            <div class="space-y-6 mb-10">
                <div class="flex items-center gap-3">
                    <span class="text-xs font-black text-gray-500 uppercase tracking-widest">التوافر:</span>
                    <span class="text-xs font-bold text-white">متوفر في المخزن (قطع محدودة)</span>
                </div>
                
                <p class="text-gray-400 leading-relaxed font-medium">
                    {{ $ad->description }}
                </p>
            </div>

            {{-- الخيارات (المقاسات مثلاً) --}}
            <div class="mb-10">
                <h3 class="text-xs font-black text-white uppercase tracking-widest mb-4">اختر المقاس</h3>
                <div class="flex flex-wrap gap-3">
                    @foreach(['S', 'M', 'L', 'XL'] as $size)
                    <button class="w-14 h-14 rounded-xl border border-white/10 flex items-center justify-center font-bold hover:border-emerald-500 hover:text-emerald-500 transition-all">
                        {{ $size }}
                    </button>
                    @endforeach
                </div>
            </div>

            {{-- أزرار الأكشن النهائية --}}
            <div class="flex flex-col gap-4 mt-auto">
                <div class="grid grid-cols-5 gap-4">
                    <button wire:click="addToCart" class="col-span-4 bg-emerald-500 text-black py-5 rounded-2xl font-black text-sm uppercase tracking-widest hover:bg-white transition-all shadow-2xl shadow-emerald-500/10">
                        إضافة إلى الحقيبة الدولية
                    </button>
                    <button wire:click="toggleFavorite" class="col-span-1 border border-white/10 rounded-2xl flex items-center justify-center text-xl hover:bg-white hover:text-black transition-all">
                        <i class="fa-{{ $isFavorite ? 'solid text-emerald-500' : 'regular' }} fa-heart"></i>
                    </button>
                </div>
                
                <button wire:click="chatNow" class="w-full bg-zinc-900 border border-white/5 text-white py-5 rounded-2xl font-black text-sm uppercase tracking-widest hover:border-emerald-500/50 transition-all">
                    تواصل فوراً مع البائع
                </button>
            </div>

            {{-- مميزات إضافية --}}
            <div class="grid grid-cols-2 gap-4 mt-12 pt-12 border-t border-white/5">
                <div class="flex items-center gap-3">
                    <i class="fa-solid fa-truck-fast text-emerald-500 text-xl"></i>
                    <span class="text-[10px] font-bold text-gray-500 uppercase tracking-tighter">شحن دولي سريع</span>
                </div>
                <div class="flex items-center gap-3">
                    <i class="fa-solid fa-shield-halved text-emerald-500 text-xl"></i>
                    <span class="text-[10px] font-bold text-gray-500 uppercase tracking-tighter">ضمان الجودة TRICO</span>
                </div>
            </div>
        </div>
    </div>

    {{-- قسم المنتجات المشابهة --}}
    <section class="mt-32">
        <h2 class="text-3xl font-black mb-12 tracking-tighter">قد يعجبك <span class="text-emerald-500">أيضاً</span></h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
            {{-- هنا نضع مكوّن عرض المنتجات المصغر --}}
            @foreach($similarAds as $similar)
                <livewire:ad-card :ad="$similar" :key="$similar->id" />
            @endforeach
        </div>
    </section>

    <style>
        .font-international { font-family: 'Montserrat', sans-serif; }
        .text-shadow-sm { text-shadow: 0 2px 4px rgba(0,0,0,0.3); }
        
        /* تأثير النعومة عند التحميل */
        [wire:loading] {
            opacity: 0.7;
            pointer-events: none;
        }
    </style>
</div>