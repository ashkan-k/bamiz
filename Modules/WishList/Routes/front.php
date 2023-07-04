<?php


use Illuminate\Support\Facades\Route;
use Modules\WishList\Http\Controllers\Front\FrontWishlistController;

Route::get('wishlists' , [FrontWishlistController::class , 'wishlists'])->name('wishlists')->middleware('auth');
