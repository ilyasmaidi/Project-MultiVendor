<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AdController, CategoryController, StoreController,
    DashboardController, MessageController, FavoriteController,
    NotificationController, SearchController, ProfileController,
    StoreSetupController, VendorDashboardController, CartController,
    OrderController, CheckoutController
};
use App\Livewire\{Home, AdListing};
use App\Livewire\Admin\Orders\OrderIndex;
use App\Livewire\Admin\Orders\OrderShow;

/*
|--------------------------------------------------------------------------
| 1. المسارات العامة (Public Routes)
|--------------------------------------------------------------------------
*/
Route::get('/', Home::class)->name('home');
Route::get('/search', [SearchController::class, 'index'])->name('search');
Route::get('/search/suggestions', [SearchController::class, 'suggestions'])->name('search.suggestions');

Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/stores', [StoreController::class, 'index'])->name('stores.index');
Route::get('/stores/{slug}', [StoreController::class, 'show'])->name('stores.show');

Route::get('/ads', [AdController::class, 'index'])->name('ads.index');
Route::get('/category/{slug}', AdListing::class)->name('ads.by-category');
Route::get('/ads/{slug}', [AdController::class, 'show'])->name('ads.show');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/remove/{key}', [CartController::class, 'remove'])->name('cart.remove');

/*
|--------------------------------------------------------------------------
| 2. مسارات الأعضاء المسجلين (Authenticated Routes)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // --- التوجيه الذكي (الرئيسية) ---
    // هذا المسار يحل مشكلة الـ Dashboard التي واجهناها في البداية
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');
    // --- نظام المشتري والطلبات الشخصية ---
    Route::prefix('checkout')->name('checkout.')->group(function () {
        Route::get('/', [CheckoutController::class, 'index'])->name('index');
        Route::post('/store', [CheckoutController::class, 'store'])->name('store');
        Route::get('/success', [CheckoutController::class, 'success'])->name('success');
    });
    
    // هذا هو الاسم الذي يطلبه الـ Sidebar لطلبات المشتري
    Route::get('/my-orders', [CheckoutController::class, 'myOrders'])->name('orders.index');

    // --- إدارة الإعلانات والملف الشخصي ---
    Route::get('/my-ads', [AdController::class, 'myAds'])->name('my-ads');
    Route::resource('ads', AdController::class)->except(['index', 'show']);

    // الرسائل والمفضلة والتنبيهات
    Route::prefix('messages')->name('messages.')->group(function () {
        Route::get('/', [MessageController::class, 'index'])->name('index');
        Route::get('/conversation', [MessageController::class, 'show'])->name('show');
        Route::post('/', [MessageController::class, 'store'])->name('store');
    });

    Route::resource('favorites', FavoriteController::class)->only(['index', 'store', 'destroy']);

    Route::prefix('notifications')->name('notifications.')->group(function () {
        Route::get('/', [NotificationController::class, 'index'])->name('index');
        Route::post('/read-all', [NotificationController::class, 'markAllRead'])->name('read-all');
    });

    // الملف الشخصي (تم ضبط الأسماء لتطابق الـ Sidebar)
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'show'])->name('profile');
        Route::get('/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/', [ProfileController::class, 'update'])->name('profile.update');
    });

    // --- إعداد المتجر (Store Setup) ---
    // الحل النهائي لخطأ Route [store.setup] not defined
    Route::prefix('store-setup')->group(function () {
        Route::get('/', [StoreSetupController::class, 'index'])->name('store.setup');
        Route::post('/basic', [StoreSetupController::class, 'storeBasic'])->name('store.setup.basic');
        Route::post('/branding', [StoreSetupController::class, 'storeBranding'])->name('store.setup.branding');
        Route::post('/contact', [StoreSetupController::class, 'storeContact'])->name('store.setup.contact');
    });

    // --- مسارات التاجر (Vendor) ---
    Route::prefix('vendor')->name('vendor.')->group(function () {
        Route::get('/dashboard', [VendorDashboardController::class, 'index'])->name('dashboard');
        Route::get('/analytics', [VendorDashboardController::class, 'analytics'])->name('analytics');
        Route::get('/store/settings', [VendorDashboardController::class, 'storeSettings'])->name('store.settings');
        Route::get('/orders', [CheckoutController::class, 'vendorOrders'])->name('orders.index');
        Route::patch('/orders/{order}', [CheckoutController::class, 'updateStatus'])->name('orders.update');
    });

    // --- مسارات الإدارة العليا (Admin) ---
    Route::prefix('admin')->name('admin.')->group(function () {
        // إدارة الطلبات الكلية (التي يراها الأدمن فقط)
        Route::prefix('orders')->name('orders.')->group(function () {
            Route::get('/', OrderIndex::class)->name('index');
            Route::get('/{order}', OrderShow::class)->name('show'); 
        });
    });
});

/*
|--------------------------------------------------------------------------
| 3. صفحات المعلومات (Static Pages)
|--------------------------------------------------------------------------
*/
Route::view('/help', 'pages.help')->name('help');
Route::view('/safety', 'pages.safety')->name('safety');
Route::view('/terms', 'pages.terms')->name('terms');
Route::view('/privacy', 'pages.privacy')->name('privacy');
Route::middleware(['auth'])->get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


require __DIR__.'/auth.php';