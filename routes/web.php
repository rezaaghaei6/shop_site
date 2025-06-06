<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Public Pages
|--------------------------------------------------------------------------
*/
Route::get('/', [ShopController::class, 'home'])->name('home');
Route::get('/products', [ShopController::class, 'products'])->name('products');
Route::get('/products/{id}', [ShopController::class, 'show'])->name('products.show');
Route::get('/products/search', [ShopController::class, 'search'])->name('products.search');
Route::get('/categories', [ShopController::class, 'categories'])->name('categories');
Route::get('/about', [ShopController::class, 'about'])->name('about');
Route::get('/contact', [ShopController::class, 'contact'])->name('contact');

/*
|--------------------------------------------------------------------------
| User Authentication Routes (Phone-based)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    // روت مورد انتظار لاراول برای redirect در middleware('auth')
    Route::get('/login', [UserAuthController::class, 'showLoginForm'])->name('login'); 
    
    Route::get('/user-login', [UserAuthController::class, 'showLoginForm'])->name('user.login.form');
    Route::post('/login', [UserAuthController::class, 'login'])->name('user.login');

    Route::get('/register', [UserAuthController::class, 'showRegisterForm'])->name('user.register.form');
    Route::post('/register', [UserAuthController::class, 'register'])->name('user.register');
});

Route::post('/logout', [UserAuthController::class, 'logout'])->name('user.logout')->middleware('auth');

/*
|--------------------------------------------------------------------------
| Cart Routes - Only for Authenticated Users
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
    Route::post('/cart/update/{productId}', [CartController::class, 'update'])->name('cart.update');
    Route::get('/cart/remove/{productId}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
});

/*
|--------------------------------------------------------------------------
| Admin Panel (Optional - If Admins Are Separated)
|--------------------------------------------------------------------------
*/
// Auth::routes(); // برای ادمین اگر نیاز داری
Route::get('/home', [HomeController::class, 'index'])->name('dashboard')->middleware('auth');
