@extends('layouts.front-master')

@section('titlePage')
    رزرو میز کافه و رستوران و هتل با تورمجازی
@endsection

@section('content')
    <section class="header-video">
        <div id="hero_video">
            <div class="wrapper">
                <div class="container">
                    <h3>{{ $settings['banner_title'] }}</h3>
                    <p>{{ $settings['banner_description'] }}</p>

                    <form action="{{ route('places') }}">
                        <div class="row no-gutters custom-search-input-2 custom_search_box">
                            <div class="col-lg-9">
                                <div class="form-group">
                                    <input class="form-control" type="text" name="search"
                                           placeholder="بخشی از نام مرکز میزبان و... را وارد نمائید">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <input type="submit" class="btn_search" value="جستجو">
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <img src="{{ $settings['banner_image'] }}" alt="" class="header-video--media" data-video-src="video/adventure"
             data-teaser-source="video/adventure" data-provider="" data-video-width="1920" data-video-height="960"
             style="display: none;">

        <video autoplay="true" loop="loop" muted="" id="teaser-video" class="teaser-video">
            <source src="{{ $settings['banner_video_mp4'] }}" type="video/mp4">
            <source src="{{ $settings['banner_video_ogv'] }}" type="video/ogg">
        </video>
    </section>
    <!-- /header-video -->

    <div class="container container-custom margin_80_0">
        <section class="add_bottom_45">
            <div class="row">

                @foreach($categories as $ca)

                    <div class="col-xl-3 col-lg-6 col-md-6 col-xs-12">
                        <a href="{{ route('categories', $ca->slug) }}" class="grid_item">
                            <figure>
                                <small
                                    style="background-color: #09b052e6;right: 0;color: white;width: 150px; padding-left: 0px !important;">
                                    <h6 style="color: white"><i style="font-family: FontAwesome !important;"
                                                                class="fa fa-coffee"
                                                                aria-hidden="true"></i>&nbsp;{{ $ca->title }}</h6>
                                </small>
                                <img src="{{ $ca->get_image() }}" class="img-fluid"
                                     style="height:200px;width:400px">
                            </figure>
                        </a>
                    </div>

                @endforeach

            </div>

            <div class="banner mt-5" style='background: url({{ $settings['advertise_banner_image'] }}) center center no-repeat !important;'>
                <div class="wrapper d-flex align-items-center opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.3)">
                    <div>
                        <h3>{{ $settings['advertise_banner_title'] }}</h3>
                        <p>{{ $settings['advertise_banner_text'] }}</p>
                        <a href="{{ $settings['advertise_banner_link'] }}" class="btn_1">برای اطلاعات بیشتر کلیک کنید</a>
                    </div>
                </div>
                <!-- /wrapper -->
            </div>

            <div class="main_title_2 mt-5">
                <span><em></em></span>
                <h2>کافه رستوران های محبوب</h2>
                <p>کافه و رستوران هایی که بیشترین رزرو آنلاین را دارند</p>
            </div>
            <div id="reccomended" class="owl-carousel owl-theme">

            @php $options = []; @endphp
            @foreach($popular_places as $place)

                @php
                    foreach ($place->options as $o)
                     {
                            $options[] = $o['title'];
                     }
                @endphp

                <!-- item -->
                    <div class="item">
                        <div class="box_grid" style="border-radius: 10px">
                            <figure>

                                <a href="{{ route('place_detail', $place->slug) }}"><img
                                        src="{{ $place->cover['images']['900'] }}"
                                        class="img-fluid"
                                        alt="{{ $place->name }}"
                                        width="800" height="533">
                                    <div class="read_more"><span>مشاهده</span></div>
                                </a>

                                <small style="background-color: #09b052e6;right: 0;color: white;font-size: medium;">
                                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                                    {{ $place->province ? $place->province->title : '---' }}
                                </small>
                            </figure>
                            <div class="wrapper row" style="height: 175px !important;">
                                <div class="">
                                    <img src="{{ $place->cover['images']['300'] }}" style="width: 50px; height: 50px">
                                </div>
                                <div class="text-center" style="padding: 10px ">
                                    <h3>
                                        <a href="{{ route('place_detail', $place->slug) }}">{{ \Illuminate\Support\Str::limit($place->name, 30) }}</a>
                                    </h3>
                                    <span>{!! \Illuminate\Support\Str::limit($place->description, 30) !!}</span>
                                </div>
                            </div>
                            <ul>
                                <li>
                                    <i class="fa fa-wifi" title="اینترنت رایگان"

                                       @if(in_array('اینترنت رایگان' , $options))
                                       style="color: green; font-family: FontAwesome !important;"
                                        @endif

                                    ></i>
                                </li>
                                <li>
                                    <i class="fa fa-music" title="موسیقی زنده"

                                       @if(in_array('موسیقی زنده' , $options))
                                       style="color: green; font-family: FontAwesome !important;"
                                        @endif

                                    ></i>
                                </li>
                                <li>
                                    <i class="fa fa-tree" title="فضای سبز"

                                       @if(in_array('فضای سبز' , $options))
                                       style="color: green; font-family: FontAwesome !important;"
                                        @endif

                                    ></i>
                                </li>
                                <li>
                                    <i class="fa fa-star" title="فضای vip"

                                       @if(in_array('فضای vip' , $options))
                                       style="color: green; font-family: FontAwesome !important;"
                                        @endif

                                    ></i>
                                </li>
                                <li>
                                    <i class="fa fa-child" title="فضای بازی"

                                       @if(in_array('فضای بازی' , $options))
                                       style="color: green; font-family: FontAwesome !important;"
                                        @endif

                                    ></i>
                                </li>


                                <li class="text-left" title="بازدید">
                                    <i class="fa fa-eye"></i>

                                    {{ $place->viewCount }} بازدید

                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- /item -->

                @endforeach

            </div>
            <!-- /carousel -->
            <p class="btn_home_align" style="text-align: left !important;"><a href="{{ route('places') }}"
                                                                              class="btn_1 rounded">نمایش
                    همه</a></p>
            <hr class="large">
        </section>
    </div>
    <div class="container container-custom margin_30_95">
        <section class="add_bottom_45">
            <div class="main_title_3">
                <span><em></em></span>
                <h2>جدیدترین ها</h2>
                <p>کافه رستوران هایی که جدیداً امکان رزور آنلاین میز را فراهم نموده اند</p>
            </div>
            <div class="row">

                @foreach($latest_places as $place)

                    <div class="col-xl-3 col-lg-6 col-md-6">
                        <a href="{{ route('place_detail', $place->slug) }}" class="grid_item">
                            <figure>
                                <small
                                    style="background-color: #09b052e6;right: 0;color: white;width: 100px;padding: 5px">
                                    <h6 style="color: white"><i class="fa fa-map-marker"
                                                                aria-hidden="true"></i>&nbsp;{{ $place->province ? $place->province->title : '---' }}
                                    </h6>
                                </small>
                                <img src="{{ $place->cover['images']['original'] }}" class="img-fluid"
                                     style="height:200px;width:400px" alt="{{ $place->name }}">
                                <div class="info">
                                    <h3>{{ $place->name }}</h3>
                                </div>
                            </figure>
                        </a>
                    </div>

            @endforeach

            <!-- /grid_item -->
            </div>
            <!-- /row -->
            <p class="btn_home_align" style="text-align: left !important;"><a href="{{ route('places') }}"
                                                                              class="btn_1 rounded">نمایش
                    همه</a></p>
        </section>
        <!-- /section -->

        <!-- section -->
        <section class="add_bottom_45">
            <div class="main_title_3">
                <span><em></em></span>
                <h2>جدیدترین تصاویر</h2>
                <p>جدیدترین تصاویر رستوران، کافه و هتل های بامیز </p>
            </div>
            <div class="row">

                @foreach($latest_galleries as $lg)

                    <div class="col-xl-3 col-lg-6 col-md-6">
                        <a href="{{ $lg->get_image() }}" class="grid_item">
                            <figure>
                                <div class="score"><strong>5</strong></div>
                                <img src="{{ $lg->get_image() }}" class="img-fluid"
                                     alt="{{ $lg->place ? $lg->place->name : '---' }}"
                                     style="height:200px;width:400px">
                                <div class="info">
                                    <h3> مرکز {{ $lg->place ? $lg->place->name : '---' }} </h3>
                                </div>
                            </figure>
                        </a>
                    </div>

                @endforeach

            </div>
            <!-- /row -->
            <p class="btn_home_align" style="text-align: left !important;"><a href="{{ route('galleries') }}"
                                                                              class="btn_1 rounded">نمایش
                    همه</a></p>
        </section>
        <!-- /section -->

        {{--        <div class="banner mb-0">--}}
        {{--            <div class="wrapper d-flex align-items-center opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.3)">--}}
        {{--                <div>--}}
        {{--                    <small>تورمجازی</small>--}}
        {{--                    <h3>آشنایی با تورمجازی</h3>--}}
        {{--                    <p>معرفی و نحوره استفاده از تورمجازی برای رزرو آنلای میز</p>--}}
        {{--                    <a href="/Tor_Guide" class="btn_1">برای اطلاعات بیشتر کلیک کنید</a>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--            <!-- /wrapper -->--}}
        {{--        </div>--}}

        <div class="bg_color_1">
            <div class="container margin_80_55">
                <div class="main_title_2">
                    <span><em></em></span>
                    <h3>اخبار و مطالب</h3>
                    <p>اخبار و مطالب سامانه رزرو آنلاین میز کافه و رستوران ها</p>
                </div>
                <div class="row">

                    @foreach($latest_articles as $la)

                        <div class="col-lg-6">
                            <a class="box_news" href="{{ route('article_detail', $la->slug) }}">
                                <figure><img src="{{ $la->get_image() }}" alt="{{ $la->title }}">

                                </figure>
                                <ul>
                                    <li>
                                        <i style="font-family: FontAwesome !important;" class="fa fa-calendar"></i>&nbsp; {{ \Carbon\Carbon::parse( $la->created_at )->diffForHumans() }}
                                    </li>
                                    <li><i style="font-family: FontAwesome !important;"
                                           class="fa fa-eye"></i>&nbsp;{{ $la->	view_count }}</li>
                                </ul>
                                <h4>{{ $la->title }}</h4>
                                <p>
                                    {!! \Illuminate\Support\Str::limit($la->text, 50) !!}
                                </p>
                            </a>
                        </div>

                    @endforeach

                </div>
                <!-- /row -->
                <p class="btn_home_align" style="text-align: left !important;"><a href="/blogs" class="btn_1 rounded">نمایش
                        همه</a></p>
            </div>
            <!-- /container -->
        </div>

        <div class="call_section" style='background: url({{ $settings['work_with_us_image'] }}) center center no-repeat !important;'>
            <div class="container clearfix">
                <div class="col-lg-5 col-md-6 float-right wow" data-wow-offset="250">
                    <div class="block-reveal">
                        <div class="block-vertical"></div>
                        <div class="box_1">
                            <h3>همکاری با ما</h3>
                            <p> {{ $settings['work_with_us_text'] }} </p>
                            <a href="{{ route('cooperation') }}" class="btn_1 rounded">اطلاعات بیشتر</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
