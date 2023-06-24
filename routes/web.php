<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;

// we did something in app providers and route service and change the /dashboard to /redirect
Route::get('/', [HomeController::class, 'index']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/redirect', [HomeController::class, 'redirect']);

// Admin
Route::get('/view_category', [AdminController::class, 'view_category']);
Route::post('/add_category', [AdminController::class, 'add_category']);
Route::get('/delete_category/{id}', [AdminController::class, 'delete_category']);
Route::get('/view_product', [AdminController::class, 'view_product']);
Route::post('/add_product', [AdminController::class, 'add_product']);
Route::get('/show_product', [AdminController::class, 'show_product']);
Route::get('/delete_product/{id}', [AdminController::class, 'delete_product']);
Route::get('/update_product/{id}', [AdminController::class, 'update_product']);
Route::post('/update_product_confirm/{id}', [AdminController::class, 'update_product_confirm']);

Route::get('order', [AdminController::class, 'order']);
Route::get('/delivered/{id}', [AdminController::class, 'delivered']);

// User
Route::get('/detail_product/{id}', [HomeController::class, 'detail_product']);
Route::post('/add_cart/{id}', [HomeController::class, 'add_cart']);
Route::get('/show_cart', [HomeController::class, 'show_cart']);
Route::get('/remove_product/{id}', [HomeController::class, 'remove_product']);
Route::get('/cash_order', [HomeController::class, 'cash_order']);

Route::get('/stripe/{total_price}', [HomeController::class, 'stripe']);

Route::post('stripe/{total_price}', [HomeController::class, 'stripePost'])->name('stripe.post');