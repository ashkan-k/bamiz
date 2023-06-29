<?php


use Illuminate\Support\Facades\Route;
use Modules\Place\Http\Controllers\Front\FrontPlaceController;

Route::get('places' , [FrontPlaceController::class , 'places'])->name('places');
Route::get('places/categories/{category:slug}' , [FrontPlaceController::class , 'categories'])->name('categories');
