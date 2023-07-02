<?php


use Illuminate\Support\Facades\Route;
use Modules\Reserve\Http\Controllers\Front\FrontReserveController;

Route::post('reserve/{place:slug}' , [FrontReserveController::class , 'reserve'])->name('reserve')->middleware('auth');
