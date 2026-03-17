@extends('layouts.app')

@section('title', 'إنشاء حساب | TRICO')

@section('content')
<div class="min-h-[calc(100vh-200px)] flex items-center justify-center py-16 px-4 bg-white dark:bg-[#0a0a0a] transition-colors duration-500" 
     dir="rtl" 
     x-data="{ role: 'buyer', autoPassword: '123456789' }">
    <div class="max-w-md w-full">
        
        <div class="bg-zinc-50 dark:bg-white/[0.03] border border-zinc-200 dark:border-white/10 p-10 rounded-[2.5rem] shadow-xl backdrop-blur-sm">
            
            {{-- Header --}}
            <div class="text-center mb-10">
                <a href="{{ route('home') }}" class="inline-block mb-6 group">
                    <span class="font-international text-4xl font-[900] tracking-[-0.08em] text-zinc-900 dark:text-white uppercase transition-colors">
                        TRI<span class="text-emerald-500 group-hover:text-emerald-400">CO</span>
                    </span>
                </a>
                <h2 class="text-2xl font-black text-zinc-900 dark:text-white tracking-tight uppercase italic">إنشاء حساب جديد</h2>
                
                {{-- Role Selector (Tabs) --}}
                <div class="flex p-1 bg-zinc-200/50 dark:bg-zinc-800/50 rounded-2xl mt-6">
                    <button type="button" @click="role = 'buyer'" 
                        :class="role === 'buyer' ? 'bg-white dark:bg-zinc-700 shadow-sm text-emerald-600' : 'text-zinc-500'"
                        class="flex-1 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all">
                        🛍️ مشتري
                    </button>
                    <button type="button" @click="role = 'seller'" 
                        :class="role === 'seller' ? 'bg-white dark:bg-zinc-700 shadow-sm text-emerald-600' : 'text-zinc-500'"
                        class="flex-1 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all">
                        🏪 بائع
                    </button>
                </div>
            </div>
            
            <form class="space-y-6" action="{{ route('register') }}" method="POST">
                @csrf
                
                {{-- حقل مخفي لنوع الحساب --}}
                <input type="hidden" name="role" :value="role">

                {{-- الاسم الكامل --}}
                <div class="space-y-2">
                    <label for="name" class="block text-[10px] font-black uppercase tracking-[0.2em] text-zinc-600 dark:text-zinc-400 mr-2">الاسم الكامل *</label>
                    <input id="name" name="name" type="text" required
                           class="w-full bg-white dark:bg-zinc-900/50 border border-zinc-200 dark:border-white/10 px-5 py-4 rounded-2xl text-sm text-zinc-900 dark:text-white placeholder-zinc-400 dark:placeholder-zinc-600 outline-none focus:border-emerald-500/50 transition-all shadow-inner text-right"
                           placeholder="مثال: إلياس محمد" value="{{ old('name') }}">
                </div>

                {{-- رقم الهاتف - إجباري للجميع --}}
                <div class="space-y-2">
                    <label for="phone" class="block text-[10px] font-black uppercase tracking-[0.2em] text-zinc-600 dark:text-zinc-400 mr-2">رقم الهاتف *</label>
                    <input id="phone" name="phone" type="tel" required
                           class="w-full bg-white dark:bg-zinc-900/50 border border-zinc-200 dark:border-white/10 px-5 py-4 rounded-2xl text-sm text-zinc-900 dark:text-white placeholder-zinc-400 dark:placeholder-zinc-600 outline-none focus:border-emerald-500/50 transition-all shadow-inner text-right"
                           placeholder="05XXXXXXXX" value="{{ old('phone') }}" dir="ltr">
                    @error('phone')
                        <p class="text-rose-500 text-[10px] font-bold mt-1 px-2">{{ $message }}</p>
                    @enderror
                </div>

                {{-- قسم المشتري: لا بريد، لا كلمة سر، فقط تنبيه بكلمة السر التلقائية --}}
                <div x-show="role === 'buyer'" class="space-y-4 animate-fade-in">
                    <div class="bg-emerald-500/5 border border-emerald-500/20 p-5 rounded-[1.5rem] text-center">
                        <p class="text-[10px] font-black text-emerald-600 dark:text-emerald-400 uppercase tracking-widest mb-2">كلمة السر الخاصة بك</p>
                        <span class="text-2xl font-black tracking-[0.3em] text-zinc-900 dark:text-white" x-text="autoPassword"></span>
                        
                        {{-- إرسال كلمة السر التلقائية مخفية --}}
                        <input type="hidden" name="password" :value="autoPassword">
                        <input type="hidden" name="password_confirmation" :value="autoPassword">
                        
                        <p class="mt-3 text-[9px] text-zinc-400 font-bold uppercase leading-relaxed">استخدم رقم هاتفك وكلمة السر هذه للدخول لاحقاً</p>
                    </div>
                </div>

                {{-- قسم البائع: يتطلب بريد إلكتروني وكلمة سر مخصصة --}}
                <div x-show="role === 'seller'" class="space-y-6 animate-fade-in">
                    <div class="space-y-2">
                        <label for="email" class="block text-[10px] font-black uppercase tracking-[0.2em] text-zinc-600 dark:text-zinc-400 mr-2">البريد الإلكتروني *</label>
                        <input id="email" name="email" type="email" :required="role === 'seller'"
                               class="w-full bg-white dark:bg-zinc-900/50 border border-zinc-200 dark:border-white/10 px-5 py-4 rounded-2xl text-sm text-zinc-900 dark:text-white outline-none focus:border-emerald-500/50 transition-all shadow-inner text-right"
                               placeholder="your@email.com">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label for="password" class="block text-[10px] font-black uppercase tracking-[0.2em] text-zinc-600 dark:text-zinc-400 mr-2">كلمة المرور *</label>
                            <input id="password" name="password" type="password" :required="role === 'seller'"
                                   class="w-full bg-white dark:bg-zinc-900/50 border border-zinc-200 dark:border-white/10 px-5 py-4 rounded-2xl text-sm text-zinc-900 dark:text-white outline-none focus:border-emerald-500/50 transition-all shadow-inner text-right">
                        </div>
                        <div class="space-y-2">
                            <label for="password_confirmation" class="block text-[10px] font-black uppercase tracking-[0.2em] text-zinc-600 dark:text-zinc-400 mr-2">تأكيد المرور *</label>
                            <input id="password_confirmation" name="password_confirmation" type="password" :required="role === 'seller'"
                                   class="w-full bg-white dark:bg-zinc-900/50 border border-zinc-200 dark:border-white/10 px-5 py-4 rounded-2xl text-sm text-zinc-900 dark:text-white outline-none focus:border-emerald-500/50 transition-all shadow-inner text-right">
                        </div>
                    </div>
                </div>

                {{-- زر الإرسال --}}
                <button type="submit" class="relative w-full group overflow-hidden bg-zinc-900 dark:bg-white text-white dark:text-black py-5 rounded-2xl font-black text-xs uppercase tracking-[0.3em] transition-all hover:scale-[1.02] active:scale-[0.98]">
                    <span class="absolute inset-0 w-full h-full bg-emerald-500 transition-transform duration-500 translate-y-full group-hover:translate-y-0"></span>
                    <span class="relative group-hover:text-black transition-colors duration-500">إنشاء حساب</span>
                </button>
            </form>
        </div>

        <p class="mt-8 text-center text-[10px] font-bold text-zinc-400 dark:text-zinc-600 uppercase tracking-widest">
            جميع الحقوق محفوظة &copy; {{ date('Y') }} TRICO PREMIUM
        </p>
    </div>
</div>
@endsection