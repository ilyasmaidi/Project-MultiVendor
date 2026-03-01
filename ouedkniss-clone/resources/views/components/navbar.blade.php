<nav class="sticky top-0 z-50 bg-[#0f1115]/90 backdrop-blur-xl border-b border-white/5">
    <div class="container mx-auto px-4 lg:px-8 h-20 flex items-center justify-between">
        
        <div class="flex items-center gap-4">
            <a href="{{ route('home') }}" class="flex items-center gap-2">
                <span class="font-international text-3xl font-black tracking-tighter text-white uppercase">TRI<span class="text-[#10b981]">CO</span></span>
            </a>
        </div>

        <div class="hidden lg:flex items-center gap-8">
            {{-- اكتشف الكل: يتفعل فقط إذا كنت في صفحة الإعلانات ولست داخل تصنيف --}}
            <a href="{{ route('ads.index') }}" 
               class="nav-link text-sm uppercase {{ (request()->routeIs('ads.index') && !request()->segment(2)) ? 'active' : '' }}">
               اكتشف الكل
            </a>

            {{-- الرجال: يتفعل فقط إذا كان السلوج هو men --}}
            <a href="{{ route('ads.by-category', 'men') }}" 
               class="nav-link text-sm uppercase {{ request()->is('category/men*') ? 'active' : '' }}">
               الرجال
            </a>

            {{-- النساء: تم حذف text-emerald-400 الثابت ليعمل التحديد فقط عند الضغط --}}
            <a href="{{ route('ads.by-category', 'women') }}" 
               class="nav-link text-sm uppercase {{ request()->is('category/women*') ? 'active' : '' }}">
               النساء
            </a>

            {{-- المتاجر العالمية --}}
            <a href="{{ route('stores.index') }}" 
               class="nav-link text-sm uppercase {{ request()->routeIs('stores.*') ? 'active' : '' }}">
               المتاجر العالمية
            </a>

            {{-- التصنيفات --}}
            <a href="{{ route('categories.index') }}" 
               class="nav-link text-sm uppercase {{ request()->routeIs('categories.*') ? 'active' : '' }}">
               التصنيفات
            </a>
        </div>

        <div class="flex items-center gap-5">
            {{-- Search Bar --}}
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
                {{-- Dashboard --}}
                <a href="{{ route('dashboard') }}" 
                   class="text-xl transition-colors {{ request()->routeIs('dashboard*') ? 'text-emerald-500' : 'hover:text-emerald-500' }}">
                    <i class="fa-solid fa-chart-line"></i>
                </a>
                
                @livewire('notification-bell')
                
                {{-- Profile --}}
                <a href="{{ route('profile') }}" 
                   class="text-xl transition-colors {{ request()->routeIs('profile*') ? 'text-emerald-500' : 'hover:text-emerald-500' }}">
                    <i class="fa-regular fa-user"></i>
                </a>
                
                {{-- Messages --}}
                <a href="{{ route('messages.index') }}" 
                   class="text-xl transition-colors relative {{ request()->routeIs('messages.*') ? 'text-emerald-500' : 'hover:text-emerald-500' }}">
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

            {{-- Mobile Toggle --}}
            <button class="lg:hidden text-2xl text-emerald-500" onclick="document.getElementById('mobileMenu').classList.toggle('hidden')">
                <i class="fa-solid fa-bars-staggered"></i>
            </button>
            
            {{-- CTA Button --}}
            <a href="{{ auth()->check() ? route('ads.create') : route('login') }}" 
               class="btn-premium px-6 py-2.5 rounded-full text-xs hidden sm:block">
               ابدأ البيع
            </a>
        </div>
    </div>
    
    <div id="mobileMenu" class="hidden lg:hidden bg-[#16181d] border-t border-white/5">
        <div class="container mx-auto px-4 py-4 space-y-2">
            <a href="{{ route('ads.index') }}" class="block py-3 px-4 rounded-lg font-bold {{ (request()->routeIs('ads.index') && !request()->segment(2)) ? 'bg-emerald-500/10 text-emerald-500' : 'hover:bg-white/5' }}">اكتشف الكل</a>
            <a href="{{ route('ads.by-category', 'men') }}" class="block py-3 px-4 rounded-lg font-bold {{ request()->is('category/men*') ? 'bg-emerald-500/10 text-emerald-500' : 'hover:bg-white/5' }}">الرجال</a>
            <a href="{{ route('ads.by-category', 'women') }}" class="block py-3 px-4 rounded-lg font-bold {{ request()->is('category/women*') ? 'bg-emerald-500/10 text-emerald-500' : 'hover:bg-white/5' }}">النساء</a>
            <a href="{{ route('stores.index') }}" class="block py-3 px-4 rounded-lg font-bold {{ request()->routeIs('stores.*') ? 'bg-emerald-500/10 text-emerald-500' : 'hover:bg-white/5' }}">المتاجر العالمية</a>
        </div>
    </div>
</nav>