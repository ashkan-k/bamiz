@extends('layouts.admin-master')

@section('titlePage','ارسال پیامک')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <h2 class="card-title"><b>ارسال پیامک </b></h2>

                <div class="form-group">
                    <label for="id_user">کاربران</label>
                    <select multiple class="form-control" required name="user_id" id="id_user" style="width: 100%">
                        @foreach($users as $item)
                            <option value="{{ $item->phone }}">{{ $item->fullname() }} ({{ $item->phone }})</option>
                        @endforeach
                    </select>

                    @error('user')
                    <span class="text-danger text-wrap">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="id_text">متن پیامک</label>
                    <textarea rows="8" class="form-control" ng-model="text" name="text" id="id_text" required placeholder="متن پیامک را وارد کنید">@if(old('text')){{ old('text') }}@elseif(isset($blog->text)){{ $blog->text }}@endif</textarea>

                    @error('text')
                    <span class="text-danger text-wrap">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-lg-12">
                    <div class="m-1-25 m-b-20" style="float: left !important;">
                        <a href="{{ url()->previous() }}"
                           ng-disabled="is_submited"
                           class="btn btn-danger btn-border-radius waves-effect">
                            بازگشت
                        </a>
                        <button class="btn btn-info btn-border-radius waves-effect" type="button"
                                ng-click="Submit()" ng-disabled="is_submited || !text">ارسال
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection

@section('Scripts')

    <script>
        $('#id_user').select2();
    </script>
    <script>
        app.controller('myCtrl', function ($scope, $http) {
            $scope.text = null;
            $scope.users = [];
            $scope.is_submited = '';

            $scope.Submit = function () {
                $scope.users = $('#id_user').val();

                if (!$scope.text) {
                    showToast('لطفا متن پیامک را وارد کنید.', 'error');
                    return;
                }
                if ($scope.users.length == 0) {
                    showToast('لطفا حداقل یک شماره موبایل برای ارسال پیامک انتخاب کنید.', 'error');
                    return;
                }

                $scope.is_submited = true;

                var data = {
                    "users": $scope.users,
                    "message": $scope.text,
                };

                $http.post('{{ route('api.sms.send') }}', data).then(res => {
                    showToast('با موفقیت ارسال شد.', 'success');
                    $( "#id_user" ).val('').trigger('change');
                    $scope.text = null;
                    $scope.is_submited = false;
                }).catch(err => {
                    $scope.is_submited = false;
                    showToast('خطایی رخ داد.', 'error');
                });
            }
        });
    </script>

@endsection
