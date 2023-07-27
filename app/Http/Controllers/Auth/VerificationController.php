<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Traits\AuthHelpers;
use App\Http\Traits\Responses;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Modules\Auth\Http\Requests\ResetPasswordConfirmRequest;
use Modules\Auth\Http\Requests\ResetPasswordRequest;
use Modules\Auth\Http\Requests\ResetPasswordSetRequest;
use Modules\Auth\Http\Requests\VerifyRequest;
use Modules\User\Entities\User;

class VerificationController extends Controller
{
    use Responses, AuthHelpers;

    public function verify()
    {
        return view('auth.verify');
    }

    public function verify_store(VerifyRequest $request)
    {
        $user = User::wherePhone(session()->get('user_phone'))->firstOrFail();
        $this->verify_code($request->code, $user);
        $user->update(['phone_verified_at' => Carbon::now()]);
        $this->change_is_used($user);

        if (\request('next')){
            $next_route = route('login') . '?next=' . \request('next');
            return $this->SuccessRedirectUrl('تایید حساب کاربری شما باموفقیت انجام شد.', $next_route);
        }
        return $this->SuccessRedirect('تایید حساب کاربری شما باموفقیت انجام شد.', 'login');
    }
}
