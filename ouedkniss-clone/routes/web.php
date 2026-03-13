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
    VendorDashboardController
};
use App\Livewire\{Home, AdListing};


use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CheckoutController;


// --- 1. Public Routes ---
Route::get('/', Home::class)->name('home');





Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/remove/{key}', [CartController::class, 'remove'])->name('cart.remove');

// مسار تحويل السلة لطلب رسمي في قاعدة البيانات
Route::post('/checkout/confirm', [OrderController::class, 'store'])->name('orders.store');

// Search
Route::get('/search', [SearchController::class, 'index'])->name('search');
Route::get('/search/suggestions', [SearchController::class, 'suggestions'])->name('search.suggestions');

// Categories & Stores
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/stores', [StoreController::class, 'index'])->name('stores.index');
Route::get('/stores/{slug}', [StoreController::class, 'show'])->name('stores.show');

// Ads (قمت بترتيبها لمنع التضارب)
Route::get('/ads', [AdController::class, 'index'])->name('ads.index');
Route::get('/category/{slug}', AdListing::class)->name('ads.by-category');
// ملاحظة: تأكد أن {slug} في الأسفل لا يتعارض مع المسارات الثابتة
Route::get('/ads/{slug}', [AdController::class, 'show'])->name('ads.show');


// --- 2. Authenticated Routes ---
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::prefix('dashboard')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/stats', [DashboardController::class, 'stats'])->name('dashboard.stats');
        Route::get('/activity', [DashboardController::class, 'activity'])->name('dashboard.activity');
    });

    // Ads Management
    Route::get('/my-ads', [AdController::class, 'myAds'])->name('my-ads');
    Route::get('/ads/create/new', [AdController::class, 'create'])->name('ads.create'); // تم تغيير المسار قليلاً لمنع التضارب مع {slug}
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

    // Store Setup (للمستخدمين العاديين ليصبحوا تجار)
    Route::prefix('store-setup')->group(function () {
        Route::get('/', [StoreSetupController::class, 'index'])->name('store.setup');
        Route::post('/basic', [StoreSetupController::class, 'storeBasic'])->name('store.setup.basic');
        Route::post('/branding', [StoreSetupController::class, 'storeBranding'])->name('store.setup.branding');
        Route::post('/contact', [StoreSetupController::class, 'storeContact'])->name('store.setup.contact');
    });

    // Vendor Panel (للتجار فقط)
    Route::prefix('vendor')->group(function () {
        Route::get('/dashboard', [VendorDashboardController::class, 'index'])->name('vendor.dashboard');
        Route::get('/analytics', [VendorDashboardController::class, 'analytics'])->name('vendor.analytics');
        Route::get('/ads/manage', [VendorDashboardController::class, 'manageAds'])->name('vendor.ads.manage');
        Route::get('/store/settings', [VendorDashboardController::class, 'storeSettings'])->name('vendor.store.settings');
        Route::put('/store', [VendorDashboardController::class, 'updateStore'])->name('vendor.store.update');
    });
});

// --- 3. Static Pages ---
Route::view('/help', 'pages.help')->name('help');
Route::view('/terms', 'pages.terms')->name('terms');
Route::view('/privacy', 'pages.privacy')->name('privacy');
Route::view('/safety', 'pages.safety')->name('safety');

// Auth
require __DIR__.'/auth.php';