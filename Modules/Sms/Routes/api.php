<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Sms\Http\Controllers\Api\ApiSmsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Sms
Route::post('send', [ApiSmsController::class, 'send_sms_store'])->name('api.sms.send');
