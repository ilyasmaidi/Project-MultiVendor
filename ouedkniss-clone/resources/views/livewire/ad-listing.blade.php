@extends('layouts.app')

@section('title', 'الإعلانات')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Filters Sidebar -->
        <div class="lg:w-1/4">
            <div class="bg-white rounded-lg shadow-md p-6 sticky top-20">
                <h3 class="font-bold text-lg mb-4">تصفية النتائج</h3>

                <!-- Search -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">البحث</label>
                    <input type="text" wire:model.live="search"
                           class="w-full border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500"
                           placeholder="بحث في الإعلانات...">
                </div>

                <!-- Category Filter -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">الفئة</label>
                    <select wire:model.live="category"
                            class="w-full border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500">
                        <option value="">جميع الفئات</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->slug }}">{{ $cat->name }}</option>
                            @foreach($cat->children as $child)
                                <option value="{{ $child->slug }}">— {{ $child->name }}</option>
                            @endforeach
                        @endforeach
                    </select>
                </div>

                <!-- Price Range -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">نطاق السعر</label>
                    <div class="flex gap-2">
                        <input type="number" wire:model.live="minPrice" placeholder="من"
                               class="w-1/2 border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500">
                        <input type="number" wire:model.live="maxPrice" placeholder="إلى"
                               class="w-1/2 border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500">
                    </div>
                </div>

                <!-- City Filter -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">المدينة</label>
                    <input type="text" wire:model.live="city"
                           class="w-full border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500"
                           placeholder="المدينة">
                </div>

                <!-- Condition Filter -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">الحالة</label>
                    <select wire:model.live="condition"
                            class="w-full border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500">
                        <option value="">الكل</option>
                        <option value="new">جديد</option>
                        <option value="used">مستعمل</option>
                        <option value="refurbished">مجدد</option>
                    </select>
                </div>

                <!-- Sort -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">الترتيب</label>
                    <select wire:model.live="sortBy"
                            class="w-full border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500">
                        <option value="latest">الأحدث</option>
                        <option value="oldest">الأقدم</option>
                        <option value="price_asc">السعر: من الأقل</option>
                        <option value="price_desc">السعر: من الأعلى</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Ads Grid -->
        <div class="lg:w-3/4">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold">الإعلانات</h2>
                <span class="text-gray-500">{{ $ads->total() }} إعلان</span>
            </div>

            @if($ads->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($ads as $ad)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                            <div class="relative h-48">
                                @if($ad->images->count() > 0)
                                    <img src="{{ asset('storage/' . $ad->images->first()->image_path) }}"
                                         alt="{{ $ad->title }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                        <i class="fas fa-image text-gray-400 text-4xl"></i>
                                    </div>
                                @endif
                                @if($ad->is_featured)
                                    <span class="absolute top-2 right-2 bg-yellow-500 text-white px-2 py-1 rounded text-xs font-bold">مميز</span>
                                @endif
                            </div>
                            <div class="p-4">
                                <h3 class="font-bold text-lg mb-2 truncate">{{ $ad->title }}</h3>
                                <p class="text-red-600 font-bold">{{ number_format($ad->price, 0) }} د.ج</p>
                                <div class="flex justify-between items-center mt-2 text-sm text-gray-500">
                                    <span><i class="fas fa-map-marker-alt"></i> {{ $ad->city }}</span>
                                    <span>{{ $ad->created_at->diffForHumans() }}</span>
                                </div>
                                <a href="{{ route('ads.show', $ad->slug) }}" class="mt-3 block text-center bg-gray-100 text-gray-700 py-2 rounded hover:bg-gray-200">
                                    عرض التفاصيل
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-8">
                    {{ $ads->links() }}
                </div>
            @else
                <div class="text-center py-12">
                    <i class="fas fa-search text-gray-400 text-6xl mb-4"></i>
                    <h3 class="text-xl font-bold text-gray-600 mb-2">لا توجد نتائج</h3>
                    <p class="text-gray-500">جرب تغيير معايير البحث</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
