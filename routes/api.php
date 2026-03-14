<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ReportController;
use App\Http\Middleware\IsAdmin;

Route::get('/health', function () {
    return response()->json(['status' => 'ok']);
});

// Public API (no auth required)
Route::prefix('user')->group(function () {
    Route::apiResource('products', ProductController::class)->only(['index', 'show']);
    Route::apiResource('categories', CategoryController::class)->only(['index', 'show']);
});

// Protected API Routes (Requires Auth + IsAdmin)
Route::middleware(['auth:sanctum', IsAdmin::class])->prefix('admin')->group(function () {
    
    // Products API
    Route::apiResource('products', ProductController::class);
    Route::post('products/{product}/toggle-active', [ProductController::class, 'toggleActive']);
    Route::post('products/{product}/toggle-featured', [ProductController::class, 'toggleFeatured']);
    
    // Categories API
    Route::apiResource('categories', CategoryController::class);
    Route::post('categories/{category}/toggle-active', [CategoryController::class, 'toggleActive']);
    
    // Orders API
    Route::apiResource('orders', OrderController::class)->except(['create', 'edit', 'store', 'update', 'destroy']);
    Route::post('orders/{order}/update-status', [OrderController::class, 'updateStatus']);
    Route::post('orders/{order}/update-payment-status', [OrderController::class, 'updatePaymentStatus']);
    Route::post('orders/{order}/cancel', [OrderController::class, 'cancel']);
    Route::get('orders/{order}/export', [OrderController::class, 'export']);
    
    // Reports API
    Route::prefix('reports')->group(function () {
        Route::get('/', [ReportController::class, 'index']);
        Route::get('export', [ReportController::class, 'export']);
    });
    
    // Dashboard
    Route::get('dashboard', [ReportController::class, 'dashboard']);
});
