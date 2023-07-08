@extends('layouts.auth-master')

@section('titlePage','بازیابی رمز عبور')

@section('content')

    <div id="login">
        <aside>
            <figure>
                <a href="/"><img src="/front/img/logo_sticky.png" width="155" height="36" data-retina="true" alt=""
                                 class="logo_sticky"></a>
            </figure>
            <form method="POST" action="{{ route('reset_password_store') }}" id="id_frm">
                @csrf

                @if (session()->has('message'))
                    <div class="mt-3 mb-3 text-success">
                        <span>{{ session('message') }}</span>
                    </div>
                @endif

                <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
                    {{ __('رمز عبور خود را فراموش کرده اید؟ مشکلی نیست فقط شماره موبایل خود را وارد کنید و ما یک پیامک احراز هویت برای شما ارسال خواهیم کرد که به شما امکان می دهد رمز عبور جدیدی را انتخاب کنید.') }}
                </div>

                <div class="form-group">
                    <label for="id_phone">شماره موبایل</label>
                    <input type="text" class="form-control" required name="phone" id="id_phone">
                    <i class="icon_phone"></i>
                    @error('phone')
                    <span class="text-danger text-wrap">{{ $message }}</span>
                    @enderror
                </div>

                <a onclick="$('#id_frm').submit()" class="btn_1 rounded full-width">ارسال کد تایید</a>
                <div class="text-center add_top_10">رمز عبور خود را به یاد می آورید؟! <strong><a href="{{ route('login') }}">وارد شوید</a></strong></div>
            </form>
            <div class="copy">{{ $settings['copyright'] }}</div>
        </aside>
    </div>

@endsection



