<?php


use Illuminate\Support\Facades\Route;
use Modules\ContactUs\Http\Controllers\Front\FrontContactUsController;

Route::get('contact-us' , [FrontContactUsController::class , 'contact_us'])->name('contact_us');
Route::post('contact-us' , [FrontContactUsController::class , 'contact_us_submit'])->name('contact_us_submit');
