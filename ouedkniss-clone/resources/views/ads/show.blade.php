@extends('layouts.app')

@section('title', $ad->title . ' | TRICO')

@section('content')
<div class="bg-[#0a0a0a] min-h-screen text-right pb-24" dir="rtl">
    {{-- Top Utility Bar - شريط علوي رفيع --}}
    <div class="border-b border-white/5 py-3">
        <div class="max-w-7xl mx-auto px-4 lg:px-8 flex justify-between items-center">
            <nav class="flex items-center gap-2 text-[10px] font-black text-gray-500 uppercase tracking-[0.2em]">
                <a href="/" class="hover:text-emerald-500 transition-colors">الرئيسية</a>
                <span class="text-zinc-700">/</span>
                <span class="text-emerald-500">{{ $ad->title }}</span>
            </nav>
            <div class="flex gap-4 text-gray-500 text-[10px] font-black uppercase tracking-widest">
                <span class="flex items-center gap-1"><i class="far fa-eye text-emerald-500"></i> {{ $ad->views_count ?? 0 }} مشاهدة</span>
                <span class="flex items-center gap-1"><i class="far fa-clock text-emerald-500"></i> {{ $ad->created_at->diffForHumans() }}</span>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 py-12 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16">
            
            {{-- Left: Gallery Section - قسم الصور --}}
            <div class="lg:col-span-7">
                <div class="sticky top-24 space-y-6">
                    <div class="relative overflow-hidden rounded-[2rem] bg-zinc-900 border border-white/5 group">
                        @php
                            $primaryImage = $ad->images->where('is_primary', true)->first() ?? $ad->images->first();
                            $mainUrl = $primaryImage ? asset('storage/' . $primaryImage->image_path) : 'https://via.placeholder.com/800x1000?text=No+Image';
                        @endphp
                        <img src="{{ $mainUrl }}" class="w-full aspect-[3/4] object-cover transition-transform duration-[2s] group-hover:scale-105">
                        
                        {{-- Condition Tag --}}
                        <div class="absolute top-8 right-8">
                            <span class="bg-white text-black px-6 py-2 text-[10px] font-black uppercase tracking-[0.2em] rounded-full shadow-2xl">
                                {{ $ad->condition == 'new' ? 'NEW COLLECTION' : 'PRE-OWNED' }}
                            </span>
                        </div>
                    </div>

                    {{-- Thumbnails --}}
                    @if($ad->images->count() > 1)
                    <div class="grid grid-cols-4 gap-4">
                        @foreach($ad->images as $img)
                        <div class="aspect-[3/4] rounded-2xl overflow-hidden border border-white/5 hover:border-emerald-500/50 transition-all cursor-pointer bg-zinc-900">
                            <img src="{{ asset('storage/' . $img->image_path) }}" class="w-full h-full object-cover opacity-60 hover:opacity-100 transition-opacity">
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>

            {{-- Right: Details Section - قسم التفاصيل --}}
            <div class="lg:col-span-5">
                <div class="flex flex-col h-full">
                    {{-- Category & Location --}}
                    <div class="flex items-center gap-3 mb-6">
                        <span class="text-emerald-500 text-[10px] font-black uppercase tracking-[0.3em]">{{ $ad->category->name ?? 'FASHION' }}</span>
                        <span class="w-1 h-1 bg-zinc-700 rounded-full"></span>
                        <span class="text-gray-500 text-[10px] font-black uppercase tracking-[0.3em]">{{ $ad->location ?? 'ALGERIA' }}</span>
                    </div>

                    <h1 class="text-5xl lg:text-6xl font-black text-white leading-[1.1] tracking-tighter mb-6">
                        {{ $ad->title }}
                    </h1>

                    <div class="flex items-baseline gap-2 mb-10">
                        <span class="text-4xl font-black text-white">{{ number_format($ad->price) }}</span>
                        <span class="text-emerald-500 font-bold text-lg uppercase">DZD</span>
                    </div>

                    {{-- Seller Card --}}
                    <div class="bg-zinc-900/50 border border-white/5 rounded-3xl p-6 mb-10 flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <div class="w-14 h-14 rounded-full bg-gradient-to-tr from-emerald-500 to-teal-700 flex items-center justify-center text-black font-black text-xl">
                                {{ substr($ad->user->name, 0, 1) }}
                            </div>
                            <div>
                                <h4 class="font-black text-white uppercase text-xs tracking-widest">{{ $ad->user->name }}</h4>
                                <p class="text-[10px] text-emerald-500 font-bold mt-1 uppercase tracking-tighter">Verified Curator</p>
                            </div>
                        </div>
                        <a href="#" class="text-white hover:text-emerald-500 transition-colors">
                            <i class="fas fa-chevron-left"></i>
                        </a>
                    </div>

                    {{-- Description --}}
                    <div class="mb-12">
                        <h3 class="text-[10px] font-black text-zinc-500 uppercase tracking-[0.3em] mb-6 flex items-center gap-4">
                            Details <span class="h-[1px] flex-1 bg-white/5"></span>
                        </h3>
                        <div class="text-gray-400 leading-relaxed text-sm lg:text-base font-medium">
                            {{ $ad->description }}
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="grid grid-cols-1 gap-4 mt-auto">
                        @if($ad->contact_whatsapp)
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $ad->contact_whatsapp) }}" 
                           class="group relative bg-emerald-500 hover:bg-white text-black py-6 rounded-2xl font-black text-center text-[11px] uppercase tracking-[0.2em] transition-all duration-500 overflow-hidden shadow-2xl shadow-emerald-500/20">
                            <span class="relative z-10 flex items-center justify-center gap-2">
                                <i class="fab fa-whatsapp text-lg"></i> Inquiry via WhatsApp
                            </span>
                        </a>
                        @endif
                        
                        @if($ad->contact_phone)
                        <a href="tel:{{ $ad->contact_phone }}" 
                           class="border border-white/10 text-white py-6 rounded-2xl font-black text-center text-[11px] uppercase tracking-[0.2em] hover:bg-white hover:text-black transition-all duration-500">
                           Direct Call: {{ $ad->contact_phone }}
                        </a>
                        @endif

                        <button class="text-zinc-500 text-[10px] font-black uppercase tracking-widest mt-4 hover:text-white transition-colors">
                            <i class="far fa-heart ml-2"></i> Add to Wishlist
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Recommendation Section --}}
    <div class="max-w-7xl mx-auto px-4 mt-32 lg:px-8">
        <h2 class="text-[10px] font-black text-zinc-500 uppercase tracking-[0.4em] mb-12 text-center">You may also like</h2>
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-8">
            {{-- التكرار للإعلانات المشابهة هنا --}}
        </div>
    </div>
</div>
@endsection