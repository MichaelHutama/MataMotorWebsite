<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// =========================================================
// 1. HALAMAN AKSES BEBAS (GUEST / BELUM LOGIN)
// =========================================================

// Jalur Login & Signup Customer
Route::get('/login', function () { return view('login'); })->name('customer.login.page');
Route::get('/signup', function () { return view('signup'); })->name('signup.page');
Route::post('/signup', [AuthController::class, 'signup'])->name('signup.submit');
Route::post('/login/customer', [AuthController::class, 'loginCustomer'])->name('customer.login.submit');

// Jalur Login Admin/Mechanic/Owner (PASTIKAN URL-NYA SAMA)
Route::get('/login/admin', function () { return view('loginadminmechanic'); })->name('admin.login.page');
Route::post('/login/admin', [AuthController::class, 'loginAdminMechanic'])->name('admin.login.submit');

// Jalur Katalog Publik (Bisa dilihat sebelum login)
Route::get('/products', function () { return view('products'); })->name('products.index');
Route::get('/products/{id}', function () { return view('productdetail'); })->name('products.detail');

// Logout Global
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// =========================================================
// 2. KELOMPOK HALAMAN CUSTOMER (Terproteksi Guard 'web')
// =========================================================
Route::middleware(['isCustomer'])->group(function () {
    Route::get('/customer/home', function () { return view('customer-home'); })->name('customer.home');
    Route::get('/customer/cart', function () { return view('customer-cart'); })->name('customer.cart');
    Route::get('/customer/checkout', function () { return view('customer-checkout'); })->name('customer.checkout');
    Route::get('/customer/history', function () { return view('customer-history'); })->name('customer.history');
    Route::get('/customer/payment', function () { return view('customer-payment'); })->name('customer.payment');
    Route::get('/customer/payment-success', function () { return view('customer-paymentsuccess'); })->name('customer.paymentsuccess');
    Route::get('/customer/profile', function () { return view('customer-profile'); })->name('customer.profile');
    Route::get('/customer/aboutus', function () { return view('customer-aboutus'); })->name('customer.aboutus');
    Route::get('/customer/booking', function () { return view('customer-booking'); })->name('customer.booking');
});


// =========================================================
// 3. KELOMPOK HALAMAN MEKANIK (Terproteksi Guard 'mechanic')
// =========================================================
Route::middleware(['isMechanic'])->group(function () {
    Route::get('/mechanic/home', function () { return view('mechanic-home'); })->name('mechanic.home');
    Route::get('/mechanic/history', function () { return view('mechanic-history'); })->name('mechanic.history');
});


// =========================================================
// 4. KELOMPOK HALAMAN OWNER (Terproteksi Guard 'mechanic' ID MEC-0)
// =========================================================
Route::middleware(['isOwner'])->group(function () {
    Route::get('/owner/home', function () { return view('owner-home'); })->name('owner.home');
    Route::get('/owner/add-transaction', function () { return view('owner-addtransaction'); })->name('owner.addtransaction');
    Route::get('/owner/catalog', function () { return view('owner-catalog'); })->name('owner.catalog');
    Route::get('/owner/manage-booking', function () { return view('owner-managebooking'); })->name('owner.managebooking');
    Route::get('/owner/mechanic', function () { return view('owner-mechanic'); })->name('owner.mechanic');
    Route::get('/owner/transaction', function () { return view('owner-transaction'); })->name('owner.transaction');
});