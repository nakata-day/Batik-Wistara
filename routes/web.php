<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CatalogueController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;

// Landing page
Route::get('/', [SessionController::class, 'landing'])->name('landing');

// Authentication routes
Route::get('/login', [SessionController::class, 'loginForm'])->name('login');
Route::post('/login', [SessionController::class, 'login']);
Route::get('/logout', [SessionController::class, 'logout'])->name('logout');

// Registration routes
Route::get('/register', [UserController::class, 'registerForm'])->name('register');
Route::post('/register', [UserController::class, 'register']);

// Dashboard routes
Route::get('/dashboard', [SessionController::class, 'dashboard'])->name('dashboard');

// Catalogue routes
Route::get('/catalogue', [CatalogueController::class, 'index'])->name('catalogue.index');

// Product routes
Route::get('/products', [ProductController::class, 'index'])->name('product.index');
Route::get('/products/create', [ProductController::class, 'create'])->name('product.create');
Route::post('/products', [ProductController::class, 'store'])->name('product.store');
Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('product.edit');
Route::put('/products/{product}', [ProductController::class, 'update'])->name('product.update');
Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('product.destroy');

// Transaction routes
Route::get('/transactions', [TransactionController::class, 'index'])->name('transaction.index');
Route::get('/transactions/create', [TransactionController::class, 'create'])->name('transaction.create');
Route::post('/transactions', [TransactionController::class, 'store'])->name('transaction.store');
Route::get('/transaction-recap', [TransactionController::class, 'recapTransaction'])->name('transaction.recap');

// Daily recap route
Route::get('/daily-recap', [TransactionController::class, 'dailyRecap'])->name('daily.recap');

// Product performance route
Route::get('/product-performance', [ProductController::class, 'performance'])->name('product.performance');

// Recap route
Route::get('/recap', [TransactionController::class, 'recap'])->name('recap');

// Product list route
Route::get('/product-list', [ProductController::class, 'productList'])->name('product.list');

// Shopping route
Route::get('/shopping', function () {
    return view('shopping');
})->name('shopping');