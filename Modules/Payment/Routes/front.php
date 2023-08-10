<?php


use Illuminate\Support\Facades\Route;
use Modules\Payment\Http\Controllers\Front\ZarinPalPaymentController;

Route::group(['middleware' => 'auth', 'prefix' => 'payment'], function () {
    // زرین پال
    Route::post('zarinpal/{reserve}', [ZarinPalPaymentController::class, 'pay'])->name('zarinpal.payment');
    Route::get('zarinpal/callback', [ZarinPalPaymentController::class, 'call_back'])->name('zarinpal.callback');
});

