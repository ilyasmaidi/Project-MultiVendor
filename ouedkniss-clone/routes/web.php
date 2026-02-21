<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\StoreController;
use App\Livewire\Home;
use App\Livewire\AdListing;
use App\Livewire\AdDetail;

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

// User Routes
Route::middleware('auth')->group(function () {
    Route::get('/my-ads', [AdController::class, 'myAds'])->name('my-ads');
    Route::get('/ads/{ad}/edit', [AdController::class, 'edit'])->name('ads.edit');
    Route::put('/ads/{ad}', [AdController::class, 'update'])->name('ads.update');
    Route::delete('/ads/{ad}', [AdController::class, 'destroy'])->name('ads.destroy');
    
    Route::get('/profile', function () {
        return view('profile.show');
    })->name('profile');
    
    Route::get('/store/dashboard', function () {
        return view('store.dashboard');
    })->name('store.dashboard');
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
