@extends('layouts.front-master')

@section('titlePage')
    تماس با بامیز
@endsection

@section('content')
    <div>
        <section class="hero_in contacts start_bg_zoom">
            <div class="wrapper" style="background: url('{{ $settings['about_us_image'] }}'); width: 100% !important;   background-size: cover !important; background-repeat: no-repeat !important;">
                <div class="container">
{{--                    <h1 class="fadeInUp animated"><span></span>تماس با ما</h1>--}}
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
                        <h4>ارسال پیام تماس با ما</h4>
                        <p>پیام ، نظر و یا پیشنهاد خود را لطفا به ما برسانید.</p>
                        <div id="message-contact"></div>
                        <form method="post" action="{{ route('contact_us_submit') }}" id="contactform"
                              autocomplete="off">

                            @csrf

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="id_first_name">نام</label>
                                        <input required class="form-control" type="text" id="id_first_name"
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
                                        <label for="id_email">ایمیل</label>
                                        <input required class="form-control" type="email" id="id_email" name="email">
                                        @error('email')
                                        <span class="text-danger text-wrap">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="id_title">عنوان پیام</label>
                                        <input required class="form-control" type="text" id="id_title" name="title">
                                        @error('title')
                                        <span class="text-danger text-wrap">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <!-- /row -->
                            <div class="form-group">
                                <label for="id_text">متن</label>
                                <textarea required class="form-control" id="id_text" name="text"
                                          style="height:150px;"></textarea>
                                @error('text')
                                <span class="text-danger text-wrap">{{ $message }}</span>
                                @enderror
                            </div>

                            @if(session()->has('contact_us_message'))
                                <div class="mt-3 text-center text-success"
                                     style="font-size: 20px !important;">{{ session()->get('contact_us_message') }}</div>
                            @endif

                            {{--                        @if($errors->any())--}}

                            {{--                            <div class="alert alert-danger text-center" style="font-size: 18px !important;">--}}

                            {{--                                @foreach($errors->all() as $e)--}}
                            {{--                                    {{ $e }}<br>--}}
                            {{--                                @endforeach--}}

                            {{--                            </div>--}}

                            {{--                        @endif--}}

                            <p class="add_top_30"><input type="submit" value="ارسال پیام" class="btn_1 rounded"
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
        // CKEDITOR.replace('id_text');
    </script>
@endpush
