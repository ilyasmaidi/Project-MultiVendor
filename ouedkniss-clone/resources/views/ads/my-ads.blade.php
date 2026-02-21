@extends('layouts.app')

@section('title', 'إعلاناتي')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8">إعلاناتي</h1>

    <div class="flex gap-4 mb-6">
        <a href="{{ route('ads.create') }}" class="bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700">
            <i class="fas fa-plus ml-2"></i> إضافة إعلان جديد
        </a>
    </div>

    @if($ads->count() > 0)
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-3 text-right">الإعلان</th>
                        <th class="px-4 py-3 text-right">السعر</th>
                        <th class="px-4 py-3 text-right">الحالة</th>
                        <th class="px-4 py-3 text-right">المشاهدات</th>
                        <th class="px-4 py-3 text-right">التاريخ</th>
                        <th class="px-4 py-3 text-right">الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ads as $ad)
                        <tr class="border-b">
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-3">
                                    @if($ad->images->count() > 0)
                                        <img src="{{ asset('storage/' . $ad->images->first()->image_path) }}" 
                                             alt="" class="w-12 h-12 object-cover rounded">
                                    @else
                                        <div class="w-12 h-12 bg-gray-200 rounded flex items-center justify-center">
                                            <i class="fas fa-image text-gray-400"></i>
                                        </div>
                                    @endif
                                    <div>
                                        <p class="font-bold">{{ $ad->title }}</p>
                                        <p class="text-sm text-gray-500">{{ $ad->category->name }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3">{{ number_format($ad->price, 0) }} د.ج</td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-1 rounded text-sm font-medium
                                    @if($ad->status == 'active') bg-green-100 text-green-800
                                    @elseif($ad->status == 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($ad->status == 'rejected') bg-red-100 text-red-800
                                    @else bg-gray-100 text-gray-800 @endif">
                                    {{ $ad->status == 'active' ? 'نشط' : ($ad->status == 'pending' ? 'قيد المراجعة' : ($ad->status == 'rejected' ? 'مرفوض' : $ad->status)) }}
                                </span>
                            </td>
                            <td class="px-4 py-3">{{ $ad->views_count }}</td>
                            <td class="px-4 py-3 text-sm">{{ $ad->created_at->format('Y-m-d') }}</td>
                            <td class="px-4 py-3">
                                <div class="flex gap-2">
                                    <a href="{{ route('ads.show', $ad->slug) }}" class="text-blue-600 hover:text-blue-800">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('ads.edit', $ad) }}" class="text-yellow-600 hover:text-yellow-800">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('ads.destroy', $ad) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('هل أنت متأكد؟')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-6">
            {{ $ads->links() }}
        </div>
    @else
        <div class="text-center py-12 bg-white rounded-lg shadow-md">
            <i class="fas fa-clipboard-list text-gray-400 text-6xl mb-4"></i>
            <h3 class="text-xl font-bold text-gray-600 mb-2">لا توجد إعلانات</h3>
            <p class="text-gray-500 mb-4">لم تقم بنشر أي إعلان بعد</p>
            <a href="{{ route('ads.create') }}" class="bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700">
                إضافة إعلان جديد
            </a>
        </div>
    @endif
</div>
@endsection
