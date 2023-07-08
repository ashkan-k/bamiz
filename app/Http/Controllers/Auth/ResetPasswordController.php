<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Traits\AuthHelpers;
use App\Http\Traits\Responses;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Modules\Auth\Http\Requests\ResetPasswordConfirmRequest;
use Modules\Auth\Http\Requests\ResetPasswordRequest;
use Modules\Auth\Http\Requests\ResetPasswordSetRequest;
use Modules\User\Entities\User;

class ResetPasswordController extends Controller
{
    use Responses, AuthHelpers;

    public function reset_password()
    {
        return view('auth.passwords.reset_password');
    }

    public function reset_password_store(ResetPasswordRequest $request)
    {
        $user = User::wherePhone($request->phone)->first();
        $this->SendCode($user);
        $this->set_helper_sessions($user, true);
        return $this->SuccessRedirect('کد بازیابی رمز عبور باموفقیت برای شما پیامک شد.','reset_password_confirm');
    }

    public function reset_password_confirm()
    {
        User::wherePhone(session()->get('user_phone'))->firstOrFail();
        return view('auth.passwords.reset_password_confirm');
    }

    public function reset_password_confirm_store(ResetPasswordConfirmRequest $request)
    {
        $user = User::wherePhone(session()->get('user_phone'))->firstOrFail();
        $this->verify_code($request->code, $user);
        $this->change_is_used($user);
        return $this->SuccessRedirect('تایید حساب کاربری با موفقیت انجام شد و اکنون میتوانید رمز جدید خود را وارد کنید.','reset_password_set');
    }

    public function reset_password_set()
    {
        User::wherePhone(session()->get('user_phone'))->firstOrFail();
        return view('auth.passwords.reset_password_enter');
    }

    public function reset_password_set_store(ResetPasswordSetRequest $request)
    {
        $user = User::wherePhone(session()->get('user_phone'))->firstOrFail();
        $user->set_password($request->password);
        return $this->SuccessRedirect('تغییر رمز عبور شما با موفقیت انجام شد . اکنون میتوانید وارد شوید.','login');
    }
}
