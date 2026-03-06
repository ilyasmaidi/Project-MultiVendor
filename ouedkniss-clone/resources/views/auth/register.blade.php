@extends('layouts.app')

@section('title', 'إنشاء حساب | TRICO')

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
                <h2 class="text-2xl font-black text-zinc-900 dark:text-white tracking-tight uppercase italic">إنشاء حساب جديد</h2>
                <p class="mt-3 text-xs font-bold text-zinc-500 dark:text-zinc-400 uppercase tracking-widest">
                    لديك حساب بالفعل؟ 
                    <a href="{{ route('login') }}" class="text-emerald-500 hover:text-emerald-400 transition-colors border-b border-emerald-500/30">
                        سجل الدخول من هنا
                    </a>
                </p>
            </div>
            
            <form class="space-y-6" action="{{ route('register') }}" method="POST">
                @csrf
                
                {{-- Name Input --}}
                <div class="space-y-2">
                    <label for="name" class="block text-[10px] font-black uppercase tracking-[0.2em] text-zinc-600 dark:text-zinc-400 mr-2">الاسم الكامل *</label>
                    <input id="name" name="name" type="text" required
                           class="w-full bg-white dark:bg-zinc-900/50 border border-zinc-200 dark:border-white/10 px-5 py-4 rounded-2xl text-sm text-zinc-900 dark:text-white placeholder-zinc-400 dark:placeholder-zinc-600 outline-none focus:border-emerald-500/50 transition-all shadow-inner text-right"
                           placeholder="محمد أحمد" value="{{ old('name') }}">
                    @error('name')
                        <p class="text-rose-500 text-[10px] font-bold mt-1 px-2">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email Input --}}
                <div class="space-y-2">
                    <label for="email" class="block text-[10px] font-black uppercase tracking-[0.2em] text-zinc-600 dark:text-zinc-400 mr-2">البريد الإلكتروني *</label>
                    <input id="email" name="email" type="email" required
                           class="w-full bg-white dark:bg-zinc-900/50 border border-zinc-200 dark:border-white/10 px-5 py-4 rounded-2xl text-sm text-zinc-900 dark:text-white placeholder-zinc-400 dark:placeholder-zinc-600 outline-none focus:border-emerald-500/50 transition-all shadow-inner text-right"
                           placeholder="your@email.com" value="{{ old('email') }}">
                    @error('email')
                        <p class="text-rose-500 text-[10px] font-bold mt-1 px-2">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Phone Input --}}
                <div class="space-y-2">
                    <label for="phone" class="block text-[10px] font-black uppercase tracking-[0.2em] text-zinc-600 dark:text-zinc-400 mr-2">رقم الهاتف (اختياري)</label>
                    <input id="phone" name="phone" type="tel"
                           class="w-full bg-white dark:bg-zinc-900/50 border border-zinc-200 dark:border-white/10 px-5 py-4 rounded-2xl text-sm text-zinc-900 dark:text-white placeholder-zinc-400 dark:placeholder-zinc-600 outline-none focus:border-emerald-500/50 transition-all shadow-inner text-right"
                           placeholder="05xxxxxxxx" value="{{ old('phone') }}">
                </div>

                {{-- Password Input --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label for="password" class="block text-[10px] font-black uppercase tracking-[0.2em] text-zinc-600 dark:text-zinc-400 mr-2">كلمة المرور *</label>
                        <input id="password" name="password" type="password" required
                               class="w-full bg-white dark:bg-zinc-900/50 border border-zinc-200 dark:border-white/10 px-5 py-4 rounded-2xl text-sm text-zinc-900 dark:text-white placeholder-zinc-400 dark:placeholder-zinc-600 outline-none focus:border-emerald-500/50 transition-all shadow-inner text-right"
                               placeholder="••••••••">
                    </div>
                    <div class="space-y-2">
                        <label for="password_confirmation" class="block text-[10px] font-black uppercase tracking-[0.2em] text-zinc-600 dark:text-zinc-400 mr-2">تأكيد المرور *</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" required
                               class="w-full bg-white dark:bg-zinc-900/50 border border-zinc-200 dark:border-white/10 px-5 py-4 rounded-2xl text-sm text-zinc-900 dark:text-white placeholder-zinc-400 dark:placeholder-zinc-600 outline-none focus:border-emerald-500/50 transition-all shadow-inner text-right"
                               placeholder="••••••••">
                    </div>
                </div>
                @error('password')
                    <p class="text-rose-500 text-[10px] font-bold mt-1 px-2">{{ $message }}</p>
                @enderror

                {{-- Submit Button --}}
                <button type="submit" class="relative w-full group overflow-hidden bg-zinc-900 dark:bg-white text-white dark:text-black py-5 rounded-2xl font-black text-xs uppercase tracking-[0.3em] transition-all hover:scale-[1.02] active:scale-[0.98]">
                    <span class="absolute inset-0 w-full h-full bg-emerald-500 transition-transform duration-500 translate-y-full group-hover:translate-y-0"></span>
                    <span class="relative group-hover:text-black transition-colors duration-500">إنشاء حساب</span>
                </button>
            </form>
        </div>

        {{-- Footer --}}
        <p class="mt-8 text-center text-[10px] font-bold text-zinc-400 dark:text-zinc-600 uppercase tracking-widest">
            جميع الحقوق محفوظة &copy; {{ date('2026') }} TRICO PREMIUM
        </p>
    </div>
</div>
@endsection