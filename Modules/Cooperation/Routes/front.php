<?php


use Illuminate\Support\Facades\Route;
use Modules\Cooperation\Http\Controllers\Front\FrontCooperationController;

Route::get('cooperation' , [FrontCooperationController::class , 'cooperation'])->name('cooperation');
Route::post('cooperation' , [FrontCooperationController::class , 'cooperation_submit'])->name('cooperation_submit');
