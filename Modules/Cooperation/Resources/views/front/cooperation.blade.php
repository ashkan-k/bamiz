@extends('layouts.front-master')

@section('titlePage')
    درخواست همکاری با بامیز
@endsection

@section('content')
    <div>
        <section class="hero_in contacts start_bg_zoom">
            <div class="wrapper">
                <div class="container">
                    <h1 class="fadeInUp animated"><span></span>درخواست همکاری با بامیز</h1>
                </div>
            </div>
        </section>
        <!--/hero_in-->

        <div class="contact_info">
            <div class="container">
                <ul class="clearfix">
                    <li>
                        <i class="pe-7s-map-marker"></i>
                        <h4>آدرس</h4>
                        <span>{{ $settings['address'] }}</span>
                    </li>
                    <li>
                        <i class="pe-7s-mail-open-file"></i>
                        <h4>ایمیل</h4>
                        <span>{{ $settings['email'] }}</span>

                    </li>
                    <li>
                        <i class="fa fa-phone"></i>
                        <h4>شماره تلفن</h4>
                        <span>{{ $settings['phone'] }}</span>
                    </li>
                </ul>
            </div>
        </div>
        <!--/contact_info-->

        <div class="bg_color_1">
            <div class="container margin_80_55">
                <div class="row justify-content-between">
                    <div class="col-lg-12">
                        <i class="fa fa-phone"></i>
                        <h4>ارسال درخواست همکاری با ما</h4>
                        <p>لطفا اطلاعات مربوط به خود و مرکز خود را برای ما ارسال نمایید.</p>
                        <div id="message-contact"></div>
                        <form method="post" action="{{ route('cooperation_submit') }}" id="contactform"
                              enctype="multipart/form-data"
                              autocomplete="off">

                            @csrf

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="id_first_name">نام</label>
                                        <input required class="form-control" type="text" id="id_first_name"
                                               value="{{ old('first_name') }}"
                                               name="first_name">
                                        @error('first_name')
                                        <span class="text-danger text-wrap">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="id_last_name">نام خانوادگی</label>
                                        <input required class="form-control" type="text" id="id_last_name"
                                               value="{{ old('last_name') }}"
                                               name="last_name">
                                        @error('last_name')
                                        <span class="text-danger text-wrap">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <!-- /row -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="id_phone">شماره موبایل</label>
                                        <input required class="form-control" type="number"
                                               value="{{ old('phone') }}"
                                               id="id_phone" name="phone">
                                        @error('phone')
                                        <span class="text-danger text-wrap">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="id_file">فایل ضمیمه (اختیاری)</label>
                                        <input class="form-control" type="file" id="id_file" name="file">
                                        @error('file')
                                        <span class="text-danger text-wrap">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <!-- /row -->
                            <div class="form-group">
                                <label for="id_address">آدرس</label>
                                <textarea required class="form-control" id="id_address" name="address"
                                          style="height:150px;">{{ old('address') }}</textarea>
                                @error('address')
                                <span class="text-danger text-wrap">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="id_description">توضیحات</label>
                                <textarea required class="form-control" id="id_description" name="description"
                                          style="height:150px;">{{ old('description') }}</textarea>
                                @error('description')
                                <span class="text-danger text-wrap">{{ $message }}</span>
                                @enderror
                            </div>

                            <p class="add_top_30"><input type="submit" value="ارسال درخواست" class="btn_1 rounded"
                                                         id="submit-contact"></p>
                        </form>
                    </div>
                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </div>
        <!-- /bg_color_1 -->
    </div>
@endsection

@push('StackScript')
    <script>
        CKEDITOR.replace('id_description');
    </script>
@endpush
