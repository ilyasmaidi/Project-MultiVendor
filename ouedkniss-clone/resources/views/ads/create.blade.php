@extends('layouts.app')

@section('title', 'إنشاء إعلان جديد')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-4xl">
    <h1 class="text-3xl font-bold mb-8 text-center">إنشاء إعلان جديد</h1>

    <form action="{{ route('ads.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow-md p-6">
        @csrf

        <!-- Basic Info -->
        <div class="mb-6">
            <h3 class="text-lg font-bold mb-4 border-b pb-2">معلومات أساسية</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">عنوان الإعلان *</label>
                    <input type="text" name="title" required
                           class="w-full border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500"
                           value="{{ old('title') }}">
                    @error('title')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">الفئة *</label>
                    <select name="category_id" required
                            class="w-full border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500">
                        <option value="">اختر الفئة</option>
                        @foreach($categories as $category)
                            <optgroup label="{{ $category->name }}">
                                @foreach($category->children as $child)
                                    <option value="{{ $child->id }}" {{ old('category_id') == $child->id ? 'selected' : '' }}>
                                        {{ $child->name }}
                                    </option>
                                @endforeach
                            </optgroup>
                        @endforeach
                    </select>
                    @error('category_id')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">الحالة *</label>
                    <select name="condition" required
                            class="w-full border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500">
                        <option value="new" {{ old('condition') == 'new' ? 'selected' : '' }}>جديد</option>
                        <option value="used" {{ old('condition') == 'used' ? 'selected' : '' }}>مستعمل</option>
                        <option value="refurbished" {{ old('condition') == 'refurbished' ? 'selected' : '' }}>مجدد</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Price -->
        <div class="mb-6">
            <h3 class="text-lg font-bold mb-4 border-b pb-2">السعر</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">السعر (د.ج)</label>
                    <input type="number" name="price" min="0"
                           class="w-full border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500"
                           value="{{ old('price') }}">
                    @error('price')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">نوع السعر *</label>
                    <select name="price_type" required
                            class="w-full border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500">
                        <option value="fixed" {{ old('price_type') == 'fixed' ? 'selected' : '' }}>ثابت</option>
                        <option value="negotiable" {{ old('price_type') == 'negotiable' ? 'selected' : '' }}>قابل للتفاوض</option>
                        <option value="free" {{ old('price_type') == 'free' ? 'selected' : '' }}>مجاني</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Description -->
        <div class="mb-6">
            <h3 class="text-lg font-bold mb-4 border-b pb-2">الوصف</h3>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">وصف الإعلان *</label>
                <textarea name="description" rows="5" required
                          class="w-full border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500"
                          placeholder="اكتب وصفاً تفصيلياً للمنتج...">{{ old('description') }}</textarea>
                @error('description')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
            </div>
        </div>

        <!-- Location -->
        <div class="mb-6">
            <h3 class="text-lg font-bold mb-4 border-b pb-2">الموقع</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">المدينة</label>
                    <input type="text" name="city"
                           class="w-full border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500"
                           value="{{ old('city') }}" placeholder="مثال: الجزائر العاصمة">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">العنوان التفصيلي</label>
                    <input type="text" name="location"
                           class="w-full border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500"
                           value="{{ old('location') }}" placeholder="مثال: حي القبة">
                </div>
            </div>
        </div>

        <!-- Contact Info -->
        <div class="mb-6">
            <h3 class="text-lg font-bold mb-4 border-b pb-2">معلومات الاتصال</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">رقم الهاتف</label>
                    <input type="tel" name="contact_phone"
                           class="w-full border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500"
                           value="{{ old('contact_phone', auth()->user()->phone) }}" placeholder="05xxxxxxxx">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">واتساب</label>
                    <input type="tel" name="contact_whatsapp"
                           class="w-full border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500"
                           value="{{ old('contact_whatsapp', auth()->user()->whatsapp) }}" placeholder="05xxxxxxxx">
                </div>
            </div>
        </div>

        <!-- Images -->
        <div class="mb-6">
            <h3 class="text-lg font-bold mb-4 border-b pb-2">الصور</h3>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">صور المنتج (يمكنك رفع عدة صور)</label>
                <input type="file" name="images[]" multiple accept="image/*"
                       class="w-full border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500">
                <p class="text-sm text-gray-500 mt-1">الحد الأقصى 2MB لكل صورة</p>
                @error('images')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
            </div>
        </div>

        <!-- Submit -->
        <div class="flex justify-center gap-4">
            <button type="submit" class="bg-red-600 text-white px-8 py-3 rounded-lg hover:bg-red-700 font-bold">
                <i class="fas fa-plus ml-2"></i> نشر الإعلان
            </button>
            <a href="{{ route('home') }}" class="bg-gray-200 text-gray-700 px-8 py-3 rounded-lg hover:bg-gray-300 font-bold">
                إلغاء
            </a>
        </div>

        <p class="text-center text-sm text-gray-500 mt-4">
            سيتم مراجعة إعلانك قبل نشره. قد يستغرق ذلك حتى 24 ساعة.
        </p>
    </form>
</div>
@endsection
