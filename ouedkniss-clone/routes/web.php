<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AdController,
    CategoryController,
    StoreController,
    DashboardController,
    MessageController,
    FavoriteController,
    NotificationController,
    SearchController,
    ProfileController,
    StoreSetupController,
    VendorDashboardController,
    CartController,
    OrderController,
    CheckoutController // تأكد من استدعائه هنا
};
use App\Livewire\{Home, AdListing};

// --- 1. Public Routes ---
Route::get('/', Home::class)->name('home');

// --- 2. Checkout & Orders Routes (المسارات المضافة والمصلحة) ---
Route::middleware(['auth'])->group(function () {
    
    // مسارات عملية الشراء (Checkout)
    Route::prefix('checkout')->name('checkout.')->group(function () {
        // هذا هو المسار الذي كان ناقصاً ويسبب الخطأ
        Route::get('/', [CheckoutController::class, 'index'])->name('index'); 
        
        // مسار حفظ الطلب
        Route::post('/store', [CheckoutController::class, 'store'])->name('store');
        
        // صفحة نجاح الطلب
        Route::get('/success', [CheckoutController::class, 'success'])->name('success');
    });

    // مسارات طلبات المشتري
    Route::get('/my-orders', [CheckoutController::class, 'myOrders'])->name('orders.index');

    // مسارات البائع لإدارة الطلبات
    Route::prefix('vendor/orders')->name('vendor.orders.')->group(function () {
        Route::get('/', [CheckoutController::class, 'vendorOrders'])->name('index');
        Route::patch('/{order}', [CheckoutController::class, 'updateStatus'])->name('update');
    });
});

// --- 3. Cart Routes ---
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/remove/{key}', [CartController::class, 'remove'])->name('cart.remove');

// --- 4. Search & General ---
Route::get('/search', [SearchController::class, 'index'])->name('search');
Route::get('/search/suggestions', [SearchController::class, 'suggestions'])->name('search.suggestions');

// Categories & Stores
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/stores', [StoreController::class, 'index'])->name('stores.index');
Route::get('/stores/{slug}', [StoreController::class, 'show'])->name('stores.show');

// Ads Management (ترتيب المسارات هام جداً)
Route::get('/ads', [AdController::class, 'index'])->name('ads.index');
Route::get('/category/{slug}', AdListing::class)->name('ads.by-category');
Route::get('/ads/create/new', [AdController::class, 'create'])->name('ads.create')->middleware('auth'); 
Route::get('/ads/{slug}', [AdController::class, 'show'])->name('ads.show');


// --- 5. Authenticated Dashboard & Management ---
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::prefix('dashboard')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/stats', [DashboardController::class, 'stats'])->name('dashboard.stats');
        Route::get('/activity', [DashboardController::class, 'activity'])->name('dashboard.activity');
    });

    // Ads CRUD
    Route::get('/my-ads', [AdController::class, 'myAds'])->name('my-ads');
    Route::post('/ads', [AdController::class, 'store'])->name('ads.store');
    Route::get('/ads/{ad}/edit', [AdController::class, 'edit'])->name('ads.edit');
    Route::put('/ads/{ad}', [AdController::class, 'update'])->name('ads.update');
    Route::delete('/ads/{ad}', [AdController::class, 'destroy'])->name('ads.destroy');

    // Messaging
    Route::prefix('messages')->group(function () {
        Route::get('/', [MessageController::class, 'index'])->name('messages.index');
        Route::get('/conversation', [MessageController::class, 'show'])->name('messages.show');
        Route::post('/', [MessageController::class, 'store'])->name('messages.store');
        Route::post('/start/{user}', [MessageController::class, 'start'])->name('messages.start');
        Route::delete('/{message}', [MessageController::class, 'destroy'])->name('messages.destroy');
    });

    // Favorites & Notifications
    Route::post('/favorites/{ad}', [FavoriteController::class, 'store'])->name('favorites.store');
    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
    Route::delete('/favorites/{ad}', [FavoriteController::class, 'destroy'])->name('favorites.destroy');

    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{id}/read', [NotificationController::class, 'markRead'])->name('notifications.read');
    Route::post('/notifications/read-all', [NotificationController::class, 'markAllRead'])->name('notifications.read-all');
    Route::delete('/notifications/{id}', [NotificationController::class, 'destroy'])->name('notifications.destroy');

    // Profile Settings
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'show'])->name('profile');
        Route::get('/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::put('/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
        Route::put('/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.avatar');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    // Store Setup
    Route::prefix('store-setup')->group(function () {
        Route::get('/', [StoreSetupController::class, 'index'])->name('store.setup');
        Route::post('/basic', [StoreSetupController::class, 'storeBasic'])->name('store.setup.basic');
        Route::post('/branding', [StoreSetupController::class, 'storeBranding'])->name('store.setup.branding');
        Route::post('/contact', [StoreSetupController::class, 'storeContact'])->name('store.setup.contact');
    });

    // Vendor Panel
    Route::prefix('vendor')->group(function () {
        Route::get('/dashboard', [VendorDashboardController::class, 'index'])->name('vendor.dashboard');
        Route::get('/analytics', [VendorDashboardController::class, 'analytics'])->name('vendor.analytics');
        Route::get('/ads/manage', [VendorDashboardController::class, 'manageAds'])->name('vendor.ads.manage');
        Route::get('/store/settings', [VendorDashboardController::class, 'storeSettings'])->name('vendor.store.settings');
        Route::put('/store', [VendorDashboardController::class, 'updateStore'])->name('vendor.store.update');
    });
});

// --- 6. Static Pages ---
Route::view('/help', 'pages.help')->name('help');
Route::view('/terms', 'pages.terms')->name('terms');
Route::view('/privacy', 'pages.privacy')->name('privacy');
Route::view('/safety', 'pages.safety')->name('safety');

// Auth
require __DIR__.'/auth.php';