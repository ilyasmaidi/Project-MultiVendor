<nav class="sticky top-0 z-50 bg-[#0a0a0a]/80 backdrop-blur-2xl border-b border-white/[0.03]">
    <div class="max-w-[1440px] mx-auto px-6 lg:px-12 h-20 flex items-center justify-between">
        
        <div class="flex items-center gap-12">
            <a href="{{ route('home') }}" class="flex items-center group">
                <span class="font-international text-2xl font-[900] tracking-[-0.08em] text-white uppercase">
                    TRI<span class="text-emerald-500 group-hover:text-white transition-colors duration-500">CO</span>
                </span>
            </a>

            <div class="hidden xl:flex items-center bg-white/[0.03] border border-white/10 rounded-full px-4 py-2 w-80 group focus-within:w-96 focus-within:bg-white/5 transition-all duration-500">
                <i class="fa-solid fa-magnifying-glass text-xs text-zinc-500"></i>
                <input type="text" placeholder="ابحث عن ماركة، قماش، أو بائع..." 
                       class="bg-transparent border-none focus:ring-0 text-[11px] text-white placeholder-zinc-600 w-full px-3 font-bold">
                <span class="text-[9px] text-zinc-700 border border-white/10 px-1.5 py-0.5 rounded-md font-black">CMD+K</span>
            </div>
        </div>

        <div class="hidden lg:flex items-center gap-10">
            <a href="{{ route('ads.index') }}" class="text-[10px] font-black uppercase tracking-[0.2em] text-zinc-400 hover:text-emerald-500 transition-all relative group">
                اكتشف
                <span class="absolute -bottom-7 left-0 w-0 h-[2px] bg-emerald-500 transition-all duration-500 group-hover:w-full"></span>
            </a>
            <a href="{{ route('ads.by-category', 'men') }}" class="text-[10px] font-black uppercase tracking-[0.2em] text-zinc-400 hover:text-white transition-all">الرجال</a>
            <a href="{{ route('ads.by-category', 'women') }}" class="text-[10px] font-black uppercase tracking-[0.2em] text-emerald-500 transition-all">النساء</a>
            <a href="{{ route('stores.index') }}" class="text-[10px] font-black uppercase tracking-[0.2em] text-zinc-400 hover:text-white transition-all">المجموعات المختارة</a>
        </div>

        <div class="flex items-center gap-6">
            <a href="#" class="relative text-zinc-400 hover:text-white transition-colors">
                <i class="fa-light fa-heart text-lg"></i>
                <span class="absolute -top-1 -right-1 w-2 h-2 bg-emerald-500 rounded-full"></span>
            </a>

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
                <span class="relative group-hover:text-black">بيع الآن</span>
            </a>
        </div>
    </div>
</nav>