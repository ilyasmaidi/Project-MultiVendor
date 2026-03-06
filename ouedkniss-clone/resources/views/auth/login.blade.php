@extends('layouts.app')

@section('title', 'تسجيل الدخول | TRICO')

@section('content')
<div class="min-h-[calc(100vh-200px)] flex items-center justify-center py-16 px-4 bg-white dark:bg-[#0a0a0a] transition-colors duration-500">
    <div class="max-w-md w-full">
        {{-- Card Container --}}
        <div class="bg-zinc-50 dark:bg-white/[0.03] border border-zinc-200 dark:border-white/10 p-10 rounded-[2.5rem] shadow-xl backdrop-blur-sm">
            
            {{-- Header --}}
            <div class="text-center mb-10">
                <a href="{{ route('home') }}" class="inline-block mb-6 group">
                    <span class="font-international text-4xl font-[900] tracking-[-0.08em] text-zinc-900 dark:text-white uppercase transition-colors">
                        TRI<span class="text-emerald-500 group-hover:text-emerald-400">CO</span>
                    </span>
                </a>
                <h2 class="text-2xl font-black text-zinc-900 dark:text-white tracking-tight uppercase italic text-right">تسجيل الدخول</h2>
                <p class="mt-3 text-xs font-bold text-zinc-500 dark:text-zinc-400 uppercase tracking-widest text-right">
                    أو 
                    <a href="{{ route('register') }}" class="text-emerald-500 hover:text-emerald-400 transition-colors border-b border-emerald-500/30">
                        إنشاء حساب جديد
                    </a>
                </p>
            </div>
            
            <form class="space-y-6" action="{{ route('login') }}" method="POST">
                @csrf
                
                {{-- Email Input --}}
                <div class="space-y-2">
                    <label for="email" class="block text-[10px] font-black uppercase tracking-[0.2em] text-zinc-500 dark:text-zinc-400 mr-2 text-right">
                        البريد الإلكتروني
                    </label>
                    <input id="email" name="email" type="email" required
                           class="w-full bg-white dark:bg-[#121212] border border-zinc-200 dark:border-white/5 px-5 py-4 rounded-2xl text-sm text-zinc-900 dark:text-zinc-100 placeholder-zinc-400 dark:placeholder-zinc-700 outline-none focus:border-emerald-500/50 focus:ring-1 focus:ring-emerald-500/20 transition-all shadow-sm text-right font-bold"
                           placeholder="your@email.com" value="{{ old('email') }}">
                    @error('email')
                        <p class="text-rose-500 text-[10px] font-bold mt-1 px-2 text-right">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password Input --}}
                <div class="space-y-2">
                    <div class="flex justify-between items-center px-2">
                         <a href="#" class="text-[9px] font-bold text-zinc-400 hover:text-emerald-500 uppercase tracking-tighter transition-colors">نسيت كلمة المرور؟</a>
                         <label for="password" class="block text-[10px] font-black uppercase tracking-[0.2em] text-zinc-500 dark:text-zinc-400 text-right">
                            كلمة المرور
                        </label>
                    </div>
                    <input id="password" name="password" type="password" required
                           class="w-full bg-white dark:bg-[#121212] border border-zinc-200 dark:border-white/5 px-5 py-4 rounded-2xl text-sm text-zinc-900 dark:text-zinc-100 placeholder-zinc-400 dark:placeholder-zinc-700 outline-none focus:border-emerald-500/50 focus:ring-1 focus:ring-emerald-500/20 transition-all shadow-sm text-right font-bold"
                           placeholder="••••••••">
                </div>

                {{-- Remember Me --}}
                <div class="flex items-center justify-end px-2">
                    <label class="flex items-center gap-3 cursor-pointer group">
                        <span class="text-[11px] font-bold text-zinc-500 dark:text-zinc-400 group-hover:text-zinc-700 dark:group-hover:text-zinc-200 transition-colors">تذكرني</span>
                        <div class="relative">
                            <input type="checkbox" name="remember" class="peer hidden">
                            <div class="w-5 h-5 border-2 border-zinc-200 dark:border-white/10 rounded-md bg-white dark:bg-zinc-900 peer-checked:bg-emerald-500 peer-checked:border-emerald-500 transition-all flex items-center justify-center">
                                <i class="fa-solid fa-check text-[10px] text-white opacity-0 peer-checked:opacity-100 transition-opacity"></i>
                            </div>
                        </div>
                    </label>
                </div>

                {{-- Submit Button --}}
                <button type="submit" class="relative w-full group overflow-hidden bg-zinc-900 dark:bg-white text-white dark:text-black py-5 rounded-2xl font-black text-xs uppercase tracking-[0.3em] transition-all hover:scale-[1.02] active:scale-[0.98]">
                    <span class="absolute inset-0 w-full h-full bg-emerald-500 transition-transform duration-500 translate-y-full group-hover:translate-y-0"></span>
                    <span class="relative z-10 group-hover:text-black transition-colors duration-500">دخول</span>
                </button>
            </form>

            {{-- Demo Accounts --}}
            <div class="mt-10 pt-8 border-t border-zinc-200 dark:border-white/5">
                <div class="bg-emerald-500/5 dark:bg-emerald-500/5 rounded-2xl p-4 border border-emerald-500/10">
                    <p class="text-[9px] font-black text-emerald-600 dark:text-emerald-500 uppercase tracking-[0.2em] mb-2 text-center">حسابات تجريبية</p>
                    <div class="space-y-1 text-center font-mono text-[10px] text-zinc-500 dark:text-zinc-400">
                        <p>Admin: <span class="text-zinc-800 dark:text-zinc-200">admin@trico.com</span> / password</p>
                        <p>Vendor: <span class="text-zinc-800 dark:text-zinc-200">vendor@trico.com</span> / password</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Footer --}}
        <p class="mt-8 text-center text-[10px] font-bold text-zinc-400 dark:text-zinc-600 uppercase tracking-widest">
            جميع الحقوق محفوظة &copy; {{ date('2026') }} TRICO PREMIUM
        </p>
    </div>
</div>
@endsection