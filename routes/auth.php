<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.store');
});

// Custom Reset Password methods
Route::group(['middleware' => ['guest']], function () {
    ## Dashboard ##
    Route::get('verify', [VerificationController::class, 'verify'])->name('verify');
    Route::post('verify/store', [VerificationController::class, 'verify_store'])->name('verify_store');

    ## Reset Password ##
    Route::group(['prefix' => 'password'], function () {
        Route::get('reset', [ResetPasswordController::class, 'reset_password'])->name('reset_password');
        Route::post('reset/store', [ResetPasswordController::class, 'reset_password_store'])->name('reset_password_store');

        Route::get('reset/confirm/account', [ResetPasswordController::class, 'reset_password_confirm'])->name('reset_password_confirm');
        Route::post('reset/confirm/account/store', [ResetPasswordController::class, 'reset_password_confirm_store'])->name('reset_password_confirm_store');

        Route::get('reset/set/new', [ResetPasswordController::class, 'reset_password_set'])->name('reset_password_set');
        Route::post('reset/set/new/store', [ResetPasswordController::class, 'reset_password_set_store'])->name('reset_password_set_store');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
                ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
});
