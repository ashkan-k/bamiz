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
use Modules\ContactUs\Http\Controllers\Dashboard\ContactUsController;

Route::resource('contact_us', ContactUsController::class, ['parameters' => ['contact_us' => 'contactUs' ]]);
