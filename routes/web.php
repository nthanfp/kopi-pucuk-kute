<?php

use App\Http\Controllers\Admin\ManageProductController;
use App\Http\Controllers\Admin\ManageUserController;
use App\Http\Controllers\Admin\ManageVariantController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
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
Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Account
Route::prefix('account')->group(function () {
    Auth::routes();
    Route::get('/profile', [ProfileController::class, 'show'])->name('account.profile.show');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('account.profile.update');
    Route::get('/transaction', [ProfileController::class, 'showTransaction'])->name('account.profile.transaction');
    Route::get('/transaction/{id}', [ProfileController::class, 'showDetail'])->name('transaction.detail');

});

// Produk
Route::prefix('product')->group(function () {
    Route::get('/', [ProductController::class, 'showProductList'])->name('product.list');
    Route::get('/{id}', [ProductController::class, 'showProductDetail'])->name('product.show');
});

// Cart
Route::prefix('cart')->group(function () {
    Route::get('/view', [CartController::class, 'showCart'])->name('cart.view');
    Route::post('/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::post('/update', [CartController::class, 'updateCart'])->name('cart.update');
    Route::post('/delete', [CartController::class, 'deleteCartItem'])->name('cart.delete');
    Route::get('/checkout', [CartController::class, 'showCheckout'])->name('cart.checkout');
    Route::post('/checkout/process', [CartController::class, 'processCheckout'])->name('checkout.process'); // Menangani proses checkout
});

// Admin
Route::prefix('admin')->group(function () {
    Route::prefix('user')->group(function () {
        Route::get('/create', [ManageUserController::class, 'create'])->name('admin.user.create');
        Route::post('/', [ManageUserController::class, 'store'])->name('admin.user.store');
        Route::get('/', [ManageUserController::class, 'index'])->name('admin.user.index');
        Route::get('/{id}', [ManageUserController::class, 'show'])->name('admin.user.show');
        Route::get('/{id}/edit', [ManageUserController::class, 'edit'])->name('admin.user.edit');
        Route::put('/{id}', [ManageUserController::class, 'update'])->name('admin.user.update');
        Route::delete('/{id}', [ManageUserController::class, 'destroy'])->name('admin.user.destroy');
    });
    Route::prefix('product')->group(function () {
        Route::get('/', [ManageProductController::class, 'index'])->name('admin.product.index');
        Route::get('/create', [ManageProductController::class, 'create'])->name('admin.product.create');
        Route::post('/', [ManageProductController::class, 'store'])->name('admin.product.store');
        Route::get('/{id}', [ManageProductController::class, 'show'])->name('admin.product.show');
        Route::get('/{id}/edit', [ManageProductController::class, 'edit'])->name('admin.product.edit');
        Route::put('/{id}', [ManageProductController::class, 'update'])->name('admin.product.update');
        Route::patch('/{id}', [ManageProductController::class, 'update']);
        Route::delete('/{id}', [ManageProductController::class, 'destroy'])->name('admin.product.destroy');
    });
    Route::prefix('variant')->group(function () {
        Route::post('/', [ManageVariantController::class, 'store'])->name('admin.variant.store');
        Route::delete('/{id}', [ManageVariantController::class, 'destroy'])->name('admin.variant.destroy');
        Route::get('/{id}/edit', [ManageVariantController::class, 'edit'])->name('admin.variant.edit');
        Route::put('/{id}', [ManageVariantController::class, 'update'])->name('admin.variant.update');
    });
    Route::prefix('payment')->group(function () {
        Route::get('/', [PaymentController::class, 'index'])->name('admin.payment.index');
        Route::get('/create', [PaymentController::class, 'create'])->name('admin.payment.create');
        Route::post('/', [PaymentController::class, 'store'])->name('admin.payment.store');
        Route::get('/{payment}', [PaymentController::class, 'show'])->name('admin.payment.show');
        Route::get('/{payment}/edit', [PaymentController::class, 'edit'])->name('admin.payment.edit');
        Route::put('/{payment}', [PaymentController::class, 'update'])->name('admin.payment.update');
        Route::delete('/{payment}', [PaymentController::class, 'destroy'])->name('admin.payment.destroy');
    });
    Route::prefix('web-profile')->group(function () {
        Route::get('/', [WebProfileController::class, 'index'])->name('admin.web-profile');
        Route::put('/update', [WebProfileController::class, 'update'])->name('admin.web-profile.update');
    });
    Route::prefix('transactions')->group(function () {
        Route::get('/', [TransactionController::class, 'index'])->name('admin.transactions.index');
        Route::get('/create', [TransactionController::class, 'create'])->name('admin.transactions.create');
        Route::post('/', [TransactionController::class, 'store'])->name('admin.transactions.store');
        Route::get('/{id}', [TransactionController::class, 'show'])->name('admin.transactions.show');
        Route::get('/{id}/edit', [TransactionController::class, 'edit'])->name('admin.transactions.edit');
        Route::put('/{id}', [TransactionController::class, 'update'])->name('admin.transactions.update');
        Route::delete('/{id}', [TransactionController::class, 'destroy'])->name('admin.transactions.destroy');
    });
});
