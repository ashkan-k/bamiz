@extends('layouts.front-master')

@section('titlePage')
    رزرو میز کافه و رستوران و هتل با تورمجازی
@endsection

@section('content')
    <section class="header-video">
        <div id="hero_video">
            <div class="wrapper">
                <div class="container">
                    <h3>رزرو میز کافه رستوران با تورمجازی</h3>
                    <p>کافه یا رستوران خود را جهت مشاهده تورمجازی و رزرو آنلاین جستجو نمائید</p>

                    <form action="search" method="post">
                        <input type="hidden" name="_token" value="EAuoTn8ZIHl9omCeW2qpi1KLeC4TnXydUrFc5W1d">
                        <div class="row no-gutters custom-search-input-2">
                            <div class="col-lg-9">
                                <div class="form-group">
                                    <input class="form-control" type="text" name="title"
                                           placeholder="بخشی از نام مرکز میزبان و یا دسته بندی و یا شهر و یا استان آن را وارد نمائید">
                                    <i class="icon_search"></i>
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
        <img src="/front/img/video_fix.png" alt="" class="header-video--media" data-video-src="/front/video/intro"
             data-teaser-source="video/intro" data-provider="" data-video-width="1920" data-video-height="960">
    </section>
    <!-- /header-video -->

    <div class="container container-custom margin_80_0">
        <section class="add_bottom_45">
            <div class="row">

                @foreach($categories as $ca)

                    <div class="col-xl-3 col-lg-6 col-md-6 col-xs-12">
                        <a href="/mizbans/{{ $ca->slug }}" class="grid_item">
                            <figure>
                                <small style="background-color: #09b052e6;right: 0;color: white;width: 100px;padding: 5px">
                                    <h6 style="color: white"><i class="fa fa-map-marker"
                                                                aria-hidden="true"></i>&nbsp;{{ $ca->title }}</h6>
                                </small>
                                <img src="{{ $ca->get_image() }}" class="img-fluid"
                                     style="height:200px;width:400px">
                            </figure>
                        </a>
                    </div>

                @endforeach

            </div>

            <div class="main_title_2">
                <span><em></em></span>
                <h2>کافه رستوران های محبوب</h2>
                <p>کافه و رستوران هایی که بیشترین رزرو آنلاین را دارند</p>
            </div>
            <div id="reccomended" class="owl-carousel owl-theme">

            @php $options = []; @endphp
            @foreach($places as $place)

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

                                <a href="/centers/{{ $place->slug }}"><img src="{{ $place->cover['images']['900'] }}"
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
                            <div class="wrapper row">
                                <div class="">
                                    <img src="{{ $place->cover['images']['300'] }}" style="width: 50px; height: 50px">
                                </div>
                                <div class="text-center" style="padding: 10px ">
                                    <h3><a href="/centers/{{ $place->slug }}">{{ $place->name }}</a></h3>
                                    <span>{!! \Illuminate\Support\Str::limit($place->description, 50) !!}</span>
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
            <p class="btn_home_align" style="text-align: left !important;"><a href="/centers" class="btn_1 rounded">نمایش
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
                        <a href="/centers/{{ $place->slug }}" class="grid_item">
                            <figure>
                                <small
                                    style="background-color: #09b052e6;right: 0;color: white;width: 100px;padding: 5px">
                                    <h6 style="color: white"><i class="fa fa-map-marker"
                                                                aria-hidden="true"></i>&nbsp;{{ $place->province ? $place->province->name : '---' }}
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
            <p class="btn_home_align" style="text-align: left !important;"><a href="/centers" class="btn_1 rounded">نمایش
                    همه</a></p>
        </section>
        <!-- /section -->

        <!-- section -->
        <section class="add_bottom_45">
            <div class="main_title_3">
                <span><em></em></span>
                <h2>جدیدترین تصاویر</h2>
                <p>جدیدترین تصاویری ارسالی از طرف کاربران </p>
            </div>
            <div class="row">

                @foreach($latest_galleries as $lg)

                    <div class="col-xl-3 col-lg-6 col-md-6">
                        <a href="/galleries/{{ $lg->id }}" class="grid_item">
                            <figure>
                                <div class="score"><strong>5</strong></div>
                                <img src="{{ $lg->get_image() }}" class="img-fluid" alt="{{ $lg->place ? $lg->place->name : '---' }}"
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
            <p class="btn_home_align" style="text-align: left !important;"><a href="/galleries" class="btn_1 rounded">نمایش
                    همه</a></p>
        </section>
        <!-- /section -->

        <div class="banner mb-0">
            <div class="wrapper d-flex align-items-center opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.3)">
                <div>
                    <small>تورمجازی</small>
                    <h3>آشنایی با تورمجازی</h3>
                    <p>معرفی و نحوره استفاده از تورمجازی برای رزرو آنلای میز</p>
                    <a href="/Tor_Guide" class="btn_1">برای اطلاعات بیشتر کلیک کنید</a>
                </div>
            </div>
            <!-- /wrapper -->
        </div>

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
                            <a class="box_news" href="/blog/{{ $la->slug }}">
                                <figure><img src="{{ $la->get_image() }}" alt="{{ $la->title }}">

                                </figure>
                                <ul>
                                    <li>
                                        <i class="fa fa-calendar"></i>&nbsp; {{ \Carbon\Carbon::parse( $la->created_at )->diffForHumans() }}
                                    </li>
                                    <li><i class="fa fa-eye"></i>&nbsp;{{ $la->	view_count }}</li>
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

        <div class="call_section">
            <div class="container clearfix">
                <div class="col-lg-5 col-md-6 float-right wow" data-wow-offset="250">
                    <div class="block-reveal">
                        <div class="block-vertical"></div>
                        <div class="box_1">
                            <h3>همکاری با ما</h3>
                            <p> {{ $settings['workwithus'] }} </p>
                            <a href="/workwithus" class="btn_1 rounded">اطلاعات بیشتر</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
