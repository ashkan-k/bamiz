<?php

use App\Http\Controllers\Auth\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//send verify code
Route::post('verify', [AuthController::class , 'verify']);
Route::post('verify/send/again', [AuthController::class , 'send_verify_again'])->name('send_verify_code');
