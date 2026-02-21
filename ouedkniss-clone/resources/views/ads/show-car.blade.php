@extends('layouts.app')

@section('title', $ad->title)

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2">
            <!-- Image Gallery -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
                @if($ad->images->count() > 0)
                    <div class="relative h-96">
                        <img src="{{ asset('storage/' . $ad->images->first()->image_path) }}" 
                             alt="{{ $ad->title }}" 
                             class="w-full h-full object-cover">
                        @if($ad->is_featured)
                            <span class="absolute top-4 right-4 bg-yellow-500 text-white px-3 py-1 rounded-full text-sm font-bold">
                                مميز
                            </span>
                        @endif
                    </div>
                @else
                    <div class="h-96 bg-gray-200 flex items-center justify-center">
                        <span class="text-gray-500">لا توجد صور</span>
                    </div>
                @endif
            </div>

            <!-- Car Details -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h1 class="text-2xl font-bold mb-4">{{ $ad->title }}</h1>
                <p class="text-gray-600 mb-4">{{ $ad->location }} - {{ $ad->city }}</p>
                
                <div class="flex items-center justify-between mb-6">
                    <span class="text-3xl font-bold text-red-600">
                        {{ number_format($ad->price, 0) }} د.ج
                    </span>
                    <span class="text-gray-500">{{ $ad->condition === 'new' ? 'جديد' : 'مستعمل' }}</span>
                </div>

                <!-- Car Specific Attributes -->
                @php
                    $carAttributes = [
                        'year' => ['icon' => 'fa-calendar', 'label' => 'السنة'],
                        'brand' => ['icon' => 'fa-car', 'label' => 'الماركة'],
                        'model' => ['icon' => 'fa-tag', 'label' => 'الموديل'],
                        'mileage' => ['icon' => 'fa-tachometer-alt', 'label' => 'المسافة (كم)'],
                        'fuel_type' => ['icon' => 'fa-gas-pump', 'label' => 'نوع الوقود'],
                        'transmission' => ['icon' => 'fa-cog', 'label' => 'ناقل الحركة'],
                        'color' => ['icon' => 'fa-palette', 'label' => 'اللون'],
                        'engine_size' => ['icon' => 'fa-engine', 'label' => 'سعة المحرك'],
                    ];
                @endphp

                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                    @foreach($ad->attributes as $attribute)
                        @if(isset($carAttributes[$attribute->name]))
                            <div class="bg-gray-50 p-4 rounded-lg text-center">
                                <i class="fas {{ $carAttributes[$attribute->name]['icon'] }} text-2xl mb-2 text-gray-600"></i>
                                <p class="text-sm text-gray-500">{{ $carAttributes[$attribute->name]['label'] }}</p>
                                <p class="font-bold">{{ $attribute->pivot->value }}</p>
                            </div>
                        @endif
                    @endforeach
                </div>

                <div class="prose max-w-none">
                    <h3 class="text-lg font-bold mb-2">الوصف</h3>
                    <p class="text-gray-700">{{ $ad->description }}</p>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <!-- Contact Card -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h3 class="text-lg font-bold mb-4">معلومات الاتصال</h3>
                
                @if($ad->show_contact_info)
                    @if($ad->contact_phone)
                        <a href="tel:{{ $ad->contact_phone }}" 
                           class="flex items-center justify-center w-full bg-blue-600 text-white py-3 rounded-lg mb-3 hover:bg-blue-700">
                            <i class="fas fa-phone ml-2"></i>
                            {{ $ad->contact_phone }}
                        </a>
                    @endif
                    
                    @if($ad->contact_whatsapp)
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $ad->contact_whatsapp) }}" 
                           target="_blank"
                           class="flex items-center justify-center w-full bg-green-500 text-white py-3 rounded-lg mb-3 hover:bg-green-600">
                            <i class="fab fa-whatsapp ml-2"></i>
                            واتساب
                        </a>
                    @endif
                @else
                    <p class="text-gray-500 text-center">التواصل عبر النموذج فقط</p>
                @endif

                <livewire:contact-form :ad-id="$ad->id" />
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-bold mb-4">إجراءات سريعة</h3>
                <button class="w-full bg-red-100 text-red-600 py-2 rounded-lg mb-2 hover:bg-red-200">
                    <i class="fas fa-heart ml-2"></i> إضافة للمفضلة
                </button>
                <button class="w-full bg-gray-100 text-gray-600 py-2 rounded-lg hover:bg-gray-200">
                    <i class="fas fa-flag ml-2"></i> الإبلاغ عن إعلان
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
