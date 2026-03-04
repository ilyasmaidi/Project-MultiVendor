@extends('layouts.app')

@section('title', $store->name . ' | TRICO Store')

@section('content')
<div class="min-h-screen bg-[#0f1115]">
    {{-- Store Hero Header --}}
    <div class="relative h-64 md:h-80 overflow-hidden">
        {{-- Cover Image with Overlay --}}
        <div class="absolute inset-0 bg-gradient-to-b from-emerald-500/20 to-[#0f1115]"></div>
        @if($store->cover_path) {{-- افترضنا وجود حقل غلاف --}}
            <img src="{{ asset('storage/' . $store->cover_path) }}" class="w-full h-full object-cover opacity-40">
        @else
            <div class="w-full h-full bg-[var(--card-bg)] opacity-30"></div>
        @endif

        {{-- Store Brand Identity --}}
        <div class="absolute bottom-0 left-0 right-0 p-6 md:p-10">
            <div class="container mx-auto flex flex-col md:flex-row items-center md:items-end gap-6">
                {{-- Logo Container --}}
                <div class="relative group">
                    <div class="absolute -inset-1 bg-gradient-to-r from-emerald-500 to-emerald-800 rounded-3xl blur opacity-30 group-hover:opacity-60 transition duration-1000"></div>
                    <div class="relative w-32 h-32 md:w-40 md:h-40 bg-[var(--card-bg)] rounded-3xl border border-white/10 overflow-hidden shadow-2xl">
                        @if($store->logo)
                            <img src="{{ asset('storage/' . $store->logo) }}" alt="{{ $store->name }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-emerald-500">
                                <i class="fas fa-store text-5xl"></i>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Name & Stats --}}
                <div class="flex-1 text-center md:text-right mb-2">
                    <div class="flex flex-col md:flex-row items-center gap-3 mb-3">
                        <h1 class="text-3xl md:text-5xl font-heavy text-white uppercase tracking-tighter">
                            {{ $store->name }}
                        </h1>
                        @if($store->is_verified)
                            <span class="badge-emerald flex items-center gap-1 py-1 px-3 rounded-full text-xs font-black uppercase">
                                <i class="fas fa-certificate text-[10px]"></i> موثق
                            </span>
                        @endif
                    </div>
                    <p class="text-gray-400 max-w-2xl font-medium line-clamp-2 leading-relaxed">
                        {{ $store->description ?? 'لا يوجد وصف متاح لهذا المتجر حالياً.' }}
                    </p>
                </div>

                {{-- Action Buttons --}}
                <div class="flex gap-3 mb-2">
                    @if($store->phone)
                        <a href="tel:{{ $store->phone }}" class="btn-premium px-6 py-3 rounded-xl flex items-center gap-2">
                            <i class="fas fa-phone-alt"></i> اتصل
                        </a>
                    @endif
                    <button class="bg-white/5 hover:bg-white/10 text-white border border-white/10 p-3 rounded-xl transition-all">
                        <i class="fas fa-share-alt"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Stats Bar --}}
    <div class="border-y border-white/5 bg-white/[0.02] backdrop-blur-md">
        <div class="container mx-auto px-6 py-4">
            <div class="flex flex-wrap items-center justify-center md:justify-start gap-8 text-sm font-bold text-gray-400">
                <div class="flex items-center gap-2">
                    <i class="fas fa-map-marker-alt text-emerald-500"></i>
                    <span>{{ $store->location ?? 'الجزائر' }}</span>
                </div>
                <div class="flex items-center gap-2">
                    <i class="fas fa-boxes text-emerald-500"></i>
                    <span>{{ $store->ads->count() }} منتج معروض</span>
                </div>
                <div class="flex items-center gap-2">
                    <i class="fas fa-calendar-alt text-emerald-500"></i>
                    <span>عضو منذ {{ $store->created_at->format('Y') }}</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Products Grid --}}
    <div class="container mx-auto px-6 py-12">
        <div class="flex items-center justify-between mb-10">
            <h2 class="text-2xl font-heavy text-white">كل <span class="text-emerald-500">المنتجات</span></h2>
            <div class="flex items-center gap-2 text-gray-500 text-sm">
                <span>ترتيب حسب:</span>
                <select class="bg-transparent border-none text-emerald-500 focus:ring-0 font-bold cursor-pointer">
                    <option>الأحدث</option>
                    <option>الأعلى سعراً</option>
                </select>
            </div>
        </div>

        @if($store->ads->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($store->ads as $ad)
                    <div class="group card overflow-hidden hover:border-emerald-500/50 transition-all duration-500">
                        {{-- Image with Hover Overlay --}}
                        <div class="relative aspect-square overflow-hidden bg-black/20">
                            <img src="{{ $ad->primary_image_url }}" alt="{{ $ad->title }}" 
                                 class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                            
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-4">
                                <a href="{{ route('ads.show', $ad->slug) }}" class="btn-premium w-full py-2 rounded-lg text-xs text-center">
                                    التفاصيل الكاملة
                                </a>
                            </div>

                            @if($ad->is_featured)
                                <div class="absolute top-3 left-3 bg-amber-500 text-black text-[10px] font-black px-2 py-1 rounded-md uppercase tracking-tighter">
                                    Special
                                </div>
                            @endif
                        </div>

                        {{-- Content --}}
                        <div class="p-5">
                            <h3 class="text-white font-bold mb-1 truncate group-hover:text-emerald-400 transition-colors">
                                {{ $ad->title }}
                            </h3>
                            <div class="flex justify-between items-center mt-3">
                                <span class="text-xl font-heavy text-white font-international">
                                    {{ number_format($ad->price) }} <span class="text-emerald-500 text-xs uppercase ml-1">DA</span>
                                </span>
                                <span class="text-[10px] text-gray-500 font-bold uppercase">{{ $ad->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            {{-- Empty State --}}
            <div class="py-20 text-center border-2 border-dashed border-white/5 rounded-3xl">
                <i class="fas fa-shopping-basket text-6xl text-white/10 mb-4"></i>
                <h3 class="text-xl font-bold text-white mb-2">المتجر فارغ حالياً</h3>
                <p class="text-gray-500">ترقبوا أقوى العروض والمنتجات قريباً من {{ $store->name }}</p>
            </div>
        @endif
    </div>
</div>

<style>
    /* إضافة لمسات خاصة بصفحة المتجر */
    .font-heavy { font-weight: 900; }
    .font-international { font-family: 'Montserrat', sans-serif; }
    .badge-emerald { background: rgba(16, 185, 129, 0.1); color: #10b981; border: 1px solid rgba(16, 185, 129, 0.2); }
</style>
@endsection