<div class="min-h-screen flex items-center justify-center bg-white dark:bg-[#0a0a0a] py-12 px-4">
    <div class="max-w-md w-full bg-zinc-50 dark:bg-white/[0.02] border border-zinc-200 dark:border-white/10 p-10 rounded-[2.5rem] shadow-2xl text-center">
        
        <h2 class="text-2xl font-black text-zinc-900 dark:text-white uppercase italic mb-10 tracking-tighter">مرحباً بك في <span class="text-emerald-500">TRICO</span></h2>

        <form wire:submit.prevent="authenticate" class="space-y-6">
            <div class="space-y-1 text-right">
                <label class="text-[10px] font-black text-zinc-400 uppercase mr-2 tracking-widest">الهاتف أو البريد الإلكتروني</label>
                <input wire:model="login" type="text" placeholder="05XXXXXXXX / email@trico.dz" class="w-full bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-white/5 py-4 px-6 rounded-2xl text-sm dark:text-white outline-none focus:border-emerald-500 transition-all shadow-inner text-right">
            </div>

            <div class="space-y-1 text-right">
                <label class="text-[10px] font-black text-zinc-400 uppercase mr-2 tracking-widest">كلمة المرور</label>
                <input wire:model="password" type="password" placeholder="••••••••" class="w-full bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-white/5 py-4 px-6 rounded-2xl text-sm dark:text-white outline-none focus:border-emerald-500 transition-all shadow-inner text-right">
            </div>

            <button type="submit" class="w-full bg-zinc-900 dark:bg-white text-white dark:text-black py-5 rounded-2xl font-black text-[11px] uppercase tracking-[0.3em] hover:scale-[1.02] active:scale-95 transition-all shadow-xl">دخول آمن</button>
        </form>

        <p class="mt-8 text-[10px] font-bold text-zinc-500 uppercase tracking-widest">ليس لديك حساب؟ <a href="{{ route('register') }}" class="text-emerald-600">سجل الآن</a></p>
    </div>
</div>