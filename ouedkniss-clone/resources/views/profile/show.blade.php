@extends('layouts.app')

@section('title', 'الملف الشخصي | TRICO')

@section('content')
<div class="min-h-screen bg-[#0a0a0a] text-right py-12" dir="rtl">
    <div class="max-w-6xl mx-auto px-4 lg:px-8">
        
        {{-- Header Section --}}
        <div class="mb-12">
            <h1 class="text-4xl font-black text-white tracking-tighter">الحساب الشخصي</h1>
            <p class="text-gray-500 mt-2 font-bold uppercase tracking-widest text-xs">Manage your global fashion profile</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            
            {{-- Sidebar: User Info Card --}}
            <div class="lg:col-span-4">
                <div class="bg-zinc-900 border border-white/5 rounded-3xl p-8 sticky top-24">
                    <div class="text-center">
                        <div class="relative inline-block group">
                            <div class="w-32 h-32 bg-zinc-800 rounded-full mx-auto mb-6 flex items-center justify-center border-2 border-emerald-500/30 overflow-hidden">
                                @if(auth()->user()->avatar)
                                    <img src="{{ asset('storage/' . auth()->user()->avatar) }}" class="w-full h-full object-cover">
                                @else
                                    <i class="fas fa-user text-5xl text-zinc-700"></i>
                                @endif
                            </div>
                            <button class="absolute bottom-2 right-2 bg-emerald-500 text-black w-8 h-8 rounded-full flex items-center justify-center text-xs hover:scale-110 transition-transform">
                                <i class="fas fa-camera"></i>
                            </button>
                        </div>
                        
                        <h2 class="text-2xl font-black text-white">{{ auth()->user()->name }}</h2>
                        <p class="text-emerald-500 font-bold text-sm mb-4">{{ auth()->user()->email }}</p>
                        
                        <div class="inline-flex items-center px-4 py-1 rounded-full text-[10px] font-black uppercase tracking-widest
                            @if(auth()->user()->role == 'admin') bg-red-500/10 text-red-500 border border-red-500/20
                            @elseif(auth()->user()->role == 'vendor') bg-emerald-500/10 text-emerald-500 border border-emerald-500/20
                            @else bg-zinc-800 text-zinc-400 @endif">
                            {{ auth()->user()->role == 'admin' ? 'مدير النظام' : (auth()->user()->role == 'vendor' ? 'بائع موثوق' : 'عضو متردد') }}
                        </div>
                    </div>

                    <div class="mt-8 space-y-4 border-t border-white/5 pt-6">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500 font-bold">الإعلانات النشطة</span>
                            <span class="text-white font-black">{{ auth()->user()->ads()->count() }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500 font-bold">تاريخ الانضمام</span>
                            <span class="text-white font-black">{{ auth()->user()->created_at->format('M Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Main Content: Settings Form --}}
            <div class="lg:col-span-8">
                <div class="bg-zinc-900 border border-white/5 rounded-3xl p-8 lg:p-12 shadow-2xl">
                    <h3 class="text-xl font-black text-white mb-8 flex items-center gap-3">
                        <span class="w-2 h-8 bg-emerald-500 rounded-full"></span>
                        إعدادات الحساب
                    </h3>

                    <form action="#" method="POST" class="space-y-8">
                        @csrf
                        @method('PATCH')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-xs font-black text-gray-500 uppercase tracking-widest pr-2">الاسم الكامل</label>
                                <input type="text" name="name" value="{{ auth()->user()->name }}"
                                       class="w-full bg-[#0a0a0a] border-white/5 rounded-2xl p-4 text-white focus:border-emerald-500 focus:ring-0 transition-all">
                            </div>

                            <div class="space-y-2">
                                <label class="text-xs font-black text-gray-500 uppercase tracking-widest pr-2">البريد الإلكتروني</label>
                                <input type="email" name="email" value="{{ auth()->user()->email }}"
                                       class="w-full bg-[#0a0a0a] border-white/5 rounded-2xl p-4 text-white focus:border-emerald-500 focus:ring-0 transition-all">
                            </div>

                            <div class="space-y-2">
                                <label class="text-xs font-black text-gray-500 uppercase tracking-widest pr-2">رقم الهاتف</label>
                                <input type="tel" name="phone" value="{{ auth()->user()->phone }}"
                                       class="w-full bg-[#0a0a0a] border-white/5 rounded-2xl p-4 text-white focus:border-emerald-500 focus:ring-0 transition-all">
                            </div>

                            <div class="space-y-2">
                                <label class="text-xs font-black text-gray-500 uppercase tracking-widest pr-2">واتساب</label>
                                <input type="tel" name="whatsapp" value="{{ auth()->user()->whatsapp }}"
                                       class="w-full bg-[#0a0a0a] border-white/5 rounded-2xl p-4 text-white focus:border-emerald-500 focus:ring-0 transition-all">
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="text-xs font-black text-gray-500 uppercase tracking-widest pr-2">العنوان الحالي</label>
                            <textarea name="address" rows="3"
                                      class="w-full bg-[#0a0a0a] border-white/5 rounded-2xl p-4 text-white focus:border-emerald-500 focus:ring-0 transition-all">{{ auth()->user()->address }}</textarea>
                        </div>

                        {{-- Password Section --}}
                        <div class="pt-8 border-t border-white/5">
                            <h4 class="text-sm font-black text-white mb-6 uppercase tracking-widest">تأمين الحساب</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <input type="password" name="current_password" placeholder="كلمة المرور الحالية"
                                       class="w-full bg-[#0a0a0a] border-white/5 rounded-2xl p-4 text-white focus:border-emerald-500 transition-all">
                                <input type="password" name="new_password" placeholder="كلمة المرور الجديدة"
                                       class="w-full bg-[#0a0a0a] border-white/5 rounded-2xl p-4 text-white focus:border-emerald-500 transition-all">
                            </div>
                        </div>

                        <div class="flex justify-end pt-4">
                            <button type="submit" class="bg-emerald-500 text-black px-10 py-4 rounded-2xl font-black text-sm uppercase tracking-widest hover:bg-white hover:scale-105 transition-all shadow-xl shadow-emerald-500/10">
                                تحديث الملف الشخصي
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection