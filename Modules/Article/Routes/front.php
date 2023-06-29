<?php


use Illuminate\Support\Facades\Route;
use Modules\Article\Http\Controllers\Front\FrontArticleController;

Route::get('articles' , [FrontArticleController::class , 'articles'])->name('articles');
Route::get('articles/{article:slug}' , [FrontArticleController::class , 'article_detail'])->name('article_detail');
