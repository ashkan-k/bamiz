@extends('layouts.front-master')

@section('titlePage')
    درباره ما بامیز
@endsection

@section('content')
    <div>

        <section class="hero_in tours_detail start_bg_zoom" style="height: 650px !important;">
            <div class="wrapper"
                 style="background: url('{{ $settings['about_us_image'] }}'); width: 100% !important;   background-size: cover !important; background-repeat: no-repeat !important;">
                <div class="container">
                </div>
            </div>
        </section>

        <div class="bg_color_1">
            <div class="container margin_80_55">
                <div class="main_title_2">
                    <span><em></em></span>
                    <h2>با بامیز بیشتر آشنا شوید</h2>
                    <p>{{ $settings['about_us_title'] }}</p>
                </div>
                <div class="row justify-content-between">
                    <div class="col-lg-6 wow animated" data-wow-offset="150" style="visibility: visible;">
                        <figure class="block-reveal">
                            <div class="block-horizzontal"></div>
                            <img
                                src="{{ $settings['about_us_image'] }}"
                                class="img-fluid" alt="">
                        </figure>
                    </div>
                    <div class="col-lg-5">
                        <p>{!! $settings['about_us_text'] !!}</p>
                        <p><em>{{ $settings['default_site_admin'] }}</em></p>
                    </div>
                </div>
                <!--/row-->
            </div>
            <!--/container-->
        </div>


        <div class="container margin_80_55">
            <div class="main_title_2">
                <span><em></em></span>
                <h2>دوستان ما (کافه و رستوران و هتل ها)</h2>
                <p>کافه و رستوران و هتل هایی که افتخار همکاری باهاشون رو داریم</p>
            </div>
            <div id="carousel" class="owl-carousel owl-theme">
                @foreach($places as $c)
                    <div class="item">
                        <a href="{{ route('place_detail', $c->slug ?: '---') }}">
                            <div class="title">
                                <h4>{{ $c->name ?: '---' }}</h4>
                            </div>
                            <img src="{{ $c->cover['images']['original'] }}" alt="{{ $c->name }}">
                        </a>
                    </div>
                @endforeach
            </div>

        </div>
    </div>

@endsection
