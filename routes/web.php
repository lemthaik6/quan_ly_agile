<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Include auth routes
require __DIR__ . '/auth.php';

// Include admin routes
require __DIR__ . '/admin.php';
