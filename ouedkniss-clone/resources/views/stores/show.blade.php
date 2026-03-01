@extends('layouts.app')

@section('title', $store->name)

@section('content')
<div style="background-color: #ffe4e1; padding: 10px; border: 2px solid #fa8072; margin-bottom: 20px;">
    <h1 style="color: black; font-weight: bold; text-align: center;">هذا الملف هو: <code>resources/views/stores/show.blade.php</code></h1>
</div>
<div class="bg-white">
    <!-- Store Header -->
    <div class="bg-gradient-to-r from-red-600 to-red-700 text-white py-12">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row items-center gap-6">
                @if($store->logo)
                    <img src="{{ asset('storage/' . $store->logo) }}" alt="" class="w-32 h-32 object-cover rounded-full border-4 border-white">
                @else
                    <div class="w-32 h-32 bg-white rounded-full flex items-center justify-center">
                        <i class="fas fa-store text-5xl text-red-600"></i>
                    </div>
                @endif
                <div class="text-center md:text-right">
                    <h1 class="text-3xl font-bold mb-2">{{ $store->name }}</h1>
                    @if($store->is_verified)
                        <span class="inline-block bg-white text-red-600 px-3 py-1 rounded-full text-sm font-bold mb-2">
                            <i class="fas fa-check-circle ml-1"></i> متجر موثق
                        </span>
                    @endif
                    <p class="text-red-100">{{ $store->description }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Store Info Bar -->
    <div class="bg-gray-100 py-4">
        <div class="container mx-auto px-4">
            <div class="flex flex-wrap justify-center md:justify-start gap-6 text-sm">
                <span><i class="fas fa-map-marker-alt text-red-600 ml-1"></i> {{ $store->location ?? 'الجزائر' }}</span>
                <span><i class="fas fa-ad text-red-600 ml-1"></i> {{ $store->ads()->count() }} إعلان</span>
                <span><i class="fas fa-eye text-red-600 ml-1"></i> {{ $store->ads()->sum('views_count') }} مشاهدة</span>
                @if($store->phone)
                    <span><i class="fas fa-phone text-red-600 ml-1"></i> {{ $store->phone }}</span>
                @endif
            </div>
        </div>
    </div>

    <!-- Store Ads -->
    <div class="container mx-auto px-4 py-8">
        <h2 class="text-2xl font-bold mb-6">إعلانات المتجر</h2>

        @if($store->ads->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($store->ads as $ad)
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
        @else
            <div class="text-center py-12">
                <i class="fas fa-clipboard-list text-gray-400 text-6xl mb-4"></i>
                <h3 class="text-xl font-bold text-gray-600">لا توجد إعلانات</h3>
                <p class="text-gray-500">لم يقم هذا المتجر بنشر أي إعلانات بعد</p>
            </div>
        @endif
    </div>
</div>
@endsection
