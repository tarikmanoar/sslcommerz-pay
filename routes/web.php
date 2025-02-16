<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SslCommerzPaymentController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');


    // SSLCOMMERZ Start
    Route::get('/easy', [SslCommerzPaymentController::class, 'easyCheckout'])->name('easy-checkout');
    Route::get('/hosted', [SslCommerzPaymentController::class, 'hostedCheckout'])->name('hosted-checkout');

    Route::post('/hosted-pay', [SslCommerzPaymentController::class, 'index'])->name('hosted.pay');
    Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

    Route::post('/success', [SslCommerzPaymentController::class, 'success']);
    Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
    Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

    Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
    //SSLCOMMERZ END
});
