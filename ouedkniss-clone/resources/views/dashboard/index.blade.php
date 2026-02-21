@extends('layouts.dashboard')

@section('title', 'لوحة التحكم')
@section('page-title', 'نظرة عامة')

@section('content')
    <!-- Stats Cards -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="card stat-card p-5">
            <div class="flex items-center justify-between mb-3">
                <div class="w-12 h-12 rounded-xl bg-emerald-500/20 flex items-center justify-center">
                    <i class="fa-solid fa-newspaper text-emerald-400 text-xl"></i>
                </div>
                <span class="text-xs text-gray-500">إعلاناتي</span>
            </div>
            <p class="text-3xl font-black font-international">{{ $stats['total_ads'] }}</p>
            <p class="text-xs text-emerald-400 mt-1">{{ $stats['active_ads'] }} نشط</p>
        </div>
        
        <div class="card stat-card p-5">
            <div class="flex items-center justify-between mb-3">
                <div class="w-12 h-12 rounded-xl bg-blue-500/20 flex items-center justify-center">
                    <i class="fa-solid fa-eye text-blue-400 text-xl"></i>
                </div>
                <span class="text-xs text-gray-500">المشاهدات</span>
            </div>
            <p class="text-3xl font-black font-international">{{ number_format($stats['total_views']) }}</p>
            <p class="text-xs text-blue-400 mt-1">إجمالي المشاهدات</p>
        </div>
        
        <div class="card stat-card p-5">
            <div class="flex items-center justify-between mb-3">
                <div class="w-12 h-12 rounded-xl bg-amber-500/20 flex items-center justify-center">
                    <i class="fa-solid fa-envelope text-amber-400 text-xl"></i>
                </div>
                <span class="text-xs text-gray-500">الرسائل</span>
            </div>
            <p class="text-3xl font-black font-international">{{ $stats['unread_messages'] }}</p>
            <p class="text-xs text-amber-400 mt-1">غير مقروءة</p>
        </div>
        
        <div class="card stat-card p-5">
            <div class="flex items-center justify-between mb-3">
                <div class="w-12 h-12 rounded-xl bg-rose-500/20 flex items-center justify-center">
                    <i class="fa-solid fa-heart text-rose-400 text-xl"></i>
                </div>
                <span class="text-xs text-gray-500">المفضلة</span>
            </div>
            <p class="text-3xl font-black font-international">{{ $stats['favorites_count'] }}</p>
            <p class="text-xs text-rose-400 mt-1">محفوظة</p>
        </div>
    </div>
    
    @if($storeStats)
        <!-- Store Stats for Vendors -->
        <div class="card p-6 mb-6 border-l-4 border-emerald-500">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-bold text-lg">إحصائيات المتجر</h3>
                <a href="{{ route('vendor.dashboard') }}" class="text-sm text-emerald-400 hover:text-emerald-300">
                    لوحة المتجر <i class="fa-solid fa-arrow-left mr-1"></i>
                </a>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="text-center">
                    <p class="text-2xl font-black text-emerald-400">{{ $storeStats['store_views'] }}</p>
                    <p class="text-xs text-gray-500">مشاهدات المتجر</p>
                </div>
                <div class="text-center">
                    <p class="text-2xl font-black text-emerald-400">{{ $storeStats['store_ads'] }}</p>
                    <p class="text-xs text-gray-500">إعلانات المتجر</p>
                </div>
                <div class="text-center">
                    <p class="text-2xl font-black text-emerald-400">{{ $storeStats['featured_ads'] }}</p>
                    <p class="text-xs text-gray-500">إعلانات مميزة</p>
                </div>
                <div class="text-center">
                    <p class="text-2xl font-black text-emerald-400">{{ auth()->user()->store->is_verified ? 'نعم' : 'لا' }}</p>
                    <p class="text-xs text-gray-500">موثق</p>
                </div>
            </div>
        </div>
    @endif
    
    <div class="grid lg:grid-cols-3 gap-6">
        <!-- Recent Ads -->
        <div class="lg:col-span-2">
            <div class="card p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="font-bold text-lg">إعلاناتي الحديثة</h3>
                    <a href="{{ route('ads.create') }}" class="btn-premium px-4 py-2 rounded-lg text-xs">
                        <i class="fa-solid fa-plus mr-1"></i> إضافة إعلان
                    </a>
                </div>
                
                @if($recentAds->count() > 0)
                    <div class="space-y-4">
                        @foreach($recentAds as $ad)
                            <div class="flex items-center gap-4 p-4 bg-white/5 rounded-lg hover:bg-white/10 transition-colors">
                                <div class="w-16 h-16 rounded-lg bg-emerald-500/10 flex items-center justify-center flex-shrink-0 overflow-hidden">
                                    @if($ad->images->first())
                                        <img src="{{ asset('storage/' . $ad->images->first()->image_path) }}" alt="" class="w-full h-full object-cover">
                                    @else
                                        <i class="fa-solid fa-image text-emerald-400"></i>
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="font-bold truncate">{{ $ad->title }}</h4>
                                    <div class="flex items-center gap-3 mt-1 text-xs text-gray-500">
                                        <span class="badge {{ $ad->status === 'active' ? 'badge-emerald' : ($ad->status === 'pending' ? 'badge-amber' : 'badge-rose') }}">
                                            {{ $ad->status === 'active' ? 'نشط' : ($ad->status === 'pending' ? 'قيد المراجعة' : 'منتهي') }}
                                        </span>
                                        <span>{{ $ad->created_at->diffForHumans() }}</span>
                                        <span><i class="fa-solid fa-eye mr-1"></i>{{ $ad->views_count ?? 0 }}</span>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('ads.show', $ad->slug) }}" class="p-2 text-gray-400 hover:text-emerald-400 transition-colors">
                                        <i class="fa-solid fa-external-link-alt"></i>
                                    </a>
                                    <a href="{{ route('ads.edit', $ad) }}" class="p-2 text-gray-400 hover:text-emerald-400 transition-colors">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    @if($stats['total_ads'] > 5)
                        <div class="mt-4 text-center">
                            <a href="{{ route('my-ads') }}" class="text-sm text-emerald-400 hover:text-emerald-300">
                                عرض كل الإعلانات <i class="fa-solid fa-arrow-left mr-1"></i>
                            </a>
                        </div>
                    @endif
                @else
                    <div class="text-center py-8 text-gray-500">
                        <i class="fa-solid fa-newspaper text-4xl mb-4 opacity-30"></i>
                        <p>ليس لديك إعلانات بعد</p>
                        <a href="{{ route('ads.create') }}" class="btn-premium px-6 py-2 rounded-lg text-xs mt-4 inline-block">
                            إضافة أول إعلان
                        </a>
                    </div>
                @endif
            </div>
        </div>
        
        <!-- Side Column -->
        <div class="space-y-6">
            <!-- Recent Messages -->
            <div class="card p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-bold">رسائل جديدة</h3>
                    <a href="{{ route('messages.index') }}" class="text-xs text-emerald-400 hover:text-emerald-300">عرض الكل</a>
                </div>
                
                @if($recentMessages->count() > 0)
                    <div class="space-y-3">
                        @foreach($recentMessages as $message)
                            <a href="{{ route('messages.show', ['user' => $message->sender->id]) }}" class="flex items-start gap-3 p-3 bg-white/5 rounded-lg hover:bg-white/10 transition-colors">
                                <div class="w-10 h-10 rounded-full bg-emerald-500/20 flex items-center justify-center flex-shrink-0">
                                    <i class="fa-solid fa-user text-emerald-400"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="font-bold text-sm truncate">{{ $message->sender->name }}</p>
                                    <p class="text-xs text-gray-500 truncate">{{ Str::limit($message->content, 40) }}</p>
                                    <p class="text-[10px] text-gray-600 mt-1">{{ $message->created_at->diffForHumans() }}</p>
                                </div>
                                @if(!$message->read_at)
                                    <span class="w-2 h-2 bg-emerald-500 rounded-full flex-shrink-0"></span>
                                @endif
                            </a>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-4 text-gray-500 text-sm">
                        <i class="fa-solid fa-envelope-open text-2xl mb-2 opacity-30"></i>
                        <p>لا توجد رسائل جديدة</p>
                    </div>
                @endif
            </div>
            
            <!-- Quick Actions -->
            <div class="card p-6">
                <h3 class="font-bold mb-4">إجراءات سريعة</h3>
                <div class="space-y-2">
                    <a href="{{ route('ads.create') }}" class="flex items-center gap-3 p-3 bg-white/5 rounded-lg hover:bg-emerald-500/10 hover:text-emerald-400 transition-colors">
                        <i class="fa-solid fa-plus-circle"></i>
                        <span class="text-sm font-bold">إضافة إعلان جديد</span>
                    </a>
                    <a href="{{ route('favorites.index') }}" class="flex items-center gap-3 p-3 bg-white/5 rounded-lg hover:bg-rose-500/10 hover:text-rose-400 transition-colors">
                        <i class="fa-solid fa-heart"></i>
                        <span class="text-sm font-bold">المفضلة</span>
                    </a>
                    <a href="{{ route('notifications.index') }}" class="flex items-center gap-3 p-3 bg-white/5 rounded-lg hover:bg-amber-500/10 hover:text-amber-400 transition-colors">
                        <i class="fa-solid fa-bell"></i>
                        <span class="text-sm font-bold">الإشعارات</span>
                    </a>
                    @if(auth()->user()->hasStore())
                        <a href="{{ route('vendor.store.settings') }}" class="flex items-center gap-3 p-3 bg-white/5 rounded-lg hover:bg-blue-500/10 hover:text-blue-400 transition-colors">
                            <i class="fa-solid fa-store"></i>
                            <span class="text-sm font-bold">إعدادات المتجر</span>
                        </a>
                    @elseif(auth()->user()->canCreateStore())
                        <a href="{{ route('store.setup') }}" class="flex items-center gap-3 p-3 bg-emerald-500/10 text-emerald-400 rounded-lg hover:bg-emerald-500/20 transition-colors">
                            <i class="fa-solid fa-store"></i>
                            <span class="text-sm font-bold">إنشاء متجر</span>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
