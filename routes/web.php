<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ProfileController;

// Home - redirect to homepage
Route::get('/', [ProductController::class, 'homepage'])->name('home');

// Public routes
Route::prefix('shop')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('shop.index');
    Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');
});

// Cart routes (public)
Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::post('/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::post('/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/clear', [CartController::class, 'clear'])->name('cart.clear');
});

// Authenticated routes
Route::middleware('auth')->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');

    // Checkout
    Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout.index');
    Route::post('/checkout', [OrderController::class, 'store'])->name('checkout.store');

    // Orders
    Route::prefix('orders')->group(function () {
        Route::get('/', [OrderController::class, 'myOrders'])->name('order.list');
        Route::get('/confirmation/{orderCode}', [OrderController::class, 'confirmation'])->name('order.confirmation');
        Route::get('/{orderCode}', [OrderController::class, 'show'])->name('order.show');
    });

    // Reviews
    Route::prefix('reviews')->group(function () {
        Route::get('/product/{productSlug}', [ReviewController::class, 'create'])->name('review.create');
        Route::post('/', [ReviewController::class, 'store'])->name('review.store');
    });
});

// Include auth routes
require __DIR__ . '/auth.php';

// Include admin routes
require __DIR__ . '/admin.php';
