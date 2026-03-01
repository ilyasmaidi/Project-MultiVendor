@extends('layouts.app')

@section('title', 'تصفح تشكيلة الأزياء العالمية | TRICO')

@section('content')
<div class="min-h-screen bg-gradient-subtle py-12">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- Header Section: Title & Count --}}
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6">
            <div>
                <h1 class="heavy-title text-4xl md:text-6xl text-white mb-2">
                    المتجر <span class="text-[var(--emerald-light)]">العالمي</span>
                </h1>
                <p class="text-gray-400 font-medium max-w-xl">
                    اكتشف أحدث صيحات الموضة من جميع البائعين حول العالم في مكان واحد.
                </p>
            </div>
            <div class="bg-[var(--card-bg)] px-6 py-3 rounded-2xl border border-gray-800 shadow-xl">
                <span class="text-gray-400 ml-2">إجمالي المنتجات:</span>
                <span class="text-[var(--emerald-light)] font-heavy text-xl">{{ $ads->total() }}</span>
            </div>
        </div>

        {{-- Filters & Sort Bar (UI Only - Logic handled by Livewire) --}}
        <div class="bg-[var(--card-bg)] border border-gray-800 rounded-2xl p-4 mb-10 flex flex-wrap items-center justify-between gap-4 shadow-lg">
            <div class="flex gap-4">
                <button class="bg-[#0f1115] text-white px-5 py-2 rounded-xl border border-gray-700 hover:border-[var(--emerald-light)] transition-all flex items-center gap-2 text-sm font-bold">
                    <i class="fas fa-filter text-[var(--emerald-light)]"></i> تصفية
                </button>
                <button class="bg-[#0f1115] text-white px-5 py-2 rounded-xl border border-gray-700 hover:border-[var(--emerald-light)] transition-all flex items-center gap-2 text-sm font-bold">
                    <i class="fas fa-sort-amount-down text-[var(--emerald-light)]"></i> الأحدث أولاً
                </button>
            </div>
            
            <div class="relative w-full md:w-64">
                <input type="text" placeholder="بحث عن منتج..." 
                       class="w-full bg-[#0f1115] border-gray-700 rounded-xl text-white p-2 px-4 text-sm focus:ring-[var(--emerald-light)] focus:border-[var(--emerald-light)]">
                <i class="fas fa-search absolute left-3 top-3 text-gray-500"></i>
            </div>
        </div>

        {{-- Products Grid --}}
        @if($ads->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @foreach($ads as $ad)
                    <div class="group bg-[var(--card-bg)] border border-gray-800 rounded-3xl overflow-hidden hover:border-[var(--emerald-light)] transition-all duration-500 shadow-lg hover:shadow-[0_0_30px_rgba(16,185,129,0.1)]">
                        
                        {{-- Image Container --}}
                        <div class="relative aspect-[3/4] overflow-hidden bg-[#0f1115]">
                            <img src="{{ $ad->primary_image_url ?? 'https://via.placeholder.com/400x600?text=No+Image' }}" 
                                 alt="{{ $ad->title }}" 
                                 class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                            
                            {{-- Condition Badge --}}
                            <div class="absolute top-4 right-4 bg-black/60 backdrop-blur-md text-[var(--emerald-light)] px-3 py-1 rounded-full text-xs font-bold border border-[var(--emerald-light)]/30">
                                {{ $ad->condition_text }}
                            </div>

                            {{-- Quick Action Overlay --}}
                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-3">
                                <a href="{{ route('ads.show', $ad->slug) }}" class="btn-premium p-3 rounded-full w-12 h-12 flex items-center justify-center shadow-xl">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <button class="bg-white text-black p-3 rounded-full w-12 h-12 flex items-center justify-center hover:bg-[var(--emerald-light)] hover:text-white transition-all shadow-xl">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>

                        {{-- Details --}}
                        <div class="p-5">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="text-[var(--emerald-light)] text-[10px] uppercase font-heavy tracking-widest">
                                    {{ $ad->category->name }}
                                </span>
                                <span class="w-1 h-1 bg-gray-700 rounded-full"></span>
                                <span class="text-gray-500 text-[10px] font-bold">
                                    {{ $ad->city ?? 'الجزائر' }}
                                </span>
                            </div>
                            
                            <h2 class="text-lg font-heavy text-white mb-3 line-clamp-1 group-hover:text-[var(--emerald-light)] transition-colors">
                                {{ $ad->title }}
                            </h2>

                            <div class="flex items-center justify-between mt-auto pt-4 border-t border-gray-800">
                                <div class="flex flex-col">
                                    <span class="text-xs text-gray-500 mb-1">السعر المعروض</span>
                                    <span class="text-xl font-heavy text-white font-international">
                                        @if($ad->price)
                                            {{ number_format($ad->price) }} <span class="text-[var(--emerald-light)] text-sm">DA</span>
                                        @else
                                            <span class="text-[var(--emerald-light)] text-sm uppercase">حسب الاتفاق</span>
                                        @endif
                                    </span>
                                </div>
                                <a href="{{ route('ads.show', $ad->slug) }}" class="text-gray-400 hover:text-white transition-colors">
                                    <i class="fas fa-arrow-left"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="mt-16 custom-pagination">
                {{ $ads->links() }}
            </div>

        @else
            {{-- Empty State --}}
            <div class="bg-[var(--card-bg)] rounded-3xl border border-gray-800 p-20 text-center shadow-2xl">
                <div class="mb-6 inline-flex p-6 bg-[#0f1115] rounded-full border border-gray-800">
                    <i class="fas fa-shopping-bag text-5xl text-gray-600"></i>
                </div>
                <h3 class="text-2xl font-heavy text-white mb-2">لا توجد منتجات حالياً</h3>
                <p class="text-gray-500 mb-8 max-w-sm mx-auto">المتجر حالياً فارغ، كن أول من ينشر إعلانه في منصة TRICO العالمية!</p>
                <a href="{{ route('ads.create') }}" class="btn-premium px-10 py-4 rounded-xl inline-block shadow-lg">
                    انشر إعلانك الآن
                </a>
            </div>
        @endif
    </div>
</div>

<style>
    /* تحسين شكل الترقيم ليتناسب مع الثيم المظلم */
    .custom-pagination nav svg { width: 20px; height: 20px; }
    .custom-pagination nav div { color: #9ca3af !important; }
    .custom-pagination span[aria-current="page"] span { background-color: var(--emerald-light) !important; border-color: var(--emerald-light) !important; color: black !important; font-weight: 800; border-radius: 12px; }
    .custom-pagination a { background-color: var(--card-bg) !important; border-color: #374151 !important; color: #f3f4f6 !important; border-radius: 12px; margin: 0 4px; transition: all 0.3s; }
    .custom-pagination a:hover { border-color: var(--emerald-light) !important; color: var(--emerald-light) !important; }
</style>
@endsection