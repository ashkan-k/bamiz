@extends('layouts.auth-master')

@section('titlePage','ثبت نام')

@section('content')

    <div id="login">
        <aside>
            <figure>
                <a href="/"><img src="/front/img/logo_sticky.png" width="155" height="36" data-retina="true" alt=""
                                 class="logo_sticky"></a>
            </figure>
            <form method="POST" action="{{ route('register') }}?next={{ request('next') }}" id="id_frm">
                @csrf

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

                <div class="form-group">
                    <label for="id_password_confirmation">تکرار رمز عبور</label>
                    <input type="password" class="form-control" required name="password_confirmation" id="id_password_confirmation">
                    <i class="icon_lock_alt"></i>
                    @error('password_confirmation')
                    <span class="text-danger text-wrap">{{ $message }}</span>
                    @enderror
                </div>

                <a onclick="$('#id_frm').submit()" class="btn_1 rounded full-width">ثبت نام</a>
                <div class="text-center add_top_10">قبلا ثبت نام کردید؟ <strong><a href="{{ route('login') }}?next={{ request('next') }}">وارد شوید</a></strong></div>
            </form>
            <div class="copy">{{ $settings['copyright'] }}</div>
        </aside>
    </div>

@endsection



