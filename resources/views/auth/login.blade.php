@extends('layouts.auth-master')

@section('titlePage','ورود')

@section('content')

    <div id="login">
        <aside>
            <figure>
                <a href="/"><img src="/front/img/logo_sticky.png" width="155" height="36" data-retina="true" alt=""
                                 class="logo_sticky"></a>
            </figure>
            <form method="POST" action="{{ route('login') }}?next={{ request('next') }}" id="id_frm">
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
                    <label for="id_phone">شماره موبایل (نام کاربری)</label>
                    <input type="text" class="form-control" required name="phone" id="id_phone" value="{{ old('phone') }}">
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
                            <input type="checkbox" checked name="remember">
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



