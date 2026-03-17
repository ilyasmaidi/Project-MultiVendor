@php
    $user = auth()->user();
    // جلب عدد الطلبات الجديدة للأدمن فقط لتقليل الحمل
    $adminNewOrders = $user->isAdmin() ? \App\Models\Order::where('status', 'pending')->count() : 0;
    
    // جلب عدد طلبات الزبائن للتاجر فقط
    $vendorNewOrders = $user->hasStore() ? \App\Models\Order::where('seller_id', $user->id)->where('status', 'pending')->count() : 0;
@endphp

<div class="space-y-1">
    <p class="px-4 py-2 text-xs font-bold text-gray-500 uppercase tracking-wider">الرئيسية</p>
    
    <a href="{{ route('dashboard') }}" class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
        <i class="fa-solid fa-grid-2"></i>
        <span>نظرة عامة</span>
    </a>
    
    <a href="{{ route('my-ads') }}" class="sidebar-link {{ request()->routeIs('my-ads', 'ads.edit') ? 'active' : '' }}">
        <i class="fa-solid fa-newspaper"></i>
        <span>إعلاناتي</span>
    </a>
    
    <a href="{{ route('ads.create') }}" class="sidebar-link {{ request()->routeIs('ads.create') ? 'active' : '' }}">
        <i class="fa-solid fa-plus-circle"></i>
        <span>إضافة إعلان</span>
    </a>
</div>

{{-- قسم طلبات المشتري (ثابت للجميع) --}}
<div class="mt-6 space-y-1">
    <p class="px-4 py-2 text-xs font-bold text-gray-500 uppercase tracking-wider">المشتريات</p>
    <a href="{{ route('orders.index') }}" class="sidebar-link {{ request()->routeIs('orders.index') ? 'active' : '' }}">
        <i class="fa-solid fa-bag-shopping"></i>
        <span>مشترياتي (الطلبات)</span>
    </a>
</div>

{{-- قسم التاجر (يظهر فقط لمن يملك متجراً) --}}
@if($user->hasStore())
    <div class="mt-6 space-y-1">
        <p class="px-4 py-2 text-xs font-bold text-gray-500 uppercase tracking-wider">متجري (البيع)</p>
        
        <a href="{{ route('vendor.dashboard') }}" class="sidebar-link {{ request()->routeIs('vendor.dashboard') ? 'active' : '' }}">
            <i class="fa-solid fa-store"></i>
            <span>لوحة المتجر</span>
        </a>
        
        <a href="{{ route('vendor.orders.index') }}" class="sidebar-link {{ request()->routeIs('vendor.orders.*') ? 'active' : '' }}">
            <i class="fa-solid fa-clipboard-list"></i>
            <span>طلبات الزبائن</span>
            @if($vendorNewOrders > 0)
                <span class="mr-auto bg-emerald-500 text-white text-[10px] px-2 py-0.5 rounded-full font-bold">{{ $vendorNewOrders }}</span>
            @endif
        </a>

        <a href="{{ route('vendor.store.settings') }}" class="sidebar-link {{ request()->routeIs('vendor.store.settings') ? 'active' : '' }}">
            <i class="fa-solid fa-gear"></i>
            <span>إعدادات المتجر</span>
        </a>
    </div>
@endif

{{-- قسم الإدارة العليا (للأدمن فقط) --}}
@if($user->isAdmin())
    <div class="mt-6 space-y-1">
        <p class="px-4 py-2 text-xs font-bold text-gray-500 uppercase tracking-wider">الإدارة العليا</p>
        
        <a href="{{ route('admin.orders.index') }}" class="sidebar-link {{ request()->routeIs('admin.orders.index') ? 'active' : '' }}">
            <i class="fa-solid fa-boxes-packing"></i>
            <span>إدارة كل طلبات الموقع</span>
            @if($adminNewOrders > 0)
                <span class="mr-auto bg-orange-500 text-white text-[10px] px-2 py-0.5 rounded-full font-bold">
                    {{ $adminNewOrders }}
                </span>
            @endif
        </a>
        
        <a href="{{ url('/admin') }}" target="_blank" class="sidebar-link">
            <i class="fa-solid fa-shield-halved"></i>
            <span>لوحة التحكم (Filament/Laravel)</span>
        </a>
    </div>
@endif