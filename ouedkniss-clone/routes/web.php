<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\StoreController;
use App\Livewire\Home;
use App\Livewire\AdListing;
use App\Livewire\AdDetail;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StoreSetupController;
use App\Http\Controllers\VendorDashboardController;

// Home
Route::get('/', Home::class)->name('home');

// Ads Routes
Route::get('/ads', AdListing::class)->name('ads.index');
Route::get('/ads/create', [AdController::class, 'create'])->name('ads.create')->middleware('auth');
Route::post('/ads', [AdController::class, 'store'])->name('ads.store')->middleware('auth');
Route::get('/ads/{slug}', AdDetail::class)->name('ads.show');
Route::get('/category/{slug}', AdListing::class)->name('ads.by-category');

// Categories
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');

// Stores
Route::get('/stores', [StoreController::class, 'index'])->name('stores.index');
Route::get('/stores/{slug}', [StoreController::class, 'show'])->name('stores.show');

// Dashboard Routes
Route::prefix('dashboard')->middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/stats', [DashboardController::class, 'stats'])->name('dashboard.stats');
    Route::get('/activity', [DashboardController::class, 'activity'])->name('dashboard.activity');
});

// Messaging Routes
Route::prefix('messages')->middleware('auth')->group(function () {
    Route::get('/', [MessageController::class, 'index'])->name('messages.index');
    Route::get('/conversation', [MessageController::class, 'show'])->name('messages.show');
    Route::post('/', [MessageController::class, 'store'])->name('messages.store');
    Route::post('/start/{user}', [MessageController::class, 'start'])->name('messages.start');
    Route::delete('/{message}', [MessageController::class, 'destroy'])->name('messages.destroy');
});

// Favorites Routes
Route::middleware('auth')->group(function () {
    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
    Route::post('/favorites/{ad}', [FavoriteController::class, 'store'])->name('favorites.store');
    Route::delete('/favorites/{ad}', [FavoriteController::class, 'destroy'])->name('favorites.destroy');
});

// Notifications Routes
Route::middleware('auth')->group(function () {
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{id}/read', [NotificationController::class, 'markRead'])->name('notifications.read');
    Route::post('/notifications/read-all', [NotificationController::class, 'markAllRead'])->name('notifications.read-all');
    Route::delete('/notifications/{id}', [NotificationController::class, 'destroy'])->name('notifications.destroy');
});

// Search Route
Route::get('/search', [SearchController::class, 'index'])->name('search');
Route::get('/search/suggestions', [SearchController::class, 'suggestions'])->name('search.suggestions');

// User Routes
Route::middleware('auth')->group(function () {
    Route::get('/my-ads', [AdController::class, 'myAds'])->name('my-ads');
    Route::get('/ads/{ad}/edit', [AdController::class, 'edit'])->name('ads.edit');
    Route::put('/ads/{ad}', [AdController::class, 'update'])->name('ads.update');
    Route::delete('/ads/{ad}', [AdController::class, 'destroy'])->name('ads.destroy');
    
    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
    Route::put('/profile/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.avatar');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Store Setup Routes
    Route::get('/store/setup', [StoreSetupController::class, 'index'])->name('store.setup');
    Route::post('/store/setup/basic', [StoreSetupController::class, 'storeBasic'])->name('store.setup.basic');
    Route::post('/store/setup/branding', [StoreSetupController::class, 'storeBranding'])->name('store.setup.branding');
    Route::post('/store/setup/contact', [StoreSetupController::class, 'storeContact'])->name('store.setup.contact');
    
    // Vendor Routes
    Route::prefix('vendor')->group(function () {
        Route::get('/dashboard', [VendorDashboardController::class, 'index'])->name('vendor.dashboard');
        Route::get('/analytics', [VendorDashboardController::class, 'analytics'])->name('vendor.analytics');
        Route::get('/ads/manage', [VendorDashboardController::class, 'manageAds'])->name('vendor.ads.manage');
        Route::get('/store/settings', [VendorDashboardController::class, 'storeSettings'])->name('vendor.store.settings');
        Route::put('/store', [VendorDashboardController::class, 'updateStore'])->name('vendor.store.update');
    });
});

// Static Pages
Route::get('/help', function () {
    return view('pages.help');
})->name('help');

Route::get('/terms', function () {
    return view('pages.terms');
})->name('terms');

Route::get('/privacy', function () {
    return view('pages.privacy');
})->name('privacy');

Route::get('/safety', function () {
    return view('pages.safety');
})->name('safety');

// Auth Routes
require __DIR__.'/auth.php';
