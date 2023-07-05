<?php


use Illuminate\Support\Facades\Route;
use Modules\Gallery\Http\Controllers\Front\FrontGalleryController;

Route::get('galleries', [FrontGalleryController::class, 'galleries'])->name('galleries');
