<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Modules\Sms\Helpers\sms_helper;
use Modules\Sms\Http\Traits\SmsHelpers;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/aaa', function () {

    $payment = \Modules\Payment\Entities\Payment::first();

    $restaurant_manager_text = sprintf(sms_helper::$SMS_PATTERNS['reserve_success_restaurant_manager'], $payment->reserve->place->name, $payment->reserve->user->fullname(), str_replace('-', '/', $payment->reserve->date));

    $username = env('SMS_USERNAME');
    $password = env('SMS_PASSWORD');
    $sender = env('SMS_SENDER_NUMBER');

    $result = \Illuminate\Support\Facades\Http::get("http://sms.rajat.ir/send_line.php?username=$username&password=$password&to=09396988720&fori=2&from=$sender&text=$restaurant_manager_text");

    dd($result->status(), $result->json());

    return view('test_map');
});

Route::get('/bbb', function () {
    $api = new \Ghasedak\GhasedakApi('fff31530b6a85e6b8c58607d665ac4327463e46bb4eb734dcd6daa8ff23a2cfd');
//    $api->SendSimple(
//        "09396988720", // receptor
//        "سلام!", // message
//        "300002525" // choose a line number from your account
//    );

    $api->Verify(
        "09396988720",  // receptor
        "placereservationmessage",  // name of the template which you've created in you account
        "خورشید",       // parameters (supporting up to 10 parameters)
        "اشکان کریمی",
        "1402/05/28"
    );

});

Route::get('/', function () {
    return view('welcome');
});
//
//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

//Route::middleware('auth')->group(function () {
//    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
//});

require __DIR__.'/auth.php';
