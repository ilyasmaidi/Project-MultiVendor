@php
$currentRoute = request()->route()->getName();
@endphp

<div class="space-y-1">
    <p class="px-4 py-2 text-xs font-bold text-gray-500 uppercase tracking-wider">الرئيسية</p>
    
    <a href="{{ route('dashboard') }}" class="sidebar-link {{ str_starts_with($currentRoute, 'dashboard') ? 'active' : '' }}">
        <i class="fa-solid fa-grid-2"></i>
        <span>نظرة عامة</span>
    </a>
    
    <a href="{{ route('my-ads') }}" class="sidebar-link {{ str_starts_with($currentRoute, 'my-ads') || str_starts_with($currentRoute, 'ads.edit') ? 'active' : '' }}">
        <i class="fa-solid fa-newspaper"></i>
        <span>إعلاناتي</span>
    </a>
    
    <a href="{{ route('ads.create') }}" class="sidebar-link {{ $currentRoute === 'ads.create' ? 'active' : '' }}">
        <i class="fa-solid fa-plus-circle"></i>
        <span>إضافة إعلان</span>
    </a>
</div>

<div class="mt-6 space-y-1">
    <p class="px-4 py-2 text-xs font-bold text-gray-500 uppercase tracking-wider">التواصل</p>
    
    <a href="{{ route('messages.index') }}" class="sidebar-link {{ str_starts_with($currentRoute, 'messages') ? 'active' : '' }}">
        <i class="fa-solid fa-envelope"></i>
        <span>الرسائل</span>
        @php
            $unreadMessages = auth()->user()->messages()->whereNull('read_at')->count();
        @endphp
        @if($unreadMessages > 0)
            <span class="mr-auto bg-emerald-500 text-black text-[10px] px-2 py-0.5 rounded-full font-bold">{{ $unreadMessages }}</span>
        @endif
    </a>
    
    <a href="{{ route('favorites.index') }}" class="sidebar-link {{ str_starts_with($currentRoute, 'favorites') ? 'active' : '' }}">
        <i class="fa-solid fa-heart"></i>
        <span>المفضلة</span>
    </a>
    
    <a href="{{ route('notifications.index') }}" class="sidebar-link {{ str_starts_with($currentRoute, 'notifications') ? 'active' : '' }}">
        <i class="fa-solid fa-bell"></i>
        <span>الإشعارات</span>
        @php
            $unreadNotifications = auth()->user()->unreadNotifications()->count();
        @endphp
        @if($unreadNotifications > 0)
            <span class="mr-auto bg-amber-500 text-black text-[10px] px-2 py-0.5 rounded-full font-bold">{{ $unreadNotifications }}</span>
        @endif
    </a>
</div>

@if(auth()->user()->hasStore())
    <div class="mt-6 space-y-1">
        <p class="px-4 py-2 text-xs font-bold text-gray-500 uppercase tracking-wider">متجري</p>
        
        <a href="{{ route('vendor.dashboard') }}" class="sidebar-link {{ str_starts_with($currentRoute, 'vendor') ? 'active' : '' }}">
            <i class="fa-solid fa-store"></i>
            <span>لوحة المتجر</span>
        </a>
        
        <a href="{{ route('vendor.analytics') }}" class="sidebar-link {{ $currentRoute === 'vendor.analytics' ? 'active' : '' }}">
            <i class="fa-solid fa-chart-pie"></i>
            <span>الإحصائيات</span>
        </a>
        
        <a href="{{ route('vendor.store.settings') }}" class="sidebar-link {{ $currentRoute === 'vendor.store.settings' ? 'active' : '' }}">
            <i class="fa-solid fa-gear"></i>
            <span>إعدادات المتجر</span>
        </a>
    </div>
@elseif(auth()->user()->canCreateStore())
    <div class="mt-6 px-4">
        <a href="{{ route('store.setup') }}" class="sidebar-link bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">
            <i class="fa-solid fa-store"></i>
            <span>إنشاء متجر</span>
        </a>
    </div>
@endif

<div class="mt-6 space-y-1">
    <p class="px-4 py-2 text-xs font-bold text-gray-500 uppercase tracking-wider">الحساب</p>
    
    <a href="{{ route('profile') }}" class="sidebar-link {{ str_starts_with($currentRoute, 'profile') ? 'active' : '' }}">
        <i class="fa-solid fa-user"></i>
        <span>الملف الشخصي</span>
    </a>
    
    <a href="{{ route('profile.edit') }}" class="sidebar-link {{ $currentRoute === 'profile.edit' ? 'active' : '' }}">
        <i class="fa-solid fa-user-pen"></i>
        <span>تعديل البيانات</span>
    </a>
</div>

@if(auth()->user()->isAdmin())
    <div class="mt-6 space-y-1">
        <p class="px-4 py-2 text-xs font-bold text-gray-500 uppercase tracking-wider">الإدارة</p>
        
        <a href="{{ url('/admin') }}" target="_blank" class="sidebar-link">
            <i class="fa-solid fa-shield-halved"></i>
            <span>لوحة الإدارة</span>
        </a>
    </div>
@endif
