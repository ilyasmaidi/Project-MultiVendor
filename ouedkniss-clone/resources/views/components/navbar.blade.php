<nav class="sticky top-0 z-50 bg-[#0f1115]/90 backdrop-blur-xl border-b border-white/5">
    <div class="container mx-auto px-4 lg:px-8 h-20 flex items-center justify-between">
        
        <div class="flex items-center gap-4">
            <a href="{{ route('home') }}" class="flex items-center gap-2">
                <span class="font-international text-3xl font-black tracking-tighter text-white uppercase">TRI<span class="text-[#10b981]">CO</span></span>
            </a>
        </div>

        <div class="hidden lg:flex items-center gap-8">
            <a href="{{ route('ads.index') }}" class="nav-link text-sm uppercase {{ request()->routeIs('ads.index') ? 'active' : '' }}">اكتشف الكل</a>
            <a href="{{ route('ads.by-category', 'men') }}" class="nav-link text-sm uppercase">الرجال</a>
            <a href="{{ route('ads.by-category', 'women') }}" class="nav-link text-sm uppercase text-emerald-400">النساء</a>
            <a href="{{ route('stores.index') }}" class="nav-link text-sm uppercase {{ request()->routeIs('stores.*') ? 'active' : '' }}">المتاجر العالمية</a>
            <a href="{{ route('categories.index') }}" class="nav-link text-sm uppercase {{ request()->routeIs('categories.*') ? 'active' : '' }}">التصنيفات</a>
        </div>

        <div class="flex items-center gap-5">
            <div class="relative hidden sm:block">
                <form action="{{ route('search') }}" method="GET">
                    <input type="text" name="q" placeholder="ابحث عن ماركة..." value="{{ request('q') }}"
                        class="bg-white/5 border border-white/10 px-4 py-2 rounded-full text-xs w-64 focus:border-emerald-500 outline-none transition-all text-white">
                    <button type="submit" class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-emerald-400">
                        <i class="fa-solid fa-search"></i>
                    </button>
                </form>
            </div>
            
            @auth
                <a href="{{ route('dashboard') }}" class="text-xl hover:text-emerald-500 transition-colors" title="لوحة التحكم">
                    <i class="fa-solid fa-chart-line"></i>
                </a>
                
                @livewire('notification-bell')
                
                <a href="{{ route('profile') }}" class="text-xl hover:text-emerald-500 transition-colors">
                    <i class="fa-regular fa-user"></i>
                </a>
                
                <a href="{{ route('messages.index') }}" class="text-xl hover:text-emerald-500 transition-colors relative" title="الرسائل">
                    <i class="fa-regular fa-envelope"></i>
                    @php
                        $unreadCount = auth()->user()->messages()->whereNull('read_at')->count();
                    @endphp
                    @if($unreadCount > 0)
                        <span class="absolute -top-1 -right-1 w-4 h-4 bg-rose-500 rounded-full text-[10px] flex items-center justify-center">{{ $unreadCount }}</span>
                    @endif
                </a>
            @else
                <a href="{{ route('login') }}" class="text-sm font-bold hover:text-emerald-400 transition-colors uppercase tracking-widest">دخول</a>
            @endauth

            <button class="lg:hidden text-2xl text-emerald-500" onclick="document.getElementById('mobileMenu').classList.toggle('hidden')">
                <i class="fa-solid fa-bars-staggered"></i>
            </button>
            
            @auth
                <a href="{{ route('ads.create') }}" class="btn-premium px-6 py-2.5 rounded-full text-xs hidden sm:block">ابدأ البيع</a>
            @else
                <a href="{{ route('login') }}" class="btn-premium px-6 py-2.5 rounded-full text-xs hidden sm:block">ابدأ البيع</a>
            @endauth
        </div>
    </div>
    
    <!-- Mobile Menu -->
    <div id="mobileMenu" class="hidden lg:hidden bg-[#16181d] border-t border-white/5">
        <div class="container mx-auto px-4 py-4 space-y-2">
            <a href="{{ route('ads.index') }}" class="block py-3 px-4 hover:bg-white/5 rounded-lg font-bold">اكتشف الكل</a>
            <a href="{{ route('stores.index') }}" class="block py-3 px-4 hover:bg-white/5 rounded-lg font-bold">المتاجر العالمية</a>
            <a href="{{ route('categories.index') }}" class="block py-3 px-4 hover:bg-white/5 rounded-lg font-bold">التصنيفات</a>
            
            @auth
                <hr class="border-white/10 my-4">
                <a href="{{ route('dashboard') }}" class="block py-3 px-4 hover:bg-white/5 rounded-lg font-bold">لوحة التحكم</a>
                <a href="{{ route('my-ads') }}" class="block py-3 px-4 hover:bg-white/5 rounded-lg font-bold">إعلاناتي</a>
                <a href="{{ route('messages.index') }}" class="block py-3 px-4 hover:bg-white/5 rounded-lg font-bold">الرسائل</a>
                <a href="{{ route('favorites.index') }}" class="block py-3 px-4 hover:bg-white/5 rounded-lg font-bold">المفضلة</a>
            @endauth
        </div>
    </div>
</nav>
