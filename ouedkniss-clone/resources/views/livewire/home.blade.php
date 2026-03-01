<div>
    {{-- 1. الهيرو (Hero Section) --}}
    <section class="container mx-auto px-4 py-16 lg:py-24">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <div class="space-y-8">
                <span class="text-emerald-500 font-black tracking-[0.4em] text-xs block uppercase">إصدارات 2026</span>
                <h1 class="heavy-title text-7xl lg:text-9xl tracking-tighter">
                    أناقة <span class="text-emerald-500">بلا</span> <br> حدود.
                </h1>
                <p class="text-gray-400 text-xl max-w-md font-medium leading-relaxed">
                    اكتشف المجموعات الحصرية من الماركات العالمية والمحلية.
                </p>
                <div class="flex gap-6 pt-4">
                    <a href="{{ route('ads.index') }}" class="btn-premium px-12 py-5 text-sm">تسوق الآن</a>
                </div>
            </div>
            
            {{-- عرض الإعلانات المميزة (Featured Ads) من قاعدة البيانات --}}
            <div class="relative group">
                @if($featuredAds->isNotEmpty() && $featuredAds->first()->ad)
                    <img src="{{ asset('storage/' . ($featuredAds->first()->ad->primaryImage?->image_path ?? $featuredAds->first()->ad->images->first()?->image_path ?? 'placeholder.jpg')) }}" 
                         class="relative rounded-[2rem] grayscale hover:grayscale-0 transition-all duration-1000 border border-white/5 w-full object-cover aspect-[4/5]">
                @else
                    {{-- Placeholder/Skeleton for Hero Image --}}
                    <div class="relative rounded-[2rem] bg-white/5 border border-white/5 aspect-[4/5] flex items-center justify-center overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-tr from-emerald-500/10 to-transparent"></div>
                        <span class="text-white/20 font-heavy text-4xl uppercase tracking-widest z-10">Coming Soon</span>
                    </div>
                @endif
            </div>
        </div>
    </section>

    {{-- 2. أحدث الإعلانات (Recent Ads Section) --}}
    <section class="container mx-auto px-4 py-20">
        <h2 class="text-3xl font-black mb-12 uppercase tracking-tighter">وصل حديثاً <span class="text-emerald-500">.</span></h2>
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @forelse($recentAds as $ad)
                <div class="bg-white/5 border border-white/5 p-4 rounded-3xl hover:border-emerald-500/50 transition-all group">
                    <div class="h-72 overflow-hidden rounded-2xl mb-4 bg-zinc-800 relative">
                         @if($ad->primaryImage)
                            <img src="{{ asset('storage/' . $ad->primaryImage->image_path) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                         @else
                            <div class="w-full h-full flex items-center justify-center bg-zinc-900 text-zinc-700">
                                <i class="fa-solid fa-image text-4xl"></i>
                            </div>
                         @endif
                    </div>
                    <h3 class="font-bold text-lg mb-1 truncate">{{ $ad->title }}</h3>
                    <p class="text-emerald-500 font-black">{{ number_format($ad->price) }} د.ج</p>
                </div>
            @empty
                {{-- Skeleton Items (Empty State) --}}
                @for($i = 0; $i < 4; $i++)
                    <div class="bg-white/5 border border-white/5 p-4 rounded-3xl animate-pulse">
                        <div class="h-72 rounded-2xl mb-4 bg-white/10"></div>
                        <div class="h-6 w-3/4 bg-white/10 rounded mb-2"></div>
                        <div class="h-4 w-1/4 bg-emerald-500/20 rounded"></div>
                    </div>
                @endfor
            @endforelse
        </div>
    </section>

    {{-- 3. إحصائيات المنصة --}}
    @include('components.stats')
</div>