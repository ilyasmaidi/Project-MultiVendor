<nav class="sticky top-0 z-50 bg-[#0a0a0a]/80 backdrop-blur-2xl border-b border-white/[0.03]">
    <div class="max-w-[1440px] mx-auto px-6 lg:px-12 h-20 flex items-center justify-between">
        
        {{-- Logo & Search --}}
        <div class="flex items-center gap-12">
            <a href="{{ route('home') }}" class="flex items-center group">
                <span class="font-international text-2xl font-[900] tracking-[-0.08em] text-white uppercase">
                    TRI<span class="text-emerald-500 group-hover:text-white transition-colors duration-500">CO</span>
                </span>
            </a>

            {{-- Search Bar --}}
            <form action="{{ route('ads.index') }}" method="GET" class="hidden xl:flex items-center bg-white/[0.03] border border-white/10 rounded-full px-4 py-2 w-80 group focus-within:w-96 focus-within:bg-white/5 transition-all duration-500">
                <i class="fa-solid fa-magnifying-glass text-xs text-zinc-500"></i>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="ابحث عن ماركة، قماش، أو بائع..." 
                       class="bg-transparent border-none focus:ring-0 text-[11px] text-white placeholder-zinc-600 w-full px-3 font-bold">
            </form>
        </div>

        {{-- Navigation Links --}}
        <div class="hidden lg:flex items-center gap-10">
            <a href="{{ route('ads.index') }}" 
               class="text-[10px] font-black uppercase tracking-[0.2em] {{ request()->routeIs('ads.index') && !request('category') ? 'text-emerald-500' : 'text-zinc-400 hover:text-emerald-500' }} transition-all relative group">
                اكتشف
                <span class="absolute -bottom-7 left-0 h-[2px] bg-emerald-500 transition-all duration-500 {{ request()->routeIs('ads.index') && !request('category') ? 'w-full' : 'w-0 group-hover:w-full' }}"></span>
            </a>
            
            <a href="{{ route('ads.index', ['category' => 'men']) }}" 
               class="text-[10px] font-black uppercase tracking-[0.2em] {{ request('category') == 'men' ? 'text-emerald-500' : 'text-zinc-400 hover:text-white' }} transition-all">
               الرجال
            </a>

            <a href="{{ route('ads.index', ['category' => 'women']) }}" 
               class="text-[10px] font-black uppercase tracking-[0.2em] {{ request('category') == 'women' ? 'text-emerald-500' : 'text-zinc-400 hover:text-white' }} transition-all">
               النساء
            </a>
        </div>

        {{-- Actions --}}
        <div class="flex items-center gap-6">
            {{-- تم حذف أيقونة المفضلة هنا لحل خطأ الـ RouteNotFound --}}

            @auth
                <div class="h-8 w-[1px] bg-white/10 mx-2"></div>
                <a href="{{ route('profile') }}" class="flex items-center gap-3 group">
                    <div class="text-right hidden sm:block">
                        <p class="text-[9px] font-black text-white uppercase tracking-tighter leading-none">{{ auth()->user()->name }}</p>
                        <p class="text-[8px] font-bold text-emerald-500 uppercase tracking-[0.1em] mt-1">حسابي</p>
                    </div>
                    <div class="w-9 h-9 rounded-full bg-zinc-800 border border-white/10 flex items-center justify-center group-hover:border-emerald-500 transition-all overflow-hidden">
                        @if(auth()->user()->avatar)
                            <img src="{{ asset('storage/' . auth()->user()->avatar) }}" class="w-full h-full object-cover">
                        @else
                            <i class="fa-solid fa-user-ninja text-xs text-zinc-500"></i>
                        @endif
                    </div>
                </a>
            @else
                <a href="{{ route('login') }}" class="text-[10px] font-black text-white uppercase tracking-widest hover:text-emerald-500 transition-all">دخول</a>
            @endauth

            <a href="{{ route('ads.create') }}" class="relative inline-flex items-center justify-center px-7 py-3 overflow-hidden font-black text-[10px] uppercase tracking-[0.2em] text-black bg-white rounded-full group">
                <span class="absolute inset-0 w-full h-full transition duration-300 ease-out opacity-0 bg-emerald-500 group-hover:opacity-100"></span>
                <span class="relative z-10 group-hover:text-black">بيع الآن</span>
            </a>
        </div>
    </div>
</nav>