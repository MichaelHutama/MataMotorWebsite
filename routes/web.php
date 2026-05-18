<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/profile', function () {
    return view('profile');
})->name('profile');

Route::get('/aboutus', function () {
    return view('aboutus');
})->name('aboutus');