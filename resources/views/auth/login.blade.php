{{--<x-guest-layout>--}}
{{--    <!-- Session Status -->--}}
{{--    <x-auth-session-status class="mb-4" :status="session('status')" />--}}

{{--    <form method="POST" action="{{ route('login') }}">--}}
{{--        @csrf--}}

{{--        <input type="hidden" name="next" value="{{ request('next') }}">--}}

{{--        <!-- Email Address -->--}}
{{--        <div>--}}
{{--            <x-input-label for="phone" :value="__('Phone')" />--}}
{{--            <x-text-input id="phone" class="block mt-1 w-full" type="phone" name="phone" :value="old('phone')" required autofocus autocomplete="phone" />--}}
{{--            <x-input-error :messages="$errors->get('phone')" class="mt-2" />--}}
{{--        </div>--}}

{{--        <!-- Password -->--}}
{{--        <div class="mt-4">--}}
{{--            <x-input-label for="password" :value="__('Password')" />--}}

{{--            <x-text-input id="password" class="block mt-1 w-full"--}}
{{--                            type="password"--}}
{{--                            name="password"--}}
{{--                            required autocomplete="current-password" />--}}

{{--            <x-input-error :messages="$errors->get('password')" class="mt-2" />--}}
{{--        </div>--}}

{{--        <!-- Remember Me -->--}}
{{--        <div class="block mt-4">--}}
{{--            <label for="remember_me" class="inline-flex items-center">--}}
{{--                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">--}}
{{--                <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>--}}
{{--            </label>--}}
{{--        </div>--}}

{{--        <div class="flex items-center justify-end mt-4">--}}
{{--            @if (Route::has('password.request'))--}}
{{--                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">--}}
{{--                    {{ __('Forgot your password?') }}--}}
{{--                </a>--}}
{{--            @endif--}}

{{--            <x-primary-button class="ml-3">--}}
{{--                {{ __('Log in') }}--}}
{{--            </x-primary-button>--}}
{{--        </div>--}}
{{--    </form>--}}
{{--</x-guest-layout>--}}

@extends('layouts.auth-master')

@section('titlePage','ورود')

@section('content')

    <div id="login">
        <aside>
            <figure>
                <a href="/"><img src="/front/img/logo_sticky.png" width="155" height="36" data-retina="true" alt=""
                                 class="logo_sticky"></a>
            </figure>
            <form method="POST" action="{{ route('login') }}" id="id_frm">
                @csrf

                {{--            <div class="access_social">--}}
                {{--                <a href="#0" class="social_bt facebook">Login with Facebook</a>--}}
                {{--                <a href="#0" class="social_bt google">Login with Google</a>--}}
                {{--                <a href="#0" class="social_bt linkedin">Login with Linkedin</a>--}}
                {{--            </div>--}}
                {{--            <div class="divider"><span>Or</span></div>--}}


                @if (session()->has('message'))
                    <div class="mt-3 mb-3 text-success">
                        <span>{{ session('message') }}</span>
                    </div>
                @endif

                <div class="form-group">
                    <label for="id_phone">شماره موبایل</label>
                    <input type="text" class="form-control" required name="phone" id="id_phone">
                    <i class="icon_phone"></i>
                    @error('phone')
                    <span class="text-danger text-wrap">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="id_password">رمز عبور</label>
                    <input type="password" class="form-control" required name="password" id="id_password">
                    <i class="icon_lock_alt"></i>
                    @error('password')
                    <span class="text-danger text-wrap">{{ $message }}</span>
                    @enderror
                </div>

                <div class="clearfix add_bottom_30">
                    <div class="checkboxes float-left">
                        <label class="container_check">مرا بخاطر بسپار
                            <input type="checkbox" name="remember">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="float-right mt-1"><a id="forgot" href="{{ route('reset_password') }}">رمز عبور خود را فراموش کرده
                            اید؟</a></div>
                </div>

                <a onclick="$('#id_frm').submit()" class="btn_1 rounded full-width">ورود</a>
                <div class="text-center add_top_10">حساب کاربری ندارید؟! <strong><a href="{{ route('register') }}">ثبت
                            نام کنید</a></strong></div>
            </form>
            <div class="copy">{{ $settings['copyright'] }}</div>
        </aside>
    </div>

@endsection



