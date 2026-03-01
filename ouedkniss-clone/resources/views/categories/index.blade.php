@extends('layouts.app')

@section('title', 'الفئات')

@section('content')
<div style="background-color: #e6e6fa; padding: 10px; border: 2px solid #9370db; margin-bottom: 20px;">
    <h1 style="color: black; font-weight: bold; text-align: center;">هذا الملف هو: <code>resources/views/categories/index.blade.php</code></h1>
</div>
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8 text-center">جميع الفئات</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($categories as $category)
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="p-6">
                    <div class="flex items-center gap-3 mb-4">
                        @if($category->icon)
                            <i class="{{ $category->icon }} text-3xl text-red-600"></i>
                        @else
                            <i class="fas fa-folder text-3xl text-red-600"></i>
                        @endif
                        <h2 class="text-xl font-bold">{{ $category->name }}</h2>
                    </div>

                    @if($category->children->count() > 0)
                        <ul class="space-y-2">
                            @foreach($category->children as $child)
                                <li>
                                    <a href="{{ route('ads.by-category', $child->slug) }}" 
                                       class="flex items-center justify-between text-gray-600 hover:text-red-600">
                                        <span>{{ $child->name }}</span>
                                        <span class="text-sm text-gray-400">({{ $child->ads()->active()->count() }})</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-gray-500 text-sm">لا توجد أقسام فرعية</p>
                    @endif

                    <a href="{{ route('ads.by-category', $category->slug) }}" 
                       class="mt-4 block text-center bg-red-600 text-white py-2 rounded-lg hover:bg-red-700">
                        عرض جميع الإعلانات
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
