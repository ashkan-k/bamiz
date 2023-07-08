@extends('layouts.auth-master')

@section('titlePage','بازیابی رمز عبور')

@section('content')

    <div id="login" ng-init="init()">
        <aside>
            <figure>
                <a href="/"><img src="/front/img/logo_sticky.png" width="155" height="36" data-retina="true" alt=""
                                 class="logo_sticky"></a>
            </figure>
            <form method="POST" action="{{ route('reset_password_confirm_store') }}" id="id_frm">
                @csrf

                @if (session()->has('message'))
                    <div class="mt-3 mb-3 text-success">
                        <span>{{ session('message') }}</span>
                    </div>
                @endif

                <div class="form-group">
                    <label for="id_code"> کد تایید 6 رقمی</label>
                    <input type="text" class="form-control" required name="code" id="id_code">
                    <i class="icon_code"></i>
                    @error('code')
                    <span class="text-danger text-wrap">{{ $message }}</span>
                    @enderror
                </div>

                <a ng-style="counter > 0 && {'cursor': 'not-allowed'}" ng-click="SendNewCode()" ng-disabled="counter > 0 || is_submited" class="btn_1 rounded full-width">
                    <span ng-show="counter > 0">دریافت مجدد کد تایید ([[counter]] ثانیه)</span>
                    <span ng-show="counter <= 0">دریافت مجدد کد تایید</span>
                </a>

                <a onclick="$('#id_frm').submit()" class="btn_1 rounded full-width">تأیید</a>
                <div class="text-center add_top_10">رمز عبور خود را به یاد می آورید؟! <strong><a
                            href="{{ route('login') }}">وارد شوید</a></strong></div>
            </form>
            <div class="copy">{{ $settings['copyright'] }}</div>
        </aside>
    </div>

@endsection

@section('Scripts')

    <script>
        app.controller('myCtrl', function ($scope, $http) {
            $scope.phone = null;
            $scope.email = null;
            $scope.is_submited = false;

            @include('auth.auth_js')

            $scope.init = function () {
                $scope.phone = '{{ session('user_phone') }}';
                countDown();
            }

            $scope.SendNewCode = function () {
                if ($scope.counter > 0){
                    return;
                }

                $scope.is_submited = true;

                var url = '{{ route('send_verify_code') }}';
                var data = {'phone': $scope.phone};

                $http.post(url, data).then(res => {
                    $scope.is_submited = false
                    showToast(res.data['data'], 'success');
                    $scope.counter = 0;
                    countDown();
                }).catch(err => {
                    $scope.is_submited = false
                    if (err['data']['errors'] && err['data']['errors']['code'] && err['data']['errors']['code'][0]) {
                        showToast(err['data']['errors']['code'][0], 'error');
                        return;
                    }
                    showToast('خطایی رخ داد. لطفا دوباره امتحان کنید.', 'error');
                });
            }
        });
    </script>

@endsection
