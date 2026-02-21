@extends('layouts.main')

@section('title', 'إنشاء حساب')

@section('content')
<div class="min-h-[calc(100vh-300px)] flex items-center justify-center py-12 px-4">
    <div class="max-w-md w-full">
        <div class="card p-8">
            <div class="text-center mb-8">
                <span class="font-international text-3xl font-black tracking-tighter text-white uppercase">TRI<span class="text-[#10b981]">CO</span></span>
                <h2 class="mt-4 text-2xl font-black">إنشاء حساب جديد</h2>
                <p class="mt-2 text-sm text-gray-400">
                    أو
                    <a href="{{ route('login') }}" class="font-bold text-emerald-400 hover:text-emerald-300">
                        تسجيل الدخول
                    </a>
                </p>
            </div>
            
            <form class="space-y-4" action="{{ route('register') }}" method="POST">
                @csrf
                
                <div>
                    <label for="name" class="block text-sm font-bold mb-2">الاسم الكامل *</label>
                    <input id="name" name="name" type="text" required
                           class="form-input w-full px-4 py-3 rounded-xl"
                           placeholder="محمد أحمد" value="{{ old('name') }}">
                    @error('name')
                        <p class="text-rose-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-bold mb-2">البريد الإلكتروني *</label>
                    <input id="email" name="email" type="email" required
                           class="form-input w-full px-4 py-3 rounded-xl"
                           placeholder="your@email.com" value="{{ old('email') }}">
                    @error('email')
                        <p class="text-rose-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="phone" class="block text-sm font-bold mb-2">رقم الهاتف (اختياري)</label>
                    <input id="phone" name="phone" type="tel"
                           class="form-input w-full px-4 py-3 rounded-xl"
                           placeholder="05xxxxxxxx" value="{{ old('phone') }}">
                </div>

                <div>
                    <label for="password" class="block text-sm font-bold mb-2">كلمة المرور *</label>
                    <input id="password" name="password" type="password" required
                           class="form-input w-full px-4 py-3 rounded-xl"
                           placeholder="8 أحرف على الأقل">
                    @error('password')
                        <p class="text-rose-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-bold mb-2">تأكيد كلمة المرور *</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" required
                           class="form-input w-full px-4 py-3 rounded-xl"
                           placeholder="أعد كتابة كلمة المرور">
                </div>

                <button type="submit" class="btn-premium w-full py-3 rounded-xl font-bold mt-6">
                    إنشاء حساب
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
