<div class="row">
    <div class="col-xs-12">
        <div class="col-lg-12">
            <div class="card-box">
                <h2 class="card-title"><b>{{ $titlePage }}</b></h2>

                <form class="form-horizontal"
                      action="{{ $type == 'edit' ? route('users.update' , $user->id) : route('users.store') }}"
                      method="post"
                      enctype="multipart/form-data">

                    @if($type == 'edit')
                        @method('PATCH')
                    @endif

                    @csrf

                    <div class="form-group">
                        <label class="control-label col-lg-2">نام</label>
                        <div class="col-md-10">
                            <input id="title" type="text" name="name"
                                   class="form-control rounded"
                                   placeholder="نام را وارد کنید"
                                   value="@if(old('first_name')){{ old('first_name') }}@elseif(isset($user->first_name)){{ $user->first_name }}@endif">

                            @error('first_name')
                            <span class="text-danger text-wrap">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">نام خانوادگی</label>
                        <div class="col-md-10">
                            <input id="last_name" type="text" name="last_name"
                                   class="form-control rounded"
                                   placeholder="نام خانوادگی را وارد کنید"
                                   value="@if(old('last_name')){{ old('last_name') }}@elseif(isset($user->last_name)){{ $user->last_name }}@endif">
                            @error('last_name')
                            <span class="text-danger text-wrap">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">نام کاربری</label>
                        <div class="col-md-10">
                            <input required type="text" name="username"
                                   class="form-control rounded"
                                   placeholder="نام کاربری را وارد کنید"
                                   value="@if(old('username')){{ old('username') }}@elseif(isset($user->username)){{ $user->username }}@endif">
                            @error('username')
                            <span class="text-danger text-wrap">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">رمز عبور</label>
                        <div class="col-md-10">
                            <input {{ $type != 'edit' && "required" }} type="text" name="password"
                                   class="form-control rounded"
                                   placeholder="رمز عبور را وارد کنید"
                                   value="{{old('password') }}">
                            @error('password')
                            <span class="text-danger text-wrap">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">تکرار رمز عبور</label>
                        <div class="col-md-10">
                            <input {{ $type != 'edit' && "required" }} type="text" name="rep_password"
                                   class="form-control rounded"
                                   placeholder="تکرار رمز عبور را وارد کنید"
                                   value="{{ old('rep_password') }}">
                            @error('rep_password')
                            <span class="text-danger text-wrap">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-lg-2">ایمیل</label>
                        <div class="col-md-10">
                            <input required type="email" name="email"
                                   class="form-control rounded"
                                   placeholder="ایمیل را وارد کنید"
                                   value="@if(old('email')){{ old('email') }}@elseif(isset($user->email)){{ $user->email }}@endif">

                            @error('email')
                            <span class="text-danger text-wrap">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">شماره تلفن</label>
                        <div class="col-md-10">
                            <input required type="text" name="phone"
                                   class="form-control rounded"
                                   placeholder="شماره تلفن را وارد کنید"
                                   value="@if(old('phone')){{ old('phone') }}@elseif(isset($user->phone)){{ $user->phone }}@endif">
                            @error('phone')
                            <span class="text-danger text-wrap">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">نقش</label>
                        <div class="col-md-10">

                            <select class="form-control rounded" name="level">

                                <option @if(isset($user->phone) && $user->level == 'admin') selected
                                        @endif value="admin">مدیر
                                </option>
                                <option @if(isset($user->phone) && $user->level == 'staff') selected
                                        @endif value="admin">کارمند
                                </option>
                                <option @if(isset($user->phone) && $user->level == 'user') selected @endif value="user">
                                    کاربر
                                </option>
                                <option @if(isset($user->phone) && $user->level == 'restaurant_manager') selected
                                        @endif value="restaurant_manager">مدیر رستوران
                                </option>

                            </select>

                            @error('level')
                            <span class="text-danger text-wrap">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{--                    <div class="form-group">--}}
                    {{--                        <label class="control-label col-lg-2">آیا فعال است؟</label>--}}
                    {{--                        <div class="col-md-10">--}}
                    {{--                            <input type="checkbox" name="active"--}}
                    {{--                                   class="form-control rounded"--}}
                    {{--                                   placeholder="وضعیت فعال را وارد کنید"--}}
                    {{--                                   value="{{ old('active') ?: 1 }}" {{ isset($user) && $user->active == 1 ? "checked" : "" }}>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}

                    <div class="form-group">
                        <label class="control-label col-lg-2">آواتار</label>
                        <div class="col-sm-10">

                            <input type="file" name="avatar"
                                   class="form-control rounded"
                                   placeholder="عکس را وارد کنید"
                                   value="{{ old('avatar') }}">

                            @error('avatar')
                            <span class="text-danger text-wrap">{{ $message }}</span>
                            @enderror

                            @if(isset($user) && $user->avatar)
                                <div class="input-field col s12 mt-3">
                                    <p>تصویر قبلی:</p>
                                    <a href="{{ $user->avatar }}" target="_blank"><img
                                            src="{{ $user->avatar }}"
                                            width="70"
                                            alt="{{ $user->fullname() }}"></a>
                                </div>
                            @endif
                        </div>

                    </div>


                    <div class="col-lg-12">
                        <div class="m-1-25 m-b-20">
                            <button class="btn btn-info btn-border-radius waves-effect" type="submit">ثبت</button>
                            <a href="{{ route('users.index') }}"
                               class="btn btn-danger btn-border-radius waves-effect">
                                بازگشت
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>


@push("StackScript")



@endpush
