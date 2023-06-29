<?php


use Illuminate\Support\Facades\Route;
use Modules\Place\Http\Controllers\Front\FrontPlaceController;

Route::get('places' , [FrontPlaceController::class , 'places'])->name('places');
//Route::get('places/{place:slug}' , [FrontPlaceController::class , 'place_detail'])->name('place_detail');
Route::get('places/categories/{category:slug}' , [FrontPlaceController::class , 'categories'])->name('categories');
