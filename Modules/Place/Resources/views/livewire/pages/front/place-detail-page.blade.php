@section('Styles')
    <link rel="stylesheet" href="https://cdn.map.ir/web-sdk/1.4.2/css/mapp.min.css">
    <link rel="stylesheet" href="https://cdn.map.ir/web-sdk/1.4.2/css/fa/style.css">

    <style>
        #app {
            width: 100%;
            height: 100%;
        }
    </style>
@endsection

<div>
    <section class="hero_in tours_detail start_bg_zoom">
        <div class="wrapper">
            <div class="container">
                <h1 class="fadeInUp animated"><span></span>تور مجازی {{ $object->name ?: '---' }}</h1>
            </div>
        </div>
    </section>
    <div class="bg_color_1" style="transform: none;">

        <nav class="secondary_nav sticky_horizontal" style="">
            <div class="container">
                <ul class="clearfix">
                    <li><a href="#description" class="active">اطلاعات</a></li>
                    <li><a href="#comments">نظرات</a></li>
                    <li><a href="#sidebar">رزرو</a></li>
                </ul>
            </div>
        </nav>

        <div class="container margin_60_35" style="transform: none;">
            <div class="row" style="transform: none;">
                <div class="col-lg-8">
                    <section id="description">
                        <h2>توضیحات</h2>
                        <p>{!! $object->description ?: '---' !!}</p>
                        <hr>

                        {{--                        <h3>گالری تصاویر</h3>--}}
                        {{--                        <div id="instagram-feed" class="clearfix"></div>--}}

                        {{--                        <hr>--}}

                        <div class="row">
                            @foreach($object->options as $op)
                                <div class="col-lg-6">
                                    <ul class="bullets">
                                        <li>{{ $op->title }}</li>
                                    </ul>
                                </div>
                            @endforeach
                        </div>

                        <hr>

                        <h3>ساعات کاری</h3>
                        <p>ساعات کاری {{ $object->get_type() }} {{ $object->name ?: '---' }} به شرح ذیل می باشد</p>

                        <ul class="cbp_tmtimeline">

                            @foreach($work_days as $d)

                                <li>
                                    <time class="cbp_tmtime" datetime="09:30"><span>روز</span></time>
                                    <div class="cbp_tmicon">
                                        <small style="font-size: small">{{ $d }}</small>
                                    </div>
                                    <div class="cbp_tmlabel">
                                        <p>
                                            ساعت کاری از ساعت {{ $object->work_time->start_time }} صبح
                                            الی {{ $object->work_time->end_time }} شب
                                        </p>
                                    </div>
                                </li>

                            @endforeach

                        </ul>

                        <hr>
                        <h3>موقعیت جغرافیایی</h3>
                        <div id="map" class="map map_single add_bottom_30 olMap">
                            <div id="app"></div>
                        </div>
                        <!-- End Map -->
                    </section>
                    <!-- /section -->

                    <section id="comments">
                        <h2>نظرات کاربران</h2>
                        <div class="reviews-container mt-5">
                            <div class="row">
                                <h5>میانگین امتیاز</h5>
                                <div class="col-lg-12">
                                    <div id="review_summary">
                                        <strong>{{ $comments->avg('score') ?: '0' }}</strong>
                                        <em>از</em>
                                        <small>مجموع {{ $comments->count() }} رای اخذ شده</small>
                                    </div>
                                </div>
{{--                                <div class="col-lg-9">--}}
{{--                                    <div class="row">--}}
{{--                                        <div class="col-lg-10 col-9">--}}
{{--                                            <div class="progress">--}}
{{--                                                <div class="progress-bar" role="progressbar" style="width: 90%"--}}
{{--                                                     aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-lg-2 col-3"><small><strong>5 ستاره</strong></small></div>--}}
{{--                                    </div>--}}
{{--                                    <!-- /row -->--}}
{{--                                    <div class="row">--}}
{{--                                        <div class="col-lg-10 col-9">--}}
{{--                                            <div class="progress">--}}
{{--                                                <div class="progress-bar" role="progressbar" style="width: 95%"--}}
{{--                                                     aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-lg-2 col-3"><small><strong>4 ستاره</strong></small></div>--}}
{{--                                    </div>--}}
{{--                                    <!-- /row -->--}}
{{--                                    <div class="row">--}}
{{--                                        <div class="col-lg-10 col-9">--}}
{{--                                            <div class="progress">--}}
{{--                                                <div class="progress-bar" role="progressbar" style="width: 60%"--}}
{{--                                                     aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-lg-2 col-3"><small><strong>3 ستاره</strong></small></div>--}}
{{--                                    </div>--}}
{{--                                    <!-- /row -->--}}
{{--                                    <div class="row">--}}
{{--                                        <div class="col-lg-10 col-9">--}}
{{--                                            <div class="progress">--}}
{{--                                                <div class="progress-bar" role="progressbar" style="width: 20%"--}}
{{--                                                     aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-lg-2 col-3"><small><strong>2 ستاره</strong></small></div>--}}
{{--                                    </div>--}}
{{--                                    <!-- /row -->--}}
{{--                                    <div class="row">--}}
{{--                                        <div class="col-lg-10 col-9">--}}
{{--                                            <div class="progress">--}}
{{--                                                <div class="progress-bar" role="progressbar" style="width: 0"--}}
{{--                                                     aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-lg-2 col-3"><small><strong>1 ستاره</strong></small></div>--}}
{{--                                    </div>--}}
{{--                                    <!-- /row -->--}}
{{--                                </div>--}}
                            </div>
                            <!-- /row -->
                        </div>

                        <hr>

                        @if(!$comments->isEmpty())
                            @foreach($comments as $c)
                                <div class="reviews-container">
                                    <div class="review-box clearfix">
                                        <figure class="rev-thumb"><img
                                                src="{{ $c->user ? $c->user->get_avatar() : '---' }}"
                                                alt="{{ $c->user ? $c->user->fullname() : '---' }}">
                                        </figure>

                                        <div class="rev-content">
                                            <h5> {{ $c->title ?: '---' }} </h5>
                                            <div class="rating">
                                                <i class="icon_star voted"></i><i class="icon_star voted"></i><i
                                                    class="icon_star voted"></i><i class="icon_star voted"></i><i
                                                    class="icon_star"></i>
                                            </div>
                                            <div class="rev-info">
                                                {{ \Illuminate\Support\Carbon::parse($c->created_at)->diffForHumans() }}
                                                - {{ $c->user ? $c->user->fullname() : '---' }}
                                            </div>
                                            <div class="rev-text">
                                                <p>
                                                    {{ $c->body ?: '---' }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /review-box -->
                                </div>
                            @endforeach
                        @else
                            <h5>هنوز نظری وجود ندارد.</h5>
                    @endif
                    <!-- /review-container -->
                    </section>
                    <!-- /section -->
                    <hr>

                    <div class="add-review">
                        @if($errors->any() && ($errors->has('body') || $errors->has('title') || $errors->has('star')))

                            <div class="alert alert-danger text-center">

                                @foreach($errors->all() as $e)
                                    {{ $e }}<br>
                                @endforeach

                            </div>

                        @endif

                        <h5>ثبت نظر</h5>
                        @if(auth()->check())
                            <form wire:submit.prevent="SubmitNewComment()">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>عنوان *</label>
                                        <input wire:model.defer="title" required type="text" name="name_review"
                                               id="name_review" placeholder=""
                                               class="form-control">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>امتیاز (اختیاری)</label>
                                        <select class="form-control" wire:model.defer="star" name="rating_review"
                                                id="rating_review">
                                            <option value="" selected>امتیاز نمیدم</option>
                                            <option value="1">1 (ضعیف)</option>
                                            <option value="2">2</option>
                                            <option value="3">3 (متوسط)</option>
                                            <option value="4">4</option>
                                            <option value="5">5 (عالی</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label>نظر شما *</label>
                                        <textarea wire:model.defer="body" required name="body" id="review_text"
                                                  class="form-control"
                                                  style="height:130px;"></textarea>
                                    </div>

                                    @if(session()->has('comment_add'))
                                        <div class="mt-3 text-center text-success"
                                             style="font-size: 14px !important;">{{ session()->get('comment_add') }}</div>
                                    @endif

                                    <div class="form-group col-md-12 add_top_20">
                                        <input type="submit" value="ثبت نظر" class="btn_1" id="submit-review">
                                    </div>
                                </div>
                            </form>
                        @else
                            <div style="margin-top: 25px !important;" class="alert alert-danger text-center">برای ثبت نظر ابتدا
                                <a class="text-info" href="{{ route('login') }}"> وارد </a> شوید
                            </div>
                        @endif
                    </div>
                </div>
                <!-- /col -->

                <aside class="col-lg-4" id="sidebar"
                       style="position: relative; overflow: visible; box-sizing: border-box; min-height: 1610.6px;">

                    <div class="theiaStickySidebar"
                         style="padding-top: 0px; padding-bottom: 1px; position: fixed; transform: translateY(-51.4px); top: 0px; left: 204.6px; width: 350px;">

                        @if($errors->any() && !($errors->has('body') || $errors->has('title') || $errors->has('star')))

                            <div class="alert alert-danger text-center">

                                @foreach($errors->all() as $e)
                                    {{ $e }}<br>
                                @endforeach

                            </div>

                        @endif

                        {{--                        <form action="{{ route('reserve' , $object->slug) }}" method="post">--}}
                        <form action="" method="post">

                            @csrf

                            <div class="box_detail">
                                <div class="price">
                                    <span> {{ $price ?: '---' }} <small> تومان هزینه رزرو هر نفر</small></span>
                                    <div class="score"><strong>{{ $object->reserves->count() }} رزرو موفق</strong></div>
                                    <br>
                                    <div class="text-center" style="margin-top: 10px;color: red"><strong>هزینه رزرو از
                                            مبلغ
                                            فاکتور سفارش کسر می شود</strong></div>
                                </div>

                                <div class="form-group mt-2" wire:ignore>
                                    <small style="color: red">تعداد صندلی های هر میز
                                        : {{ $object->chairs_people_count }}</small>
                                    <input required class="form-control" type="text"
                                           name="guest_count" id="quest_count"
                                           placeholder="تعداد مهمانان">
                                </div>

                                <div class="form-group" wire:ignore>
                                    <input required class="form-control" type="text" name="date"
                                           id="id_date"
                                           placeholder="تاریخ رزرو">
                                </div>

                                <div class="form-group clearfix mt-2" wire:ignore>
                                    <select required class="form-control" id="chain_no" name="time">
                                        <option value="">ساعت رزرو</option>

                                        @foreach($times as $c)
                                            <option value="{{ $c }}"> ساعت {{ $c }} </option>
                                        @endforeach

                                    </select>
                                    @if(in_array($object->type, ['restaurant', 'cafe']))
                                        <p class="text-danger" style="margin-bottom: 0 !important;">مدت زمان حضور در محل
                                            دو
                                            ساعت می باشد.</p>
                                    @endif

                                    <select required class="form-control mt-3" id="chain_no" name="type">
                                        <option value="">مناسبت (موضوع رزرو)</option>
                                        @foreach($reserve_types as $res_type)
                                            <option @if(old('type')) @if(old('type') == $res_type['id'] ) selected
                                                    @endif @elseif(isset($item->type) && $item->type == $res_type['id']) selected
                                                    @endif value="{{ $res_type['id'] }}"
                                                    value="{{ $res_type['id'] }}">{{ $res_type['name'] }}
                                            </option>
                                        @endforeach
                                    </select>

                                    <div class="text-center text-danger"><b>سفارش تشریفات در صورت
                                            تمایل در
                                            مرحله بعد
                                            انجام می شود</b></div>

                                    @if(auth()->check())
                                        <button id="btn_check_reserve" type="submit" class="btn_1 full-width outline mt-5">
                                            <i
                                                class="icon-calendar-outlilne"></i> تکمیل رزرو
                                        </button>

                                        @if(!$is_Added_To_WishList)
                                            <button wire:click.prevent="AddToWishList()"
                                                    class="btn_1 full-width outline wishlist mt-3"><i
                                                    class="icon_heart"></i> اضافه به علاقه مندی ها
                                            </button>
                                        @else
                                            <button wire:click.prevent="DeleteFromWishList()"
                                                    class="btn_1 full-width outline wishlist mt-3"><i
                                                    class="icon_heart"></i> حذف از علاقه مندی ها
                                            </button>
                                        @endif
                                    @else
                                        <button onclick="window.location.href = '{{ route('login') }}?next=/{{ request()->path() }}'" id="btn_check_reserve" type="button" class="btn_1 full-width outline mt-5">
                                            <i
                                                class="icon-calendar-outlilne"></i> ورود به سایت برای رزرو
                                        </button>

                                        <hr>
                                        <span class="alert alert-danger">برای افزدون به علاقه مندی ها ابتدا <a
                                                class="text-info"
                                                href="{{ route('login') }}"> وارد </a> شوید</span>
                                    @endif

                                </div>
                        </form>
                        <div class="resize-sensor"
                             style="position: absolute; inset: 0px; overflow: hidden; z-index: -1; visibility: hidden;">
                            <div class="resize-sensor-expand"
                                 style="position: absolute; left: 0; top: 0; right: 0; bottom: 0; overflow: hidden; z-index: -1; visibility: hidden;">
                                <div
                                    style="position: absolute; left: 0px; top: 0px; transition: all 0s ease 0s; width: 360px; height: 536px;"></div>
                            </div>
                            <div class="resize-sensor-shrink"
                                 style="position: absolute; left: 0; top: 0; right: 0; bottom: 0; overflow: hidden; z-index: -1; visibility: hidden;">
                                <div
                                    style="position: absolute; left: 0; top: 0; transition: 0s; width: 200%; height: 200%"></div>
                            </div>
                        </div>
                    </div>
                </aside>


            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
</div>

@push('StackScript')
    <script type="text/javascript" src="https://cdn.map.ir/web-sdk/1.4.2/js/mapp.env.js"></script>
    <script type="text/javascript" src="https://cdn.map.ir/web-sdk/1.4.2/js/mapp.min.js"></script>

    <script>

        @if(isset($object->address_lat) && isset($object->address_long))
            $(document).ready(function () {
            var app = new Mapp({
                element: '#app',
                presets: {
                    latlng: {
                        lat: '{{ $object->address_lat }}',
                        lng: '{{ $object->address_long }}',
                    },
                    zoom: 16
                },
                apiKey: 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjhiN2EwNjYwODY2YTMxZDAyNTA5NmZiYmIzZGVhZDQ4NDg4Y2VjYjQ0YTM5NTQxNzE3OTk4YjVjMTI1MGZjMDUxYjIxYmFmNDJkYjA2ZDMyIn0.eyJhdWQiOiIyMTQ5MSIsImp0aSI6IjhiN2EwNjYwODY2YTMxZDAyNTA5NmZiYmIzZGVhZDQ4NDg4Y2VjYjQ0YTM5NTQxNzE3OTk4YjVjMTI1MGZjMDUxYjIxYmFmNDJkYjA2ZDMyIiwiaWF0IjoxNjc4NzQ5OTY0LCJuYmYiOjE2Nzg3NDk5NjQsImV4cCI6MTY4MTE2OTE2NCwic3ViIjoiIiwic2NvcGVzIjpbImJhc2ljIl19.AobDdWKizuV0DAL8IFyUb8jLBrx8AzVu21HEOxAUTD8WhMZ-riaPX53e6_A7oj1NbwCBpTc8Jm3w2QAsYsTae2lCDoZB05X2pEcjoAYXpzRV2z-tBLgwairxtJunrKDSjKTIg9LpGzFu93xBQGmUnOfOho-Se4s_vIdUlrl19tdEPaKO763sHFQPnqf4Fbwh-L_ARuKaUV8j8aseg9n-vGbQ4w5juRbtMeNMm9adtt1ZVGWGUOJAHUD83IM4-FCiA7-P3Xincar-BXTY0PN1EK9Yvhn7akGQRudPYBsnU5NGe8ABmAFfXzdMwbSWnx1YO8fSfTmiQc2tHAqf1JmiIg'
            });
            app.addLayers();
            app.addFullscreen();
            // app.markReverseGeocode({
            app.showReverseGeocode({
                state: {
                    latlng: {
                        lat: '{{ $object->address_lat }}',
                        lng: '{{ $object->address_long }}',
                    },
                    zoom: 16,
                },
            });
        });
        @endif

    </script>

    <script>
        kamaDatepicker('id_date', {
            placeholder: 'تاریخ رزرو',
            buttonsColor: 'blue',
            markHolidays: true
        });
        $("#id_date").attr('autocomplete', 'off');

        $('#id_date').on('change', function () {
            $('#id_date').val($('#id_date').val().replaceAll('/', '-'))
        });
    </script>
@endpush

@push('CSS')

@endpush
