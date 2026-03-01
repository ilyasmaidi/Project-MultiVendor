@extends('layouts.app')

@section('title', 'الملف الشخصي')

@section('content')
<div style="background-color: #f5f5f5; padding: 10px; border: 2px solid #ddd; margin-bottom: 20px;">
    <h1 style="color: black; font-weight: bold; text-align: center;">هذا الملف هو: <code>resources/views/profile/show.blade.php</code></h1>
</div>
<div class="container mx-auto px-4 py-8 max-w-4xl">
    <h1 class="text-3xl font-bold mb-8">الملف الشخصي</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- User Info Card -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="text-center mb-6">
                <div class="w-24 h-24 bg-gray-300 rounded-full mx-auto mb-4 flex items-center justify-center">
                    @if(auth()->user()->avatar)
                        <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="" class="w-full h-full object-cover rounded-full">
                    @else
                        <i class="fas fa-user text-4xl text-gray-500"></i>
                    @endif
                </div>
                <h2 class="text-xl font-bold">{{ auth()->user()->name }}</h2>
                <p class="text-gray-500">{{ auth()->user()->email }}</p>
                <span class="inline-block mt-2 px-3 py-1 rounded-full text-sm font-medium
                    @if(auth()->user()->role == 'admin') bg-red-100 text-red-800
                    @elseif(auth()->user()->role == 'vendor') bg-blue-100 text-blue-800
                    @else bg-gray-100 text-gray-800 @endif">
                    {{ auth()->user()->role == 'admin' ? 'مدير' : (auth()->user()->role == 'vendor' ? 'بائع' : 'مشتري') }}
                </span>
            </div>

            <div class="border-t pt-4">
                <div class="flex justify-between mb-2">
                    <span class="text-gray-500">رقم الهاتف:</span>
                    <span>{{ auth()->user()->phone ?? '—' }}</span>
                </div>
                <div class="flex justify-between mb-2">
                    <span class="text-gray-500">الإعلانات:</span>
                    <span>{{ auth()->user()->ads()->count() }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">تاريخ الانضمام:</span>
                    <span>{{ auth()->user()->created_at->format('Y-m-d') }}</span>
                </div>
            </div>
        </div>

        <!-- Edit Profile Form -->
        <div class="md:col-span-2 bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-bold mb-4 border-b pb-2">تعديل الملف الشخصي</h3>

            <form action="#" method="POST" class="space-y-4">
                @csrf
                @method('PATCH')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">الاسم</label>
                        <input type="text" name="name" value="{{ auth()->user()->name }}"
                               class="w-full border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">البريد الإلكتروني</label>
                        <input type="email" name="email" value="{{ auth()->user()->email }}"
                               class="w-full border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">رقم الهاتف</label>
                        <input type="tel" name="phone" value="{{ auth()->user()->phone }}"
                               class="w-full border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">واتساب</label>
                        <input type="tel" name="whatsapp" value="{{ auth()->user()->whatsapp }}"
                               class="w-full border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">العنوان</label>
                    <textarea name="address" rows="2"
                              class="w-full border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500">{{ auth()->user()->address }}</textarea>
                </div>

                <div class="border-t pt-4">
                    <h4 class="font-medium mb-3">تغيير كلمة المرور</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">كلمة المرور الحالية</label>
                            <input type="password" name="current_password"
                                   class="w-full border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">كلمة المرور الجديدة</label>
                            <input type="password" name="new_password"
                                   class="w-full border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500">
                        </div>
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700">
                        حفظ التغييرات
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
