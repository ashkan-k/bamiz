<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\WishList\Http\Controllers\Dashboard\ApiWishListController;

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

Route::post('add-remove/{place}', [ApiWishListController::class, 'add_and_remove'])->name('api.wishlists.add_and_remove');
