<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/products', [ProductController::class, 'index'])->name('products');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile', [ProfileController::class, 'shippinginformation'])->name('shipping.update');
    Route::post('/product', [ProductController::class, 'create'])->name('products.add');
    Route::delete('/product', [ProductController::class, 'delete'])->name('products.delete');
    Route::put('/product', [ProductController::class, 'edit'])->name('products.edit');
    Route::post('/category', [CategoryController::class, 'create'])->name('category.add');
    Route::delete('/category/{category}', [CategoryController::class, 'delete'])->name('category.delete');
    Route::put('/category', [CategoryController::class, 'update'])->name('category.edit');

});
Route::put('/cart/{id}', [CartController::class, 'update'])->name('cart.update');

Route::post('/dashboard/shoppingcart', [CartController::class, 'add'])->name('cart.add');
Route::get('/shoppingcart', [CartController::class, 'index'])->name('shoppingcart');

require __DIR__.'/auth.php';
