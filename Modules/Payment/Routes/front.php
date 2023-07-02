<?php


use Illuminate\Support\Facades\Route;
use Modules\Payment\Http\Controllers\Front\ZarinPalPaymentController;

// پرداخت و درگاه پرداخت
Route::post('payment/{reserve}', [ZarinPalPaymentController::class, 'pay'])->name('payment')->middleware('auth');
Route::get('payment/callback', [ZarinPalPaymentController::class, 'call_back'])->name('callback')->middleware('auth');
