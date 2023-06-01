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
use Modules\Common\Http\Controllers\CityController;
use Modules\Common\Http\Controllers\ProvinceController;

Route::resource('provinces', ProvinceController::class);
Route::resource('cities', CityController::class);
