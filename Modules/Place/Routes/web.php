<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;
use Modules\Place\Http\Controllers\Dashboard\HotelRoomController;
use Modules\Place\Http\Controllers\Dashboard\MenuController;
use Modules\Place\Http\Controllers\Dashboard\PlaceController;
use Modules\Place\Http\Controllers\Dashboard\TableController;

Route::resource('places', PlaceController::class);
Route::resource('tables', TableController::class)->middleware('check_admin');
Route::resource('hotel-rooms', HotelRoomController::class)->middleware('check_admin');
Route::resource('menus', MenuController::class);
