<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('customer-home');
});

Route::get('/customer-profile', function () {
    return view('customer-profile');
})->name('customer-profile');

Route::get('/aboutus', function () {
    return view('aboutus');
})->name('aboutus');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/signup', function () {
    return view('signup');
})->name('signup');

Route::get('/products', function () {
    return view('products');
})->name('products');

Route::get('/mechanic-products', function () {
    return view('products');
})->name('mechanic-products');

Route::get('/productdetail', function () {
    return view('productdetail');
})->name('productdetail');

Route::get('/mechanic-productdetail', function () {
    return view('productdetail');
})->name('mechanic-productdetail');

Route::get('/owner-home', function () {
    return view('owner-home');
})->name('owner-home');

Route::get('/customer-cart', function () {
    return view('customer-cart');
})->name('customer-cart');

Route::get('/customer-checkout', function () {
    return view('customer-checkout');
})->name('customer-checkout');

Route::get('/customer-payment', function () {
    return view('customer-payment');
})->name('customer-payment');

Route::get('/customer-paymentsuccess', function () {
    return view('customer-paymentsuccess');
})->name('customer-paymentsuccess');

Route::get('customer-history', function () {
    return view('customer-history');
})->name('customer-history');

Route::get('/customer-booking', function () {
    return view('customer-booking');
})->name('customer-booking');



Route::get('/loginadminmechanic', function(){
    return view('loginadminmechanic');
})->name('loginadminmechanic');


Route::get('/mechanic-home', function () {
    return view('mechanic-home');
})->name('mechanic-home');

Route::get('/mechanic-history', function () {
    return view('mechanic-history');
})->name('mechanic-history');

