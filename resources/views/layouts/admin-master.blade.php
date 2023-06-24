<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="/admin/assets/img/icon.ico">
    <title>پنل مدیریت | @yield('titlePage')</title>
    <link href="https://fonts.googleapis.com/css?family=Fira+Sans:400,500,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/admin/assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/admin/assets/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" type="text/css" href="/admin/assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/admin/assets/css/fullcalendar.min.css">
    <link rel="stylesheet" type="text/css" href="/admin/assets/css/dataTables.bootstrap.min.css">
    {{--    <link rel="stylesheet" type="text/css" href="/admin/assets/css/select2.min.css">--}}
    <link href="/select2/select2.min.css" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="/admin/assets/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" type="text/css" href="/admin/assets/plugins/morris/morris.css">
    <link rel="stylesheet" type="text/css" href="/admin/assets/css/style.css">

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
        .label_mouse_cursor:hover {
            cursor: pointer !important;
        }

        .bulk-actions {
            margin-bottom: 40px;
            padding: 15px 10px;
            border: solid 1px #ccc;
            border-radius: 8px;
            border-top-right-radius: 0;
            border-top-left-radius: 0;
            border-top: 0;
            background: #cecece;
        }
    </style>

    @yield('Styles')

    @livewireStyles
</head>

<body ng-app="myApp" ng-controller="myCtrl">
<div class="main-wrapper">
    @include('Section.header')
    @include('Section.sidebar')
    <div class="page-wrapper">
        <div class="content container-fluid">

            @yield('content')
        </div>
        <div class="notification-box">

            <div class="msg-sidebar notifications msg-noti">
                <div class="topnav-dropdown-header">
                    <span>پیام های پاسخ داده نشده</span>
                </div>
                <div class="drop-scroll msg-list-scroll">
                    <ul class="list-box">
                        @foreach($not_answered_tickets as $ticket)
                            <li>
                                <a href="{{ route('ticket-answers.show', $ticket->id) }}">
                                    <div class="list-item">
                                        <div class="list-left">
                                            <span class="avatar">R</span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author">{{ $ticket ? \Illuminate\Support\Str::limit($ticket->title, 15) : '' }}</span>
                                            <span class="message-time" style="float: left !important;">{{ \Hekmatinasser\Verta\Verta:: instance($ticket->created_at)->format('%B %d، %Y') }}</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">{{ \Illuminate\Support\Str::limit($ticket->text, 30) }}</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="topnav-dropdown-footer">
                    <a href="chat.html">مشاهده همه پیام ها</a>
                </div>
            </div>

        </div>
    </div>
</div>
<div class="sidebar-overlay" data-reff=""></div>
<script type="text/javascript" src="/admin/assets/js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="/admin/assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/admin/assets/js/jquery.slimscroll.js"></script>
<script type="text/javascript" src="/admin/assets/js/moment.min.js"></script>
<script type="text/javascript" src="/admin/assets/plugins/morris/morris.min.js"></script>
<script type="text/javascript" src="/admin/assets/plugins/raphael/raphael-min.js"></script>
<script type="text/javascript" src="/admin/assets/js/app.js"></script>

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
