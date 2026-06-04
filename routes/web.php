<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\MechanicController;

// ── PUBLIC ─────────────────────────────────────────────────
Route::get('/',          fn() => view('welcome'))->name('welcome');
Route::get('/about',     fn() => view('aboutus'))->name('aboutus');
Route::get('/products',  [CustomerController::class, 'products'])->name('products');
Route::get('/products/{id}', [CustomerController::class, 'productDetail'])->name('productdetail');

// ── AUTH ───────────────────────────────────────────────────
Route::get('/login',        [AuthController::class, 'showLogin'])->name('login');
Route::post('/login',       [AuthController::class, 'login'])->name('login.post');
Route::get('/signup',       [AuthController::class, 'showRegister'])->name('signup');
Route::post('/signup',      [AuthController::class, 'register'])->name('register');
Route::post('/logout',      [AuthController::class, 'logout'])->name('logout');

// Login mekanik & owner (halaman terpisah)
Route::get('/login-staff',  [AuthController::class, 'showStaffLogin'])->name('loginadminmechanic');
Route::post('/login-staff', [AuthController::class, 'staffLogin'])->name('loginadminmechanic.post');

// ── CUSTOMER ───────────────────────────────────────────────
Route::middleware('auth.customer')->group(function () {
    Route::get('/home',    [CustomerController::class, 'home'])->name('customer-home');
    Route::get('/profile', [CustomerController::class, 'profile'])->name('customer-profile');
    Route::put('/profile', [CustomerController::class, 'updateProfile'])->name('profile.update');

    // Kendaraan
    Route::post('/vehicle',      [CustomerController::class, 'storeVehicle'])->name('vehicle.store');
    Route::put('/vehicle/{id}',  [CustomerController::class, 'updateVehicle'])->name('vehicle.update');
    Route::delete('/vehicle/{id}', [CustomerController::class, 'deleteVehicle'])->name('vehicle.delete');

    // Booking
    Route::get('/booking',       [CustomerController::class, 'booking'])->name('customer-booking');
    Route::post('/booking',      [CustomerController::class, 'storeBooking'])->name('booking.store');
    Route::delete('/booking/{id}', [CustomerController::class, 'cancelBooking'])->name('booking.cancel');

    // Cart
    Route::get('/cart',          [CustomerController::class, 'cart'])->name('customer-cart');
    Route::post('/cart',         [CustomerController::class, 'addToCart'])->name('cart.add');
    Route::put('/cart/{id}',     [CustomerController::class, 'updateCart'])->name('cart.update');
    Route::delete('/cart/{id}',  [CustomerController::class, 'removeFromCart'])->name('cart.remove');

    // Checkout & Payment
    Route::get('/checkout',                   [CustomerController::class, 'checkout'])->name('customer-checkout');
    Route::post('/checkout',                  [CustomerController::class, 'processCheckout'])->name('checkout.process');
    Route::get('/payment/{transactionId}',    [CustomerController::class, 'payment'])->name('customer-payment');
    Route::post('/payment/{transactionId}',   [CustomerController::class, 'submitPayment'])->name('payment.submit');
    Route::get('/payment-success',            [CustomerController::class, 'paymentSuccess'])->name('customer-paymentsuccess');

    // History & Review
    Route::get('/history',                    [CustomerController::class, 'history'])->name('customer-history');
    Route::post('/review/{serviceId}',        [CustomerController::class, 'submitReview'])->name('review.submit');
});

// ── OWNER ──────────────────────────────────────────────────
Route::middleware('auth.owner')->prefix('owner')->group(function () {
    Route::get('/home',        [OwnerController::class, 'home'])->name('owner-home');

    // Katalog sparepart
    Route::get('/catalog',       [OwnerController::class, 'catalog'])->name('owner-catalog');
    Route::post('/catalog',      [OwnerController::class, 'storeSparePart'])->name('catalog.store');
    Route::put('/catalog/{id}',  [OwnerController::class, 'updateSparePart'])->name('catalog.update');
    Route::delete('/catalog/{id}', [OwnerController::class, 'deleteSparePart'])->name('catalog.delete');

    // Manajemen mekanik
    Route::get('/mechanic',        [OwnerController::class, 'mechanic'])->name('owner-mechanic');
    Route::post('/mechanic',       [OwnerController::class, 'storeMechanic'])->name('mechanic.store');
    Route::put('/mechanic/{id}',   [OwnerController::class, 'updateMechanic'])->name('mechanic.update');
    Route::delete('/mechanic/{id}',[OwnerController::class, 'deleteMechanic'])->name('mechanic.delete');

    // Manajemen booking
    Route::get('/booking',               [OwnerController::class, 'manageBooking'])->name('owner-managebooking');
    Route::put('/booking/{id}/status',   [OwnerController::class, 'updateBookingStatus'])->name('booking.updatestatus');

    // Transaksi
    Route::get('/transaction',           [OwnerController::class, 'transaction'])->name('owner-transaction');
    Route::get('/transaction/add',       [OwnerController::class, 'addTransaction'])->name('owner-addtransaction');
    Route::post('/transaction',          [OwnerController::class, 'storeTransaction'])->name('transaction.store');
    Route::put('/transaction/{id}/status', [OwnerController::class, 'updateTransactionStatus'])->name('transaction.updatestatus');
});

// ── MECHANIC ───────────────────────────────────────────────
Route::middleware('auth.mechanic')->prefix('mechanic')->group(function () {
    Route::get('/home',    [MechanicController::class, 'home'])->name('mechanic-home');
    Route::get('/history', [MechanicController::class, 'history'])->name('mechanic-history');
    Route::get('/products',     [MechanicController::class, 'products'])->name('mechanic-products');
    Route::get('/products/{id}',[MechanicController::class, 'productDetail'])->name('mechanic-productdetail');

    Route::post('/spare-part-request',            [MechanicController::class, 'requestSparePart'])->name('sparepartrequest.store');
    Route::put('/spare-part-request/{id}/status', [MechanicController::class, 'updateRequestStatus'])->name('sparepartrequest.updatestatus');
});