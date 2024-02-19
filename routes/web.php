<?php

use App\Http\Controllers\Admin\ManageProductController;
use App\Http\Controllers\Admin\ManageVariantController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WebProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



// Home
Route::get('/', [HomeController::class, 'showHome'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Account
Route::prefix('account')->group(function () {
    Auth::routes();
});

// Produk
Route::prefix('product')->group(function () {
    Route::get('/', [ProductController::class, 'showProductList'])->name('product.list');
    Route::get('/{id}', [ProductController::class, 'showProductDetail'])->name('product.show');
});

// Cart
Route::prefix('cart')->group(function () {
    Route::get('/view', [HomeController::class, 'showCart'])->name('cart.view');
    Route::post('/add', [CartController::class, 'add'])->name('cart.add');
});
// Admin
Route::prefix('admin')->group(function () {
    Route::prefix('product')->group(function () {
        Route::get('/', [ManageProductController::class, 'showPage'])->name('admin.products.index');
        Route::get('/{id}', [ManageProductController::class, 'show'])->name('admin.products.show');
        Route::get('/{id}/edit', [ManageProductController::class, 'edit'])->name('admin.products.edit');
        Route::put('/{id}', [ManageProductController::class, 'update'])->name('admin.products.update');
        Route::delete('/{id}', [ManageProductController::class, 'destroy'])->name('admin.products.destroy');
    });
    Route::prefix('variant')->group(function () {
        Route::post('/', [ManageVariantController::class, 'store'])->name('admin.variants.store');
        Route::delete('/{id}', [ManageVariantController::class, 'destroy'])->name('admin.variants.destroy');
    });
    Route::prefix('web-profile')->group(function () {
        Route::get('/', [WebProfileController::class, 'index'])->name('admin.web-profile');
        Route::put('/update', [WebProfileController::class, 'update'])->name('admin.web-profile.update');
    });
});
