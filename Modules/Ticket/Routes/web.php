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
use Modules\Ticket\Http\Controllers\Dashboard\TicketAnswerController;
use Modules\Ticket\Http\Controllers\Dashboard\TicketCategoryController;
use Modules\Ticket\Http\Controllers\Dashboard\TicketController;

Route::resource('tickets', TicketController::class);
Route::resource('ticket-categories', TicketCategoryController::class);
Route::resource('ticket-answers', TicketAnswerController::class);
