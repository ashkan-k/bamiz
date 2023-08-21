@extends('layouts.auth-master')

@section('titlePage','بازیابی رمز عبور')

@section('content')

    <div id="login">
        <aside>
            <figure>
                <a href="/"><img src="/front/img/logo_sticky.png" width="155" height="36" data-retina="true" alt=""
                                 class="logo_sticky"></a>
            </figure>

            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <form method="POST" action="{{ route('reset_password_set_store') }}" id="id_frm">
                            @csrf

                            @if (session()->has('message'))
                                <div class="mt-3 mb-3 text-success">
                                    <span>{{ session('message') }}</span>
                                </div>
                            @endif

                            <div class="form-group">
                                {{--                    <label for="id_password">تکرار رمز عبور</label>--}}
                                <label for="id_password">نام کاربری</label>
                                <input type="password" class="form-control" required name="password" id="id_password">
                                <i class="icon_lock_alt"></i>
                                @error('password')
                                <span class="text-danger text-wrap">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                {{--                    <label for="id_password_confirmation">تکرار رمز عبور</label>--}}
                                <label for="id_password_confirmation">تکرار نام کاربری</label>
                                <input type="password" class="form-control" required name="password_confirmation"
                                       id="id_password_confirmation">
                                <i class="icon_lock_alt"></i>
                                @error('password_confirmation')
                                <span class="text-danger text-wrap">{{ $message }}</span>
                                @enderror
                            </div>


                            <a onclick="$('#id_frm').submit()" class="btn_1 rounded full-width">ذخیره</a>
                            <div class="text-center add_top_10">رمز عبور خود را به یاد می آورید؟! <strong><a
                                        href="{{ route('login') }}">وارد شوید</a></strong></div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="copy">{{ $settings['copyright'] }}</div>
        </aside>
    </div>

@endsection
