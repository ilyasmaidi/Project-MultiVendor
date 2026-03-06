@extends('layouts.app')

@section('title', 'تصفح تشكيلة الأزياء العالمية | TRICO')

@section('content')
<div class="min-h-screen py-12 transition-colors duration-500">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- Header Section: Title & Count --}}
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-8">
            <div class="space-y-4">
                <span class="text-brand font-black tracking-[0.4em] text-[10px] uppercase block">Global Collection</span>
                <h1 class="text-4xl md:text-7xl font-black tracking-tighter text-zinc-900 dark:text-white uppercase leading-none">
                    المتجر <span class="text-brand">العالمي</span>
                </h1>
                <p class="text-zinc-500 dark:text-zinc-400 font-medium max-w-xl text-lg">
                    اكتشف أحدث صيحات الموضة من جميع البائعين حول العالم في مكان واحد.
                </p>
            </div>
            <div class="bg-white dark:bg-zinc-900 px-8 py-4 rounded-[2rem] border border-zinc-200 dark:border-zinc-800 shadow-xl flex items-center gap-4">
                <div class="w-12 h-12 bg-brand/10 rounded-full flex items-center justify-center">
                    <i class="fa-solid fa-box-open text-brand"></i>
                </div>
                <div>
                    <span class="text-zinc-400 text-[10px] uppercase font-black block tracking-widest">Total Products</span>
                    <span class="text-zinc-900 dark:text-white font-black text-2xl font-international">{{ number_format($ads->total()) }}</span>
                </div>
            </div>
        </div>

        {{-- Filters & Sort Bar --}}
        <div class="bg-white/50 dark:bg-zinc-900/50 backdrop-blur-md border border-zinc-200 dark:border-zinc-800 rounded-[2.5rem] p-4 mb-12 flex flex-wrap items-center justify-between gap-6 shadow-sm">
            <div class="flex items-center gap-3">
                <button class="bg-zinc-900 dark:bg-zinc-100 text-white dark:text-zinc-900 px-6 py-3 rounded-2xl transition-all flex items-center gap-3 text-xs font-black uppercase tracking-widest hover:scale-105">
                    <i class="fas fa-filter"></i> تصفية
                </button>
                <div class="hidden sm:flex items-center gap-2 text-zinc-400 text-xs font-bold px-4">
                    <i class="fa-solid fa-sort"></i>
                    <span>الأحدث أولاً</span>
                </div>
            </div>
            
            <div class="relative w-full md:w-80 group">
                <input type="text" placeholder="بحث عن منتج..." 
                       class="w-full bg-zinc-100 dark:bg-zinc-800/50 border-none rounded-2xl text-zinc-900 dark:text-white p-4 pr-12 text-xs font-bold focus:ring-2 focus:ring-brand/30 transition-all group-hover:bg-zinc-200 dark:group-hover:bg-zinc-800">
                <i class="fas fa-search absolute right-5 top-1/2 -translate-y-1/2 text-zinc-400 transition-colors group-focus-within:text-brand"></i>
            </div>
        </div>

        {{-- Products Grid --}}
        @if($ads->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-10">
                @foreach($ads as $ad)
                    <div class="group relative flex flex-col transition-all duration-500">
                        
                        {{-- Image Container --}}
                        <div class="relative aspect-[3/4] overflow-hidden rounded-[2.5rem] bg-zinc-100 dark:bg-zinc-900 border border-zinc-200/50 dark:border-zinc-800/50 group-hover:shadow-2xl group-hover:shadow-brand/10">
                            <img src="{{ $ad->primary_image_url ?? 'https://via.placeholder.com/400x600?text=No+Image' }}" 
                                 alt="{{ $ad->title }}" 
                                 class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-1000">
                            
                            {{-- Condition Badge --}}
                            <div class="absolute top-5 right-5 z-20">
                                <span class="bg-white/90 dark:bg-zinc-950/90 backdrop-blur-md text-zinc-900 dark:text-white text-[9px] font-black px-4 py-2 rounded-full uppercase tracking-widest shadow-sm border border-zinc-200 dark:border-zinc-800">
                                    {{ $ad->condition_text }}
                                </span>
                            </div>

                            {{-- Action Overlay --}}
                            <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex items-center justify-center gap-3">
                                <a href="{{ route('ads.show', $ad->slug) }}" class="w-12 h-12 bg-white text-black rounded-full flex items-center justify-center hover:bg-brand hover:text-white transition-all transform translate-y-4 group-hover:translate-y-0 duration-500">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <button class="w-12 h-12 bg-white text-black rounded-full flex items-center justify-center hover:bg-red-500 hover:text-white transition-all transform translate-y-4 group-hover:translate-y-0 duration-500 delay-75">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </div>

                        {{-- Details --}}
                        <div class="mt-6 px-2">
                            <div class="flex items-center gap-2 mb-2 text-[10px] font-black uppercase tracking-[0.2em]">
                                <span class="text-brand">{{ $ad->category->name }}</span>
                                <span class="text-zinc-300 dark:text-zinc-700">•</span>
                                <span class="text-zinc-500 dark:text-zinc-400">{{ $ad->city ?? 'الجزائر' }}</span>
                            </div>
                            
                            <h2 class="text-xl font-black text-zinc-900 dark:text-white mb-4 line-clamp-1 group-hover:text-brand transition-colors tracking-tighter">
                                {{ $ad->title }}
                            </h2>

                            <div class="flex items-center justify-between pt-4 border-t border-zinc-100 dark:border-zinc-800">
                                <div class="flex flex-col">
                                    <span class="text-[9px] text-zinc-400 uppercase font-black tracking-widest mb-1">Price</span>
                                    <span class="text-2xl font-black text-zinc-900 dark:text-white font-international tracking-tighter">
                                        @if($ad->price)
                                            {{ number_format($ad->price) }} <span class="text-brand text-xs">DA</span>
                                        @else
                                            <span class="text-brand text-xs uppercase">Negotiable</span>
                                        @endif
                                    </span>
                                </div>
                                <a href="{{ route('ads.show', $ad->slug) }}" class="w-10 h-10 rounded-xl bg-zinc-100 dark:bg-zinc-800 flex items-center justify-center text-zinc-400 hover:bg-brand hover:text-white transition-all">
                                    <i class="fas fa-arrow-left"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="mt-24 custom-pagination">
                {{ $ads->links() }}
            </div>

        @else
            {{-- Empty State --}}
            <div class="bg-zinc-50 dark:bg-zinc-900/30 rounded-[3rem] border-2 border-dashed border-zinc-200 dark:border-zinc-800 p-24 text-center">
                <div class="mb-8 inline-flex p-8 bg-white dark:bg-zinc-900 rounded-full shadow-xl">
                    <i class="fas fa-shopping-bag text-6xl text-zinc-300 dark:text-zinc-700"></i>
                </div>
                <h3 class="text-3xl font-black text-zinc-900 dark:text-white mb-4">لا توجد منتجات حالياً</h3>
                <p class="text-zinc-500 dark:text-zinc-400 mb-10 max-w-sm mx-auto font-medium">المتجر حالياً فارغ، كن أول من ينشر إعلانه في منصة TRICO العالمية!</p>
                <a href="{{ route('ads.create') }}" class="btn-premium px-12 py-5 rounded-2xl inline-block shadow-2xl shadow-brand/20">
                    انشر إعلانك الآن
                </a>
            </div>
        @endif
    </div>
</div>

<style>
    /* الترقيم الاحترافي */
    .custom-pagination nav { @apply flex justify-center; }
    .custom-pagination nav span[aria-current="page"] span { 
        @apply bg-brand border-brand text-zinc-900 font-black rounded-2xl px-5 py-3 mx-1; 
    }
    .custom-pagination a, .custom-pagination span { 
        @apply bg-white dark:bg-zinc-900 border-zinc-200 dark:border-zinc-800 text-zinc-500 dark:text-zinc-400 rounded-2xl px-5 py-3 mx-1 transition-all hover:border-brand hover:text-brand font-bold; 
    }
</style>
@endsection