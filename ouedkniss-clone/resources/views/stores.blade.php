@extends('layouts.app')

@section('title', 'المتاجر العالمية | TRICO')

@section('content')
    <div class="container mx-auto px-4 py-20">
        <h2 class="heavy-title text-5xl mb-12">المتاجر <span class="text-emerald-500">الموثوقة</span></h2>
        
        <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-white/5 p-8 border border-white/10 rounded-3xl hover:border-emerald-500 transition-all">
                <div class="w-16 h-16 bg-emerald-500 rounded-full mb-6"></div>
                <h3 class="text-xl font-bold mb-2">اسم المتجر</h3>
                <p class="text-gray-400 text-sm mb-6">هذا المتجر يقدم أحدث صيحات الموضة العالمية.</p>
                <a href="#" class="text-emerald-500 font-bold text-xs uppercase tracking-widest">زيارة المتجر ←</a>
            </div>
        </div>
    </div>
@endsection