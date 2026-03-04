@extends('layouts.app')

@section('title', 'الرئيسية | TRICO')

@section('content')
    @include('components.hero')

    <section class="container mx-auto px-4 py-12 border-y border-white/5 my-20">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
            <div class="text-center">
                <h3 class="font-international font-black text-4xl mb-2 text-emerald-500">500+</h3>
                <p class="text-xs text-gray-500 font-bold uppercase">ماركة عالمية</p>
            </div>
            </div>
    </section>

    <x-category-grid />
@endsection