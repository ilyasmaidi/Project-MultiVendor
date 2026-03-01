<nav class="sticky top-0 z-50 bg-[#0f1115]/90 backdrop-blur-xl border-b border-white/5">
    <div class="container mx-auto px-4 lg:px-8 h-20 flex items-center justify-between">
        <div class="flex items-center gap-4">
            <a href="{{ route('home') }}" class="flex items-center gap-2">
                <span class="font-international text-3xl font-black tracking-tighter text-white uppercase">TRI<span class="text-[#10b981]">CO</span></span>
            </a>
        </div>
        <div class="hidden lg:flex items-center gap-8">
            <a href="{{ route('ads.index') }}" class="nav-link text-sm uppercase">اكتشف الكل</a>
            <a href="{{ route('ads.by-category', 'men') }}" class="nav-link text-sm uppercase">الرجال</a>
            <a href="{{ route('ads.by-category', 'women') }}" class="nav-link text-sm uppercase text-emerald-400">النساء</a>
            <a href="{{ route('stores.index') }}" class="nav-link text-sm uppercase">المتاجر العالمية</a>
        </div>
        <div class="flex items-center gap-5">
            @auth
                <a href="{{ route('profile') }}" class="text-xl hover:text-emerald-500"><i class="fa-regular fa-user"></i></a>
            @else
                <a href="{{ route('login') }}" class="text-sm font-bold hover:text-emerald-400 uppercase">دخول</a>
            @endauth
            <a href="{{ route('ads.create') }}" class="btn-premium px-6 py-2.5 rounded-full text-xs hidden sm:block">ابدأ البيع</a>
        </div>
    </div>
</nav>