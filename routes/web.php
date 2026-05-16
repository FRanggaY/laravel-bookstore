<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserOrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/books/{id}', [HomeController::class, 'show'])->name('books.show');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Cart Routes
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{bookId}', [CartController::class, 'add'])->name('cart.add');
    Route::put('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

    // Order Routes
    Route::post('/orders', [UserOrderController::class, 'store'])->name('orders.store');
    Route::get('/orders/history', [UserOrderController::class, 'history'])->name('orders.history');
    Route::get('/orders/{id}/payment', [UserOrderController::class, 'payment'])->name('orders.payment');
    Route::post('/orders/{id}/payment', [UserOrderController::class, 'uploadProof'])->name('orders.uploadProof');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::resource('categories', CategoryController::class)->names('admin.categories');
    Route::resource('books', BookController::class)->names('admin.books');
    Route::get('/orders', [OrderController::class, 'index'])->name('admin.orders.index');
    Route::put('/orders/{id}/status', [OrderController::class, 'updateStatus'])->name('admin.orders.status');
    Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/contacts', [ContactController::class, 'adminIndex'])->name('admin.contacts.index');
    Route::get('/contacts/create', [ContactController::class, 'adminCreate'])->name('admin.contacts.create');
    Route::post('/contacts', [ContactController::class, 'adminStore'])->name('admin.contacts.store');
    Route::put('/contacts/{id}/status', [ContactController::class, 'updateStatus'])->name('admin.contacts.status');
});
