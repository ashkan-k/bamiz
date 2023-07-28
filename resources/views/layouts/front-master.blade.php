<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('titlePage')</title>

    <!-- Favicons-->
    <link rel="shortcut icon" href="/front/img/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon" href="/front/img/apple-touch-icon-57x57-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72"
          href="/front/img/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114"
          href="/front/img/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144"
          href="/front/img/apple-touch-icon-144x144-precomposed.png">

    <!-- GOOGLE WEB FONT -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800" rel="stylesheet">

    <!-- BASE CSS -->
    <link href="/front/css/bootstrap-rtl.min.css" rel="stylesheet">
    <link href="/front/css/style.css" rel="stylesheet">
    <link href="/front/css/style-rtl.css" rel="stylesheet">
    <link href="/front/css/vendors.css" rel="stylesheet">

    <!-- YOUR CUSTOM CSS -->
    <link href="/front/css/custom.css" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
          integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css"
          id="theme-styles">

    <link rel="stylesheet" type="text/css" href="/admin/assets/css/font-awesome.min.css">

    <link href="/select2/select2.min.css" rel="stylesheet"/>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css"
          id="theme-styles">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
          integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
          crossorigin="anonymous"/>

    <link rel="stylesheet" href="/admin/assets/css/kamadatepicker.min.css"/>
    <link rel="stylesheet" href="/timepicker2/dist/css/timepicker.min.css"/>

    {!! SEOMeta::generate() !!}

    <style>
        .select2-selection--single {
            height: 41px !important;
        }

        #select2-id_city-container {
            padding-top: 5px;
        }
    </style>

    @yield('Styles')
    @stack('StackStyle')

    @livewireStyles

</head>
<body class="rtl" ng-app="myApp" ng-controller="myCtrl">
<div id="page">

    <header class="header menu_fixed">
        <div id="preloader">
            <div data-loader="circle-side"></div>
        </div><!-- /Page Preload -->
        <div id="logo">
{{--            <a href="/">--}}
{{--                <img src="{{ $settings['logo'] }}" width="150" height="36" alt="" class="logo_normal">--}}
{{--                <img src="{{ $settings['logo'] }}" width="150" height="36" alt="" class="logo_sticky">--}}
{{--            </a>--}}
        </div>
        <ul id="top_menu">

            @if(auth()->check())
                <form style="display: none" action="{{ route('logout') }}" method="post" id="frm_logout">
                    @csrf
                </form>
                <li><a onclick="$('#frm_logout').submit()" class="login" title="خروج">خروج</a></li>
                <li><a href="{{ route('wishlists') }}" class="wishlist_bt_top" title="محبوب های من">محبوب های من</a>
                </li>
                <li><span> <a href="{{ route('user_profile') }}">پروفایل کاربری</a> </span></li>
            @else
                <li><span>  </span></li>

                <li><span> <a href="{{ route('register') }}">عضویت / ورود</a> </span></li>
            @endif
        </ul>
        <!-- /top_menu -->
        <a href="#menu" class="btn_mobile">
            <div class="hamburger hamburger--spin" id="hamburger">
                <div class="hamburger-box">
                    <div class="hamburger-inner"></div>
                </div>
            </div>
        </a>
        <nav id="menu" class="main-menu">
            <ul>
                @php $categories = \Modules\Category\Entities\Category::all() @endphp

                <li><span><a href="/">صفحه نخست</a></span></li>
                <li><span><a>میزبان ها</a></span>
                    <ul>
                        @foreach($categories as $c)
                            <li>
                                <a href="{{ route('categories', $c->slug) }}">{{ $c->title ?: '---' }}</a>
                            </li>
                        @endforeach
                    </ul>
                </li>
                <li><span><a>رزرو سریع</a></span>
                    <ul>
                        <li>
                            <a href="{{ route('places') }}">رزرو مکان</a>
                        </li>
                    </ul>
                </li>
                <li><span><a href="{{ route('cooperation') }}">درخواست همکاری</a></span></li>
                <li><span><a href="{{ route('articles') }}">بلاگ</a></span></li>
                <li><span><a href="{{ route('about_us') }}">درباره بامیز </a></span></li>
                <li><span><a href="{{ route('contact_us') }}">تماس با بامیز </a></span></li>
            </ul>
        </nav>
    </header>
    <!-- /header -->

    <main>
        @yield('content')
    </main>

    <!-- /main -->

    <footer>
        <div class="container margin_60_35">
            <div class="row">
                <div class="col-lg-5 col-md-12 p-r-5">
                    <p><img src="{{ $settings['logo'] }}" width="150" height="36" alt=""></p>
                    <p>{{ $settings['introduction'] }}</p>
                    <div class="follow_us">
                        <ul>
                            <li>ما را دنبال کنید</li>
                            <li><a href="https://www.facebook.com/{{ $settings['facebook'] }}"><i style="font-family: themify!important;"
                                                                         class="ti-facebook"></i></a></li>
                            <li><a href="https://twitter.com/tweeter/{{ $settings['twitter'] }}"><i style="font-family: themify!important;"
                                                                        class="ti-twitter-alt"></i></a></li>
                            <li><a href="https://www.instagram.com/{{ $settings['instagram'] }}"><i style="font-family: themify!important;"
                                                                          class="ti-instagram"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 ml-lg-auto">
                    <h5>دسترسی سریع</h5>
                    <ul class="links">
                        <li><a href="{{ route('about_us') }}">درباره ما</a></li>
                        <li><a href="{{ route('login') }}">ورود</a></li>
                        <li><a href="{{ route('register') }}">ثبت نام</a></li>
                        <li><a href="{{ route('articles') }}">اخبار و رویداد ها</a></li>
                        <li><a href="{{ route('contact_us') }}">تماس با ما</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5>تماس با ما</h5>
                    <ul class="contacts">
                        <li><a href="tel://{{ $settings['phone'] }}"><i class="ti-mobile" style="font-family: themify!important;"></i>{{ $settings['phone'] }}
                            </a></li>
                        <li><a href='mailto:{{ $settings['email'] }}'><i style="font-family: themify!important;"
                                    class="ti-email"></i>{{ $settings['email'] }}</a></li>
                    </ul>
                    <div id="newsletter">
                        <h6>خبر نامه</h6>
                        <div id="message-newsletter"></div>
                        <form method="post" action="" name="newsletter_form" id="newsletter_form">
                            <div class="form-group">
                                <input type="email" name="email_newsletter" id="email_newsletter" class="form-control"
                                       placeholder="ایمیل خود را وارد نمایید">
                                <input type="submit" value="عضویت" id="submit-newsletter">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--/row-->
            <hr>
            <div class="row">
                <div class="col-lg-6">
                    <ul id="footer-selector">
                        <li><img src="/front/img/cards_all.svg" alt=""></li>
                    </ul>
                </div>
                <div class="col-lg-6">
                    <ul id="additional_links">
                        <li><a href="{{ route('about_us') }}">قوانین و مقررات</a></li>
                        <li><a href="{{ route('contact_us') }}">تماس با ما</a></li>
                        <li><a href="{{ route('cooperation') }}">همکاری با ما</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <!--/footer-->
</div>
<!-- page -->

<!-- Sign In Popup -->
<div id="sign-in-dialog" class="zoom-anim-dialog mfp-hide">
    <div class="small-dialog-header">
        <h3>Sign In</h3>
    </div>
    <form>
        <div class="sign-in-wrapper">
            <a href="/front/#0" class="social_bt facebook">Login with Facebook</a>
            <a href="/front/#0" class="social_bt google">Login with Google</a>
            <div class="divider"><span>Or</span></div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" name="email" id="email">
                <i class="icon_mail_alt"></i>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="password" id="password" value="">
                <i class="icon_lock_alt"></i>
            </div>
            <div class="clearfix add_bottom_15">
                <div class="checkboxes float-left">
                    <label class="container_check">Remember me
                        <input type="checkbox">
                        <span class="checkmark"></span>
                    </label>
                </div>
                <div class="float-right mt-1"><a id="forgot" href="/front/javascript:void(0);">Forgot Password?</a>
                </div>
            </div>
            <div class="text-center"><input type="submit" value="Log In" class="btn_1 full-width"></div>
            <div class="text-center">
                Don’t have an account? <a href="/front/register.html">Sign up</a>
            </div>
            <div id="forgot_pw">
                <div class="form-group">
                    <label>Please confirm login email below</label>
                    <input type="email" class="form-control" name="email_forgot" id="email_forgot">
                    <i class="icon_mail_alt"></i>
                </div>
                <p>You will receive an email containing a link allowing you to reset your password to a new preferred
                    one.</p>
                <div class="text-center"><input type="submit" value="Reset Password" class="btn_1"></div>
            </div>
        </div>
    </form>
    <!--form -->
</div>
<!-- /Sign In Popup -->

<div id="toTop"></div><!-- Back to top button -->

@if(\Illuminate\Support\Facades\Route::currentRouteName() == 'place_detail')
    <p class="btn_home_align" style="text-align: center !important;">
        @auth
            <a style="display: none !important;" href="#sign-in-dialog" id="sign-in" class="btn_1 rounded">رزرو</a>
        @else
            <a style="display: none !important;" onclick="window.location.href='{{ route('register') }}?next={{ request()->path() }}'" id="sign-in" class="btn_1 rounded">رزرو</a>
        @endif
    </p>
@endif

<!-- COMMON SCRIPTS -->
<script src="/front/js/common_scripts.js"></script>
<script src="/front/js/main_rtl.js"></script>
{{--<script src="/front/assets/validate.js"></script>--}}
{{----}}
{{--<script src="/front/js/bamiz.js"></script>--}}

<!-- SPECIFIC SCRIPTS -->
{{--<script src="/front/js/video_header.js"></script>--}}
{{--<script>--}}
{{--    HeaderVideo.init({--}}
{{--        container: $('.header-video'),--}}
{{--        header: $('.header-video--media'),--}}
{{--        videoTrigger: $("#video-trigger"),--}}
{{--        autoPlayVideo: true--}}
{{--    });--}}
{{--</script>--}}

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous"></script>
<script src="/helpers/js/angular.min.js"></script>
<script src="/helpers/js/helpers.js"></script>
<script src="/select2/select2.min.js"></script>
<script src="/ckeditor/ckeditor.js"></script>
<script src="/admin/assets/js/kamadatepicker.min.js"></script>
<script src="/timepicker2/dist/js/timepicker.min.js"></script>

<script>
    var app = angular.module("myApp", []);
    app.config(function ($interpolateProvider, $httpProvider) {
        $interpolateProvider.startSymbol('[[');
        $interpolateProvider.endSymbol(']]');

        // $httpProvider.defaults.xsrfCookieName = 'csrftoken';
        // $httpProvider.defaults.xsrfHeaderName = 'X-CSRF-TOKEN';
        $httpProvider.defaults.headers.common['X-CSRF-TOKEN'] = $('meta[name="csrf-token"]').attr('content');
    });
</script>

@if (session()->has('message'))
    <script>
        Swal.fire({
            title: "تبریک ! 🥳",
            icon: 'success',
            text: '{{ session('message') }}',
            type: "success",
            cancelButtonColor: 'var(--primary)',
            confirmButtonText: 'اوکی',
        })
    </script>

@endif

@livewireScripts

@yield('Scripts')

@stack('StackScript')

</body>
</html>
