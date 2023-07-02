<?php


use Illuminate\Support\Facades\Route;
use Modules\Payment\Http\Controllers\Front\FrontPaymentController;

// پرداخت و درگاه پرداخت
Route::get('pay' , [FrontPaymentController::class , 'show']);
Route::post('payment/{reserve}' , [FrontPaymentController::class , 'pay'])->name('payment')->middleware('auth');
Route::get('payment/callback' , [FrontPaymentController::class , 'call_back'])->name('callback')->middleware('auth');
