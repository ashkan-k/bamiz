<div class="row">
    <div class="col-xs-12">
        <div class="col-lg-12">
            <div class="card-box">
                <h2 class="card-title"><b>{{ $titlePage }}</b></h2>

                <form class="form-horizontal"
                      wire:submit.prevent="SubmitProfile"
                      method="post"
                      enctype="multipart/form-data">

                    <div class="form-group">
                        <label class="control-label col-lg-2">نام</label>
                        <div class="col-md-10">
                            <input id="title" type="text" name="first_name"
                                   wire:model.defer="first_name"
                                   class="form-control"
                                   placeholder="نام را وارد کنید"
                                   value="@if(old('first_name')){{ old('first_name') }}@elseif(isset($first_name)){{ $first_name }}@endif">

                            @error('first_name')
                            <span class="text-danger text-wrap">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">نام خانوادگی</label>
                        <div class="col-md-10">
                            <input id="last_name" type="text" name="last_name"
                                   wire:model.defer="last_name"
                                   class="form-control"
                                   placeholder="نام خانوادگی را وارد کنید"
                                   value="@if(old('last_name')){{ old('last_name') }}@elseif(isset($last_name)){{ $last_name }}@endif">
                            @error('last_name')
                            <span class="text-danger text-wrap">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">نام کاربری</label>
                        <div class="col-md-10">
                            <input required type="text" name="username"
                                   wire:model.defer="username"
                                   class="form-control"
                                   placeholder="نام کاربری را وارد کنید"
                                   value="@if(old('username')){{ old('username') }}@elseif(isset($username)){{ $username }}@endif">
                            @error('username')
                            <span class="text-danger text-wrap">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">رمز عبور</label>
                        <div class="col-md-10">
                            <input type="text" name="password"
                                   wire:model.defer="password"
                                   class="form-control"
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
                            <input type="text" name="password_confirmation"
                                   wire:model.defer="password_confirmation"
                                   class="form-control"
                                   placeholder="تکرار رمز عبور را وارد کنید"
                                   value="{{ old('password_confirmation') }}">
                            @error('password_confirmation')
                            <span class="text-danger text-wrap">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-lg-2">ایمیل</label>
                        <div class="col-md-10">
                            <input type="text" name="email"
                                   wire:model.defer="email"
                                   class="form-control"
                                   placeholder="ایمیل را وارد کنید"
                                   value="@if(old('email')){{ old('email') }}@elseif(isset($email)){{ $email }}@endif">

                            @error('email')
                            <span class="text-danger text-wrap">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">شماره تلفن</label>
                        <div class="col-md-10">
                            <input required type="text" name="phone"
                                   wire:model.defer="phone"
                                   class="form-control"
                                   placeholder="شماره تلفن را وارد کنید"
                                   value="@if(old('phone')){{ old('phone') }}@elseif(isset($phone)){{ $phone }}@endif">
                            @error('phone')
                            <span class="text-danger text-wrap">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">آواتار</label>
                        <div class="col-sm-10">

                            <input type="file" name="avatar" id="id_avatar"
                                   wire:model.defer="avatar"
                                   class="form-control"
                                   placeholder="عکس را وارد کنید">

                            @error('avatar')
                            <span class="text-danger text-wrap">{{ $message }}</span>
                            @enderror

                            @if(isset($item->avatar))
                                <div class="input-field col s12 mt-3">
                                    <p>تصویر قبلی:</p>
                                    <a href="{{ $item->avatar }}" target="_blank"><img
                                            src="{{ $item->avatar }}"
                                            width="70"
                                            alt="{{ $item->fullname() }}"></a>
                                </div>
                            @endif
                        </div>

                    </div>


                    <div class="col-lg-12">
                        <div class="m-1-25 m-b-20">
                            <div class="modal-footer">
                                    <button  wire:loading.remove wire:target="avatar" class="btn btn-info btn-border-radius waves-effect" type="submit">ثبت</button>
                                <button wire:loading wire:target="avatar" class="btn btn-info btn-border-radius waves-effect disabled" disabled type="button">درحال آپلود...</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>


@push('StackScript')
    <script type="text/javascript">
        window.addEventListener('profileStatusUpdated', event => {
            showToast('اطلاعات پروفایل شما با موفقیت ویرایش شد.', 'success');
            $('#id_avatar').val('');
        });
    </script>
@endpush
