<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route; // Pastikan baris ini di-import

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // DAFTARKAN MIDDLEWARE ANDA DI SINI
        Route::aliasMiddleware('isCustomer', \App\Http\Middleware\CheckCustomer::class);
        Route::aliasMiddleware('isMechanic', \App\Http\Middleware\CheckMechanic::class);
        Route::aliasMiddleware('isOwner', \App\Http\Middleware\CheckOwner::class);
    }
}