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
use Modules\Dashboard\Http\Controllers\Dashboard\DashboardController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('profile', [DashboardController::class, 'profile'])->name('profile');
