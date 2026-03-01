@extends('layouts.app')

@section('title', 'إنشاء إعلان جديد | TRICO')

@section('content')
<div class="min-h-screen py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        
        {{-- Header Section --}}
        <div class="text-center mb-12">
            <h1 class="heavy-title text-4xl md:text-5xl text-white mb-4">
                نشر <span class="text-[var(--emerald-light)]">إعلان جديد</span>
            </h1>
            <p class="text-gray-400 font-medium">قم بملء التفاصيل أدناه لعرض منتجك في منصة TRICO العالمية</p>
        </div>

        {{-- Main Form Card --}}
        <form action="{{ route('ads.store') }}" method="POST" enctype="multipart/form-data" 
              class="bg-[var(--card-bg)] border border-gray-800 rounded-3xl shadow-2xl p-8 md:p-10 backdrop-blur-sm">
            @csrf

            <div class="mb-10">
                <div class="flex items-center mb-6">
                    <span class="bg-[var(--emerald-light)] w-2 h-8 rounded-full ml-3"></span>
                    <h3 class="text-xl font-heavy text-white">المعلومات الأساسية</h3>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="col-span-2">
                        <label class="block text-sm font-bold text-gray-300 mb-2">عنوان الإعلان *</label>
                        <input type="text" name="title" required
                               class="w-full bg-[#0f1115] border-gray-700 rounded-xl text-white focus:ring-[var(--emerald-light)] focus:border-[var(--emerald-light)] p-3 transition-all"
                               placeholder="مثال: قميص قطني فاخر براند عالمي"
                               value="{{ old('title') }}">
                        @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-300 mb-2">الفئة *</label>
                        <select name="category_id" required
                                class="w-full bg-[#0f1115] border-gray-700 rounded-xl text-white focus:ring-[var(--emerald-light)] focus:border-[var(--emerald-light)] p-3 cursor-pointer">
                            <option value="">اختر الفئة المناسبة</option>
                            @foreach($categories as $category)
                                <optgroup label="{{ $category->name }}" class="bg-[#1a1d23] text-[var(--emerald-light)]">
                                    @foreach($category->children as $child)
                                        <option value="{{ $child->id }}" {{ old('category_id') == $child->id ? 'selected' : '' }} class="text-white">
                                            {{ $child->name }}
                                        </option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-300 mb-2">الحالة *</label>
                        <select name="condition" required
                                class="w-full bg-[#0f1115] border-gray-700 rounded-xl text-white focus:ring-[var(--emerald-light)] focus:border-[var(--emerald-light)] p-3">
                            <option value="new">جديد (New)</option>
                            <option value="used">مستعمل (Used)</option>
                            <option value="refurbished">مجدد (Refurbished)</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="mb-10 p-6 bg-[#0f1115] rounded-2xl border border-gray-800">
                <div class="flex items-center mb-6">
                    <span class="bg-[var(--emerald-light)] w-2 h-8 rounded-full ml-3"></span>
                    <h3 class="text-xl font-heavy text-white">تفاصيل السعر</h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-300 mb-2">السعر (د.ج)</label>
                        <div class="relative">
                            <input type="number" name="price"
                                   class="w-full bg-[#1a1d23] border-gray-700 rounded-xl text-white focus:ring-[var(--emerald-light)] focus:border-[var(--emerald-light)] p-3"
                                   value="{{ old('price') }}">
                            <span class="absolute left-4 top-3 text-gray-500 font-heavy">DA</span>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-300 mb-2">نوع السعر *</label>
                        <select name="price_type" required
                                class="w-full bg-[#1a1d23] border-gray-700 rounded-xl text-white focus:ring-[var(--emerald-light)] focus:border-[var(--emerald-light)] p-3">
                            <option value="fixed">سعر ثابت</option>
                            <option value="negotiable">قابل للتفاوض</option>
                            <option value="free">مجاني</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="mb-10">
                <div class="flex items-center mb-6">
                    <span class="bg-[var(--emerald-light)] w-2 h-8 rounded-full ml-3"></span>
                    <h3 class="text-xl font-heavy text-white">وصف المنتج والصور</h3>
                </div>
                
                <div class="mb-6">
                    <label class="block text-sm font-bold text-gray-300 mb-2">وصف تفصيلي *</label>
                    <textarea name="description" rows="5" required
                              class="w-full bg-[#0f1115] border-gray-700 rounded-xl text-white focus:ring-[var(--emerald-light)] focus:border-[var(--emerald-light)] p-4"
                              placeholder="تحدث عن خامة المنتج، المقاسات، والماركة...">{{ old('description') }}</textarea>
                </div>

                <div class="relative border-2 border-dashed border-gray-700 rounded-2xl p-8 text-center hover:border-[var(--emerald-light)] transition-colors group">
                    <input type="file" name="images[]" multiple accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                    <i class="fas fa-cloud-upload-alt text-4xl text-gray-500 group-hover:text-[var(--emerald-light)] mb-3 transition-colors"></i>
                    <p class="text-gray-400 font-medium">اسحب الصور هنا أو اضغط للاختيار</p>
                    <p class="text-xs text-gray-600 mt-2">JPG, PNG (Max 2MB per image)</p>
                </div>
            </div>

            <div class="pt-8 border-t border-gray-800 flex flex-col md:flex-row gap-4 items-center justify-between">
                <p class="text-sm text-gray-500 max-w-xs text-center md:text-right">
                    بالنقر على نشر، أنت توافق على شروط استخدام منصة TRICO العالمية.
                </p>
                
                <div class="flex gap-4 w-full md:w-auto">
                    <a href="{{ route('home') }}" 
                       class="flex-1 md:flex-none px-8 py-4 rounded-xl text-gray-400 font-bold hover:bg-gray-800 transition-all text-center">
                        إلغاء
                    </a>
                    <button type="submit" class="btn-premium flex-1 md:flex-none px-12 py-4 rounded-xl shadow-lg shadow-emerald-900/20">
                        نشر الإعلان الآن
                    </button>
                </div>
            </div>

        </form>

        {{-- Verification Note --}}
        <div class="mt-8 flex items-center justify-center text-gray-500 text-sm">
            <i class="fas fa-shield-alt ml-2 text-[var(--emerald-light)]"></i>
            <span>يتم مراجعة جميع الإعلانات من قبل فريق الجودة خلال 24 ساعة لضمان أفضل تجربة للمستخدمين.</span>
        </div>
    </div>
</div>
@endsection