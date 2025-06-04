<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;

Route::get('/', [ShopController::class, 'home'])->name('home');
Route::get('/products', [ShopController::class, 'products'])->name('products');
Route::get('/products/{product}', [ShopController::class, 'show'])->name('products.show');
Route::get('/categories', [ShopController::class, 'categories'])->name('categories');
Route::get('/about', [ShopController::class, 'about'])->name('about');
Route::get('/contact', [ShopController::class, 'contact'])->name('contact');
Route::post('/cart/add/{product}', [CartController::class, 'addToCart'])->name('cart.add');