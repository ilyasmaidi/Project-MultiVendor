@extends('layouts.app')

@section('title', 'مشترياتي | TRICO')

@section('content')
<div class="bg-zinc-50 dark:bg-[#0c0c0e] min-h-screen py-32 transition-colors duration-500 font-sans" dir="rtl">
    <div class="max-w-4xl mx-auto px-6">
        {{-- العنوان الرئيسي --}}
        <div class="flex items-end justify-between mb-12">
            <div>
                <span class="text-emerald-500 text-[10px] font-black uppercase tracking-[0.3em]">سجل العمليات</span>
                <h2 class="text-5xl font-black text-zinc-900 dark:text-zinc-50 tracking-tighter uppercase italic">مشترياتي</h2>
            </div>
            <span class="text-zinc-400 text-sm font-bold italic">{{ $orders->count() }} طلبات</span>
        </div>

        <div class="space-y-8">
            @forelse($orders as $order)
                <div class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 p-8 rounded-[3rem] shadow-sm relative overflow-hidden group hover:border-emerald-500/30 transition-all duration-500">
                    
                    {{-- شريط الحالة العلوي --}}
                    <div class="absolute top-0 left-0 w-full h-1 bg-zinc-100 dark:bg-zinc-800">
                        <div class="h-full {{ $order->status == 'shipping' ? 'bg-emerald-500' : 'bg-amber-500' }} transition-all duration-1000" 
                             style="width: {{ $order->status == 'shipping' ? '100%' : '30%' }}"></div>
                    </div>
                    
                    <div class="flex flex-wrap justify-between items-start gap-4">
                        <div class="space-y-1">
                            <span class="text-[9px] font-black text-zinc-400 uppercase tracking-[0.2em]">حالة الطلب الآن</span>
                            <div class="flex items-center gap-2">
                                <span class="relative flex h-2 w-2">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full {{ $order->status == 'shipping' ? 'bg-emerald-400' : 'bg-amber-400' }} opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-2 w-2 {{ $order->status == 'shipping' ? 'bg-emerald-500' : 'bg-amber-500' }}"></span>
                                </span>
                                <h4 class="text-lg font-black {{ $order->status == 'shipping' ? 'text-emerald-500' : 'text-amber-500' }} uppercase italic">
                                    {{ $order->status == 'pending' ? 'قيد المعالجة' : ($order->status == 'shipping' ? 'في الطريق إليك' : 'تم الاستلام') }}
                                </h4>
                            </div>
                        </div>
                        <div class="text-left">
                            <span class="block text-[9px] font-black text-zinc-400 uppercase tracking-[0.2em]">رقم المرجع</span>
                            <span class="font-black text-zinc-900 dark:text-white tracking-tighter italic">#TRC-{{ $order->id + 1000 }}</span>
                        </div>
                    </div>

                    <div class="mt-10 flex flex-col md:flex-row md:items-center gap-8">
                        {{-- صورة المنتج --}}
                        <div class="relative group">
                            <div class="w-24 h-32 rounded-[2rem] overflow-hidden bg-zinc-100 dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-800">
                                <img src="{{ asset('storage/' . ($order->listing->image ?? 'default.jpg')) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            </div>
                        </div>

                        {{-- معلومات المنتج --}}
                        <div class="flex-1 space-y-3">
                            <div>
                                <h3 class="text-xl font-black text-zinc-900 dark:text-white uppercase italic tracking-tight">{{ $order->listing->title ?? 'منتج غير متوفر' }}</h3>
                                <p class="text-[10px] text-zinc-400 font-bold uppercase tracking-widest mt-1">
                                    <i class="fas fa-store ml-1"></i> {{ $order->seller->name ?? 'بائع مجهول' }}
                                </p>
                            </div>
                            
                            <div class="flex gap-3">
                                <span class="text-[9px] font-black text-zinc-500 bg-zinc-100 dark:bg-zinc-800 px-4 py-1.5 rounded-full uppercase tracking-widest">{{ $order->size }}</span>
                                <span class="text-[9px] font-black text-zinc-500 bg-zinc-100 dark:bg-zinc-800 px-4 py-1.5 rounded-full uppercase tracking-widest">{{ $order->color }}</span>
                            </div>
                        </div>

                        {{-- السعر --}}
                        <div class="md:text-left border-t md:border-t-0 pt-6 md:pt-0 border-zinc-100 dark:border-zinc-800">
                            <span class="block text-[9px] font-black text-zinc-400 uppercase tracking-[0.2em] mb-1">المبلغ الإجمالي</span>
                            <span class="text-3xl font-black text-zinc-900 dark:text-white italic tracking-tighter">
                                {{ number_format($order->total_price) }}
                                <span class="text-xs text-emerald-500 not-italic ml-1">DZD</span>
                            </span>
                        </div>
                    </div>

                    {{-- تفاصيل الشحن السريعة --}}
                    <div class="mt-8 pt-6 border-t border-zinc-50 dark:border-zinc-800/50 flex justify-between items-center">
                        <p class="text-[10px] text-zinc-400 font-medium italic">
                            <i class="fas fa-map-marker-alt ml-2"></i> يتم التوصيل إلى: {{ $order->city }}
                        </p>
                        <a href="#" class="text-[9px] font-black text-zinc-400 hover:text-emerald-500 uppercase tracking-[0.2em] transition-colors">
                            تفاصيل الفاتورة <i class="fas fa-chevron-left mr-2"></i>
                        </a>
                    </div>
                </div>
            @empty
                <div class="text-center py-24 bg-white dark:bg-zinc-900 rounded-[4rem] border-2 border-dashed border-zinc-200 dark:border-zinc-800">
                    <div class="mb-6 opacity-20">
                        <i class="fas fa-shopping-bag text-6xl text-zinc-400"></i>
                    </div>
                    <h3 class="text-xl font-black text-zinc-400 uppercase italic">لم تقم بأي عمليات شراء بعد</h3>
                    <a href="/" class="inline-block mt-8 text-[10px] font-black text-emerald-500 uppercase tracking-[0.3em] border-b-2 border-emerald-500 pb-1 hover:text-emerald-400 hover:border-emerald-400 transition-all">ابدأ التسوق الآن</a>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection