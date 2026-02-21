@extends('layouts.main')

@section('title', 'تسجيل الدخول')

@section('content')
<div class="min-h-[calc(100vh-300px)] flex items-center justify-center py-12 px-4">
    <div class="max-w-md w-full">
        <div class="card p-8">
            <div class="text-center mb-8">
                <span class="font-international text-3xl font-black tracking-tighter text-white uppercase">TRI<span class="text-[#10b981]">CO</span></span>
                <h2 class="mt-4 text-2xl font-black">تسجيل الدخول</h2>
                <p class="mt-2 text-sm text-gray-400">
                    أو
                    <a href="{{ route('register') }}" class="font-bold text-emerald-400 hover:text-emerald-300">
                        إنشاء حساب جديد
                    </a>
                </p>
            </div>
            
            <form class="space-y-6" action="{{ route('login') }}" method="POST">
                @csrf
                
                <div>
                    <label for="email" class="block text-sm font-bold mb-2">البريد الإلكتروني</label>
                    <input id="email" name="email" type="email" required
                           class="form-input w-full px-4 py-3 rounded-xl"
                           placeholder="your@email.com" value="{{ old('email') }}">
                    @error('email')
                        <p class="text-rose-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="password" class="block text-sm font-bold mb-2">كلمة المرور</label>
                    <input id="password" name="password" type="password" required
                           class="form-input w-full px-4 py-3 rounded-xl"
                           placeholder="••••••••">
                </div>

                <div class="flex items-center justify-between">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="remember" class="w-4 h-4 rounded border-gray-600 bg-white/5 text-emerald-500">
                        <span class="text-sm text-gray-400">تذكرني</span>
                    </label>
                </div>

                <button type="submit" class="btn-premium w-full py-3 rounded-xl font-bold">
                    تسجيل الدخول
                </button>
            </form>

            <div class="mt-6 pt-6 border-t border-white/10 text-center">
                <p class="text-xs text-gray-500">
                    حسابات تجريبية:<br>
                    Admin: admin@trico.com / password<br>
                    Vendor: vendor@trico.com / password
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
