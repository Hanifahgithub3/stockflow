<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SupplierController;

Route::get('/', fn () => redirect('/dashboard'));

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', fn () => view('dashboard'))->name('dashboard');

    Route::resource('categories', CategoryController::class)
        ->except('show')
        ->middleware('role:admin');

            Route::resource('suppliers', SupplierController::class)
        ->except('show')
        ->middleware('role:admin');

    Route::middleware('role:admin')->group(function () {
        Route::resource('products', ProductController::class)->except(['index', 'show']);
    });
    Route::resource('products', ProductController::class)->only(['index', 'show']);
});