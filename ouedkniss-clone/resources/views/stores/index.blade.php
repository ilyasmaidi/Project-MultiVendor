@extends('layouts.app')

@section('title', 'المتاجر')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8 text-center">المتاجر</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach($stores as $store)
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                <div class="h-32 bg-gradient-to-r from-red-500 to-red-600 flex items-center justify-center">
                    @if($store->logo)
                        <img src="{{ asset('storage/' . $store->logo) }}" alt="" class="w-24 h-24 object-cover rounded-full border-4 border-white">
                    @else
                        <div class="w-24 h-24 bg-white rounded-full flex items-center justify-center">
                            <i class="fas fa-store text-4xl text-red-600"></i>
                        </div>
                    @endif
                </div>
                <div class="p-4 text-center">
                    <h3 class="font-bold text-lg mb-2">{{ $store->name }}</h3>
                    <p class="text-gray-500 text-sm mb-2">{{ Str::limit($store->description, 50) }}</p>
                    
                    <div class="flex justify-center gap-4 text-sm text-gray-600 mb-4">
                        <span><i class="fas fa-ad"></i> {{ $store->ads()->count() }} إعلان</span>
                        @if($store->is_verified)
                            <span class="text-blue-600"><i class="fas fa-check-circle"></i> موثق</span>
                        @endif
                    </div>

                    <a href="{{ route('stores.show', $store->slug) }}" 
                       class="block bg-red-600 text-white py-2 rounded-lg hover:bg-red-700">
                        زيارة المتجر
                    </a>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-8">
        {{ $stores->links() }}
    </div>
</div>
@endsection
