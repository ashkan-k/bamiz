<?php


use Illuminate\Support\Facades\Route;
use Modules\Article\Http\Controllers\Front\FrontArticleController;

Route::get('articles' , [FrontArticleController::class , 'articles'])->name('articles');
