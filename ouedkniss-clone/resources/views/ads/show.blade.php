@extends('layouts.app')

@section('title', $ad->title . ' | TRICO')

@section('content')
{{-- الحاوية الرئيسية: خلفيات محايدة تتغير بسلاسة --}}
<div class="bg-zinc-50 dark:bg-[#0c0c0e] min-h-screen text-right pb-32 transition-colors duration-500 ease-in-out font-sans" dir="rtl">
    
    {{-- Navbar Space Offset --}}
    <div class="h-16 md:h-20"></div>

    {{-- Breadcrumbs & Top Bar: تصميم زجاجي متكيف --}}
    <div class="sticky top-0 z-40 border-b border-zinc-200 dark:border-zinc-800 bg-white/80 dark:bg-[#0c0c0e]/80 backdrop-blur-xl">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <nav class="flex items-center gap-3 text-[10px] font-bold text-zinc-400 dark:text-zinc-500 tracking-widest uppercase">
                <a href="/" class="hover:text-emerald-500 transition-colors">الرئيسية</a>
                <span class="opacity-30">/</span>
                <span class="text-zinc-800 dark:text-zinc-200">{{ Str::limit($ad->title, 25) }}</span>
            </nav>
            
            <div class="hidden md:flex gap-6 items-center">
                <div class="flex items-center gap-2 text-zinc-500 dark:text-zinc-400">
                    <i class="far fa-eye text-emerald-500 text-[10px]"></i>
                    <span class="text-[10px] font-black uppercase">{{ $ad->views_count ?? 0 }} مشاهدة</span>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6 py-12 lg:px-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-20">
            
            {{-- الجانب الأيمن: معرض الصور --}}
            <div class="lg:col-span-7">
                <div class="sticky top-32 space-y-6">
                    {{-- الإطار الرئيسي --}}
                    <div class="relative overflow-hidden rounded-[2.5rem] bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 shadow-sm">
                        @php
                            $primaryImage = $ad->images->where('is_primary', true)->first() ?? $ad->images->first();
                            $mainUrl = $primaryImage ? asset('storage/' . $primaryImage->image_path) : 'https://via.placeholder.com/800x1000';
                        @endphp
                        <img src="{{ $mainUrl }}" id="mainHeroImage" class="w-full aspect-[4/5] object-cover transition-transform duration-700 hover:scale-105">
                        
                        {{-- حالة المنتج --}}
                        <div class="absolute top-8 left-8">
                            <span class="bg-zinc-900/90 dark:bg-zinc-100/90 backdrop-blur text-white dark:text-zinc-900 px-5 py-2 text-[9px] font-black uppercase tracking-widest rounded-full shadow-xl">
                                {{ $ad->condition == 'new' ? 'جديد' : 'مستعمل' }}
                            </span>
                        </div>
                    </div>

                    {{-- المصغرات --}}
                    @if($ad->images->count() > 1)
                    <div class="flex gap-4 overflow-x-auto no-scrollbar py-2">
                        @foreach($ad->images as $img)
                        <button onclick="document.getElementById('mainHeroImage').src='{{ asset('storage/' . $img->image_path) }}'" 
                             class="flex-shrink-0 w-20 aspect-[3/4] rounded-2xl overflow-hidden border-2 border-transparent focus:border-emerald-500 transition-all bg-white dark:bg-zinc-900 shadow-sm">
                            <img src="{{ asset('storage/' . $img->image_path) }}" class="w-full h-full object-cover">
                        </button>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>

            {{-- الجانب الأيسر: التفاصيل --}}
            <div class="lg:col-span-5">
                <div class="flex flex-col space-y-10">
                    
                    {{-- العنوان والسعر --}}
                    <div class="space-y-4">
                        <span class="text-emerald-600 dark:text-emerald-400 text-[10px] font-black uppercase tracking-[0.2em]">
                            {{ $ad->category->name ?? 'تصنيف مميز' }}
                        </span>
                        <h1 class="text-4xl lg:text-6xl font-black text-zinc-900 dark:text-zinc-50 leading-tight tracking-tighter">
                            {{ $ad->title }}
                        </h1>
                        <div class="flex items-baseline gap-2 pt-4">
                            <span class="text-5xl font-black text-zinc-900 dark:text-zinc-50 tracking-tighter italic">
                                {{ number_format($ad->price) }}
                            </span>
                            <span class="text-emerald-600 dark:text-emerald-400 font-bold text-sm uppercase">DZD</span>
                        </div>
                    </div>

                    {{-- بطاقة البائع --}}
                    <div class="p-6 rounded-[2rem] bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 flex items-center justify-between shadow-sm group hover:border-emerald-500/50 transition-colors">
                        <div class="flex items-center gap-4">
                            <div class="w-14 h-14 rounded-2xl overflow-hidden bg-zinc-100 dark:bg-zinc-800">
                                <img src="{{ $ad->user->store->logo ?? 'https://ui-avatars.com/api/?name='.$ad->user->name }}" class="w-full h-full object-cover">
                            </div>
                            <div>
                                <h4 class="text-zinc-900 dark:text-zinc-100 font-black text-sm tracking-tight">{{ $ad->user->store->name ?? $ad->user->name }}</h4>
                                <p class="text-[10px] text-zinc-500 dark:text-zinc-500 font-bold uppercase mt-1">بائع موثوق</p>
                            </div>
                        </div>
                        <div class="w-10 h-10 rounded-full bg-zinc-50 dark:bg-zinc-800 flex items-center justify-center text-zinc-400 group-hover:bg-emerald-500 group-hover:text-white transition-all italic text-xs">
                            <i class="fas fa-arrow-left"></i>
                        </div>
                    </div>

                    {{-- الوصف --}}
                    <div class="space-y-4">
                        <h3 class="text-[10px] font-black text-zinc-400 dark:text-zinc-600 uppercase tracking-widest">وصف المنتج</h3>
                        <p class="text-zinc-600 dark:text-zinc-400 leading-relaxed text-lg font-medium italic">
                            {{ $ad->description }}
                        </p>
                    </div>

                    {{-- قسم الشراء التفاعلي --}}
                    <div class="space-y-8 pt-10 border-t border-zinc-100 dark:border-zinc-800/50">
                        
                        {{-- فورم الشراء السريع --}}
                        <form action="{{ route('checkout.index') }}" method="GET" class="space-y-6">
                            <div class="grid grid-cols-2 gap-4">
                                {{-- اختيار المقاس --}}
                                <div class="space-y-2">
                                    <label class="text-[9px] font-black uppercase tracking-[0.2em] text-zinc-400 mr-2">المقاس</label>
                                    <select name="size" required class="w-full bg-zinc-100 dark:bg-white/5 border-transparent rounded-xl py-4 px-4 text-xs font-bold text-zinc-900 dark:text-zinc-100 focus:ring-2 focus:ring-emerald-500 transition-all outline-none">
                                        <option value="S">Small (S)</option>
                                        <option value="M" selected>Medium (M)</option>
                                        <option value="L">Large (L)</option>
                                        <option value="XL">Extra Large (XL)</option>
                                    </select>
                                </div>

                                {{-- اختيار اللون --}}
                                <div class="space-y-2">
                                    <label class="text-[9px] font-black uppercase tracking-[0.2em] text-zinc-400 mr-2">اللون</label>
                                    <select name="color" required class="w-full bg-zinc-100 dark:bg-white/5 border-transparent rounded-xl py-4 px-4 text-xs font-bold text-zinc-900 dark:text-zinc-100 focus:ring-2 focus:ring-emerald-500 transition-all outline-none">
                                        <option value="أسود">أسود</option>
                                        <option value="أبيض">أبيض</option>
                                        <option value="أزرق">أزرق</option>
                                        <option value="رمادي">رمادي</option>
                                    </select>
                                </div>
                            </div>

                            <input type="hidden" name="ad_id" value="{{ $ad->id }}">

                            {{-- زر اشتري الآن الرئيسي --}}
                            <button type="submit" class="group relative flex items-center justify-center gap-4 w-full bg-zinc-900 dark:bg-white text-white dark:text-zinc-900 py-6 rounded-2xl font-black text-[12px] uppercase tracking-[0.3em] transition-all hover:bg-emerald-500 hover:text-white shadow-2xl shadow-zinc-900/20 dark:shadow-none overflow-hidden">
                                <span class="relative z-10 flex items-center gap-3">
                                    اشتري الآن <i class="fa-solid fa-bag-shopping text-lg"></i>
                                </span>
                                <div class="absolute inset-0 bg-emerald-600 translate-y-full group-hover:translate-y-0 transition-transform duration-500"></div>
                            </button>
                        </form>

                        {{-- أزرار التواصل والحفظ --}}
                        <div class="space-y-4">
                            <div class="grid grid-cols-2 gap-4">
                                @if($ad->contact_whatsapp)
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $ad->contact_whatsapp) }}" 
                                   class="flex items-center justify-center gap-2 bg-emerald-500/10 hover:bg-emerald-500 text-emerald-600 hover:text-white py-5 rounded-2xl font-black text-[10px] uppercase tracking-widest transition-all border border-emerald-500/20 shadow-sm">
                                    <i class="fab fa-whatsapp text-sm"></i> واتساب
                                </a>
                                @endif

                                @if($ad->contact_phone)
                                <a href="tel:{{ $ad->contact_phone }}" class="flex items-center justify-center bg-zinc-100 dark:bg-white/5 text-zinc-900 dark:text-white py-5 rounded-2xl font-black text-[10px] uppercase tracking-widest transition-all hover:bg-zinc-200 dark:hover:bg-white/10">
                                    <i class="fa-solid fa-phone-flip ml-2 text-[10px]"></i> اتصل الآن
                                </a>
                                @endif
                            </div>

                            <button class="w-full py-4 text-[9px] font-black text-zinc-400 dark:text-zinc-500 uppercase tracking-[0.4em] hover:text-emerald-500 transition-colors">
                                <i class="far fa-bookmark ml-2"></i> حفظ القطعة للمراجعة
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .no-scrollbar::-webkit-scrollbar { display: none; }
    .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;500;800&family=Cairo:wght@400;700;900&display=swap');
    
    body { 
        font-family: 'Plus Jakarta Sans', 'Cairo', sans-serif;
    }

    select {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%236b7280'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: left 1rem center;
        background-size: 1em;
    }
</style>
@endsection