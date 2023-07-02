<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description"
          content="Panagea - Premium site template for travel agencies, hotels and restaurant listing.">
    <meta name="author" content="Ansonika">
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

    @yield('Styles')

</head>

<body id="login_bg" class="rtl">

<nav id="menu" class="fake_menu"></nav>

<div id="preloader">
    <div data-loader="circle-side"></div>
</div>

@yield('content')

{{--<script src="/front/js/jquery-2.2.4.min.js"></script>--}}
<script src="/front/js/common_scripts.js"></script>
<script src="/front/js/main_rtl.js"></script>
<script src="/front/assets/validate.js"></script>

</body>

@yield('Scripts')

</html>
