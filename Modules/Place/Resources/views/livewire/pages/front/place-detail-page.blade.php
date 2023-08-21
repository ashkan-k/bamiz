@section('Styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
          integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"
          integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>

    <link rel="stylesheet" href="https://cdn.map.ir/web-sdk/1.4.2/css/mapp.min.css">
    <link rel="stylesheet" href="https://cdn.map.ir/web-sdk/1.4.2/css/fa/style.css">

    <style>
        #app {
            width: 100%;
            height: 100%;
        }
    </style>

    <style>
        #sign-in {
            width: 170px !important;
            right: inherit;
            left: 25px;
            position: fixed;
            right: 25px;
            bottom: 25px;
            z-index: 9999;

        &
        :after {
            position: relative;
            display: block;
            top: 50%;
            -webkit-transform: translateY(-55%);
            transform: translateY(-55%);
        }

        }

        #owl-demo .item {
            margin: 3px;
        }

        #owl-demo .item img {
            display: block;
            width: 100%;
            height: 210px !important;
        }
    </style>

    <style>
        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #fc5b62;
            color: #fff !important;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            margin-right: 10px;
        }

        .button img {
            vertical-align: middle;
            margin-right: 5px;
        }
    </style>
@endsection

<div>
    <section class="header-video">
        <div id="hero_video"
             style="background: url('{{ $object->get_banner() }}'); width: 100% !important;   background-size: cover !important; background-repeat: no-repeat !important;">
            <div class="wrapper">
                <div class="container">

                    <h3 class="fadeInUp animated"><span></span>تور مجازی {{ $object->name ?: '---' }}</h3>

                    <div class="row text-center no-gutters mt-5">
                        <div class="col-lg-12">
                            <input onclick="window.location.href = '{{ $object->tour_link }}'"
                                   style="font-size: 22px !important; ;width: 350px !important;" role="button"
                                   type="submit" class="btn_search btn_1 rounded" value="تور مجازی">
                        </div>
                    </div>

                    {{--                    <p class="btn_home_align" style="text-align: center !important;">--}}
                    {{--                        <a style="display: none !important;" href="#sign-in-dialog" id="dsadsa" class="btn_1 rounded">ثبت سفارش</a>--}}
                    {{--                    </p>--}}

                </div>
            </div>
        </div>
        <img src="{{ $object->cover['images']['original'] }}" alt="" class="header-video--media"
             data-video-src="video/adventure"
             data-teaser-source="video/adventure" data-provider="" data-video-width="1920" data-video-height="960"
             style="display: none;">

        <video autoplay="true" loop="loop" muted="" id="teaser-video" class="teaser-video">
            <source src="{{ $object->tour_gif }}" type="video/mp4">
            {{--            <source src="{{ $settings['banner_video_ogv'] }}" type="video/ogg">--}}
        </video>
    </section>

    {{--    <section class="hero_in tours_detail start_bg_zoom" style='background: url("{{ $object->tour_gif }}") center center no-repeat !important;'>--}}
    {{--        <div class="wrapper">--}}
    {{--            <div class="container">--}}
    {{--                <h1 class="fadeInUp animated"><span></span>تور مجازی {{ $object->name ?: '---' }}</h1>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </section>--}}

    <div class="bg_color_1" style="transform: none;">

        <nav class="secondary_nav sticky_horizontal" style="">
            <div class="container">
                <ul class="clearfix">
                    <li><a href="#description" class="active">اطلاعات</a></li>
                    @if($object->type != 'hotel')
                        <li><a href="#menu_image">منوی غذا</a></li>
                    @endif
                    <li><a href="#galley">گالری تصاویر</a></li>
                    <li><a href="#map">موقعیت</a></li>
                    <li><a href="#comments">نظرات</a></li>
                    @if(count($work_days))
                        <li><a href="#worktime">ساعت کاری</a></li>
                    @endif
                    {{--                    <li><a href="#sidebar">رزرو</a></li>--}}
                </ul>


                {{--                <button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>--}}

            </div>
        </nav>

        <div class="container margin_60_35" style="transform: none;">
            <div class="row" style="transform: none;">
                <div class="col-lg-12">
                    <section id="description" style="word-wrap: break-word !important;">
                        <h2>توضیحات</h2>
                        <p>{!! $object->description ?: '---' !!}</p>
                        <hr>

                        @if($object->type != 'hotel')
                            <h3>منوی غذا</h3>
                            <div id="instagram-feed" class="clearfix"></div>
                            <div class="mt-3 mb-5" id="menu_image"
                                 style="width: 300px !important; height: 169px !important; !important; ;border-radius: 20px;box-shadow: 5px 10px 18px rgba(32,32,32,0.55);">
                                <label class="control-label">
                                    <a href="{{ $object->get_menu_image('original') }}" target="_blank"><img
                                            style="border-radius: 20px; margin-bottom: 8px; width: 300px!important; height: 169px !important;"
                                            src="{{ $object->get_menu_image(300) }}"></a>
                                </label>
                            </div>
                            {{--                        <img src="{{ $object->get_menu_image(300) }}" style="width: 200px !important; height: 200% !important;" alt="{{ $object->name }}">--}}
                            <hr>
                        @endif


                        <h3 id="galley">گالری تصاویر</h3>
                        <div class="clearfix"></div>

                        <div dir="ltr">
                            <div id="owl-demo" class="owl-carousel owl-theme">

                                @foreach($object->images()->get() as $image)
                                    <div class="item">
                                        <a href="{{ $image->get_image() }}" target="_blank"><img
                                                src="{{ $image->get_image() }}" alt="{{ $object->name }}"></a>
                                    </div>
                                @endforeach

                            </div>
                        </div>

                        <hr>

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
                        <h3 id="map">موقعیت جغرافیایی</h3>
                        <div class="map map_single add_bottom_30 olMap" wire:ignore>
                            <a class="button mb-3 mt-2 map_router_button" onclick="openMap('google_map')">
                                مسیریابی موقعیت<img src="/location.png" class="ml-3" alt="Google Maps Logo" width="24"
                                                    height="24">
                            </a>
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
                            <div style="margin-top: 25px !important;" class="alert alert-danger text-center">برای ثبت
                                نظر ابتدا
                                <a class="text-info" href="{{ route('login') }}"> وارد </a> شوید
                            </div>
                        @endif
                    </div>

                    @if(count($work_days))
                        <hr>

                        <h3 id="worktime">ساعات کاری</h3>
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
                    @endif
                </div>
                <!-- /col -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
</div>

<!-- Sign In Popup -->
<div id="sign-in-dialog" class="zoom-anim-dialog mfp-hide">
    <div class="small-dialog-header">
        <h3>ثبت سفارش</h3>
    </div>

    <div class="form-group mb-5">
        <div class="score pull-left "><strong>{{ $object->reserves()->where('status', 1)->count() }}
                رزرو موفق</strong></div>
    </div>


    <form ng-submit="SubmitReserveForm()" id="id_reserve_form" name="reserve_form" method="post">

        @csrf

        @auth
            <input type="hidden" name="place_type" value="{{ $object->type }}">
            <input type="hidden" name="place_id" value="{{ $object->id }}">
            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
        @endauth

        <div class="sign-in-wrapper" ng-show="form == 1">

            <div class="form-group">

                <label>تعداد مهمانان</label>
                <input required class="form-control" type="text"
                       value="{{ old('guest_count') }}"
                       name="guest_count" id="quest_count"
                       placeholder="تعداد مهمانان">
                {{--                @if(in_array($object->type, ['restaurant', 'cafe']))--}}
                {{--                    <p class="text-danger" style="margin-bottom: 0 !important;">--}}
                {{--                        تعداد صندلی های هر میز--}}
                {{--                        : {{ $object->chairs_people_count }}--}}
                {{--                    </p>--}}
                {{--                @endif--}}

                @if(in_array($object->type, ['restaurant', 'cafe']))
                    <p class="text-danger" style="margin-bottom: 0 !important;">
                        مدت زمان حضور در محل دو ساعت می باشد. در صورت حضور بیش از ۲ ساعت با مدیریت کافه رستوران هماهنگ
                        شود.
                        <br>
                        @if($object->extra_person_fee)
                            هزینه هر نفر اضافه {{ number_format($object->extra_person_fee) }} تومان می باشد و در محل هتل حساب میشود.
                        @endif
                    </p>
                @endif

                @error('guest_count')
                <span class="text-danger text-wrap">{{ $message }}</span>
                @enderror
            </div>

            @if($object->type == 'hotel')
                <div class="form-group">

                    <label>تعداد خردسالان @if($object->type == 'hotel' && $object->minor_max_age)<small
                            style="color: red">(کمتر از {{ $object->minor_max_age }} سال)</small>@endif</label>
                    <input class="form-control" type="text"
                           value="{{ old('children_guest_count') }}"
                           name="children_guest_count" id="quest_count"
                           placeholder="تعداد خردسالان">

                    <p class="text-danger" style="margin-bottom: 0 !important;">
                        @if($object->type == 'hotel' && $object->minor_max_age)
                            نفر اضافه یا فرزند بالای {{ $object->minor_max_age }} سال در محل هتل حساب میشود.
                        @endif

                        @if($object->extra_person_fee)
                            هزینه هر نفر اضافه {{ number_format($object->extra_person_fee) }} تومان
                        @endif
                    </p>

                    @error('children_guest_count')
                    <span class="text-danger text-wrap">{{ $message }}</span>
                    @enderror
                </div>
            @endif

            <div class="form-group">
                <label>تاریخ رزرو</label>
                <input required class="form-control" type="text" name="date"
                       id="id_date" value="{{ old('date') }}"
                       placeholder="تاریخ رزرو">

                @if($object->type == 'hotel')
                    <span class="text-danger text-wrap">تاریخ انتخابی می تواند تا یک ماه آینده باشد.</span>
                @else
                    <span class="text-danger text-wrap">تاریخ انتخابی می تواند تا یک هفته آینده باشد.</span>
                @endif

                {{--                @error('date')--}}
                {{--                <span class="text-danger text-wrap">{{ $message }}</span>--}}
                {{--                @enderror--}}
            </div>

            @if($object->type == 'hotel')
                <div class="form-group mt-2">
                    <label>تعداد روز</label>
                    <input required class="form-control" type="text"
                           value="{{ old('days_number') }}"
                           name="days_number" id="quest_count"
                           placeholder="تعداد روز">

                    @error('days_number')
                    <span class="text-danger text-wrap">{{ $message }}</span>
                    @enderror
                </div>
            @endif

            @if($object->type != 'hotel')
                <div class="form-group" style="margin-bottom: 0 !important;">
                    <label>ساعت رزرو</label>
                    <select required class="form-control" id="chain_no" name="start_time">
                        <option value="">ساعت رزرو را انتخاب کنید</option>

                        @foreach($times as $c)
                            <option @if(old('start_time') == $c) selected @endif value="{{ $c }}">
                                ساعت {{ $c }} </option>
                        @endforeach

                    </select>

                    @error('start_time')
                    <span class="text-danger text-wrap">{{ $message }}</span>
                    @enderror
                </div>
            @endif

            <div class="form-group mt-2">
                <label>توضیحات</label>
                <textarea name="user_description" class="form-control"
                          rows="3">{{ old('user_description') }}</textarea>

                @error('user_description')
                <span class="text-danger text-wrap">{{ $message }}</span>
                @enderror
            </div>

            @if($object->type == 'hotel')
                <div class="text-center text-danger mt-2 mb-2"><b>انتخاب اتاق مد نظر در
                        مرحله بعد
                        انجام می شود</b></div>
            @else
                <div class="text-center text-danger mt-2 mb-2"><b>سفارش تشریفات در صورت
                        تمایل در
                        مرحله بعد
                        انجام می شود</b></div>
            @endif

            <div class="text-center">
                <input type="submit" id="id_submit_button_1" ng-disabled="is_submit" value="مرحله بعد"
                       ng-show="!is_submited"
                       class="btn_1 full-width">
                <input type="button" disabled id="aaaaa" ng-disabled="is_submit" value="مرحله بعد"
                       ng-show="is_submited" style="cursor: not-allowed !important;"
                       class="btn_1 full-width disabled">
            </div>
        </div>


        @if($object->type == 'hotel')
            <div class="sign-in-wrapper" ng-show="form == 3">

                <div class="text-center mt-2 mb-2"><b>انتخاب اتاق</b></div>
                <hr>

                <div id="id_hotel_room_id_required_error" style="display: none"
                     class="text-center text-danger mt-2 mb-2"><b>فیلد اتاق الزامی است. لطفا اتاق مد نظر خود را انتخاب
                        کنید.</b></div>

                <div class="row">
                    @foreach($object->hotel_rooms as $room)
                        <div class="form-group col-12">
                            <label for="id_hotel_room_id_{{ $room->id }}">{{ $room->title }}</label>
                            <input id="id_hotel_room_id_{{ $room->id }}" type="radio" name="hotel_room_id"
                                   value="{{ $room->id }}">

                            @if($room->description)
                                <p style="margin-bottom: 0px !important;">{!! $room->description ?: '---' !!}</p>
                            @endif

                            <p class="pull-left">{{ number_format($room->price) ?: '---' }} تومان</p>

                            @if($room->image)
                                <a href="{{ $room->get_image() }}" target="_blank"><img class="pull-left mb-3"
                                                                                        style="clear: both !important;"
                                                                                        src="{{ $room->get_image() }}"
                                                                                        width="50"
                                                                                        alt="{{ $room->title }}"></a>
                            @endif
                            <hr style="clear: both !important;margin-top: 1rem;margin-bottom: 1rem;border: 0;border-top: 3px solid rgba(0, 0, 0, 0.1);"/>
                        </div>


                    @endforeach
                </div>

                <div class="text-center text-danger mt-2 mb-2"><b>لطفا اتاق مد نظر خودتان را از لیست بالا انتخاب
                        کنید.</b></div>

                <div class="text-center">
                    <input type="submit" id="id_submit_button_2" ng-disabled="is_submit" value="تکمیل رزرو"
                           class="btn_1 full-width">

                    <input ng-click="form = 1" type="button" ng-disabled="is_submit" value="بازکشت"
                           class="btn_1 full-width">
                </div>
            </div>
        @else
            <div class="sign-in-wrapper" ng-show="form == 2">

                <div class="form-group" style="margin-top: 1rem !important;">
                    <label>مناسبت (موضوع رزرو)</label>
                    <select ng-model="reserve_type_id" ng-change="GetReserveTypeTables()" ng-required="form == 2"
                            class="form-control" id="id_reserve_type" name="reserve_type_id">
                        <option value="" data-has-price="null">مناسبت (موضوع رزرو) را انتخاب کنید
                        </option>

                        @foreach($reserve_types as $res_type)
                            <option data-has-price="{{ $res_type->price }}"
                                    @if(old('reserve_type_id') == $res_type->id) selected
                                    @endif value="{{ $res_type->id }}">{{ $res_type->title }}
                                {{--                                @if($res_type->price)({{ $res_type->price }} تومان)@endif--}}
                            </option>
                        @endforeach
                    </select>

                    @error('reserve_type_id')
                    <span class="text-danger text-wrap">{{ $message }}</span>
                    @enderror
                </div>

                <div ng-if="tables.length > 0 && has_reserve_type_options" class="form-group">
                    <label>شماره میز مد نظر</label>

                    <select required class="form-control"
                            id="id_table_id" name="table_id">
                        <option value="">شماره میز مد نظر را انتخاب کنید</option>

                        <option ng-repeat="item in tables"
                                ng-selected="item.id == {{ old('table_id', '-1') }}"
                                value="[[ item.id ]]">[[ item.title ]] ([[ GetPriceAsNumberHumanize(item.price) ]]
                            تومان)
                        </option>
                    </select>

                    <p class="text-danger" style="margin-bottom: 0 !important;">برای مشاهده میز و سالن به تور مجازی مراجعه کنید.</p>

                    @error('table_id')
                    <span class="text-danger text-wrap">{{ $message }}</span>
                    @enderror
                </div>

                <div class="text-center text-danger mt-2 mb-2"><b>سفارش تشریفات در صورت
                        تمایل در
                        مرحله بعد
                        انجام می شود</b></div>

                <div class="text-center">
                    <input type="submit" id="id_submit_button_1" ng-disabled="is_submit" value="مرحله بعد"
                           ng-show="!is_submited"
                           class="btn_1 full-width">
                    <input type="button" disabled id="aaaaa" ng-disabled="is_submit" value="مرحله بعد"
                           ng-show="is_submited" style="cursor: not-allowed !important;"
                           class="btn_1 full-width disabled">

                    <input ng-click="form = 1" type="button" ng-disabled="is_submit" value="بازکشت"
                           class="btn_1 full-width">
                </div>
            </div>

            <div class="sign-in-wrapper" ng-show="form == 3">

                <div class="text-center mt-2 mb-2"><b>تشریفات</b></div>
                <hr>

                @forelse($object->options as $op)
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="id_option_{{ $op->id }}">{{ $op->title }}</label>
                            <input id="id_option_{{ $op->id }}" type="checkbox" name="option_id[]"
                                   value="{{ $op->id }}">

                            @if($op->discount_amount)
                                <p class="pull-left">
                                    <del>{{ number_format($op->amount) ?: '---' }}</del>
                                    تومان
                                    <br>
                                    {{ number_format($op->discount_amount) ?: '---' }} تومان
                                </p>
                            @else
                                <p class="pull-left">{{ number_format($op->amount) ?: '---' }} تومان</p>
                            @endif

                            @if($op->image)
                                <a href="{{ $op->get_image() }}" target="_blank"><img class="pull-left mb-3"
                                                                                      style="clear: both !important;"
                                                                                      src="{{ $op->get_image() }}"
                                                                                      width="50"
                                                                                      alt="{{ $op->title }}"></a>
                            @endif
                            <hr style="clear: both !important;margin-top: 1rem;margin-bottom: 1rem;border: 0;border-top: 3px solid rgba(0, 0, 0, 0.1);"/>
                        </div>
                    </div>
                @empty
                    <div class="text-center mt-2 mb-5"><b><h5>تشریفاتی موجود نیست.</h5></b></div>
                @endforelse

                <div class="text-center text-danger mt-2 mb-2"><b>تشریفات مورد نظر خود را در صورت نیاز انتخاب کنید.
                        (اختیاری)</b></div>

                <div class="text-center">
                    <input type="submit" id="id_submit_button_2" ng-disabled="is_submit" value="تکمیل رزرو"
                           class="btn_1 full-width">

                    <input ng-click="@if($object->type == 'hotel') form = 1 @else form = 2 @endif" type="button"
                           ng-disabled="is_submit" value="بازکشت"
                           class="btn_1 full-width">
                </div>
            </div>
        @endif


    </form>
    <!--form -->
</div>
<!-- /Sign In Popup -->

@section('MapScripts')
    <script type="text/javascript" src="https://cdn.map.ir/web-sdk/1.4.2/js/mapp.env.js"></script>
    <script type="text/javascript" src="https://cdn.map.ir/web-sdk/1.4.2/js/mapp.min.js"></script>

    <script wire:ignore>

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
                apiKey: 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjkxODM2YTc4YjQ1MWY1ODk5NmE1NTM2MmNiYmFjZmFiZGRmYTY5MzQzN2YxNDUzOTNmN2Q2MWE1MjI3ZmViNTRmYmI2OTM4ZmM5YWMyYTkyIn0.eyJhdWQiOiIyMjk0MSIsImp0aSI6IjkxODM2YTc4YjQ1MWY1ODk5NmE1NTM2MmNiYmFjZmFiZGRmYTY5MzQzN2YxNDUzOTNmN2Q2MWE1MjI3ZmViNTRmYmI2OTM4ZmM5YWMyYTkyIiwiaWF0IjoxNjg4MTQ1NzA4LCJuYmYiOjE2ODgxNDU3MDgsImV4cCI6MTY5MDczNzcwOCwic3ViIjoiIiwic2NvcGVzIjpbImJhc2ljIl19.lA2hR9BeYbGBvk0APHQR2goL78g40sNGIuRICJumxLY2J33UQzamiHQaAk_DJNYaHLZjfDqG8toL3sg7ayWaeOlmkB-WnqS2iAaepdAwG_JX98-ciY6kn8amIwpUGHD8q7DYMfZvTZojjIGXOKTjjQhJDVwl53G86vJEpelC4_Zy-Lobydel2IDvW39MPifL3tkNIMnA-cwAlXz83HyGTMDYN987cqI7FXtaFsgo6Qf6KjDNERKE3br67sTifkZTPagM30CUQZebLTWDK1aDWuBa2L3HvnC_ux4V1SPVlrWaM-hx7peKcieHXgOJEfSA2Bvf3XlAXYE-tM8LeJLW0A'
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

            app.addMarker({
                name: 'advanced-marker',
                latlng: {
                    lat: '{{ $object->address_lat }}',
                    lng: '{{ $object->address_long }}',
                },
                icon: app.icons.red,
                popup: false
            });
        });

        function openMap(app) {
            var latitude = '{{ $object->address_lat }}'; // عرض جغرافیایی
            var longitude = '{{ $object->address_long }}'; // طول جغرافیایی

            var uri;
            if (app === 'snapp') {
                uri = "snapp://map?lat=" + latitude + "&lng=" + longitude;
            } else if (app === 'waze') {
                uri = "waze://?ll=" + latitude + "," + longitude + "&navigate=yes";
            } else if (app === 'neshan') {
                uri = "neshan://navigate?lat=" + latitude + "&lon=" + longitude;
            } else if (app === 'balad') {
                uri = "balad://?q=" + latitude + "," + longitude;
            } else if (app === 'google_map') {
                uri = "google.navigation:q=" + latitude + "," + longitude;
            }

            if (uri) {
                window.location.href = uri;
            } else {
                alert("برنامه ناوبری معتبری انتخاب نشده است.");
            }
        }

        @endif

    </script>
@endsection

@section('Scripts')
    <script>
        $(document).ready(function () {
            $("#sign-in").delay(1500).fadeIn(500);
        });
    </script>

    <script type="text/javascript" src="/admin/assets/js/jquery-3.2.1.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
            integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        kamaDatepicker('id_date', {
            placeholder: "تاریخ رزرو"
            // , closeAfterSelect: false
            , nextButtonIcon: "fa fa-arrow-circle-right"
            , previousButtonIcon: "fa fa-arrow-circle-left"
            , buttonsColor: "orange"
            // , forceFarsiDigits: true
            , markToday: true
            , markHolidays: true
            , highlightSelectedDay: true
            , sync: true
            , gotoToday: true
        });

        $("#id_date").attr('autocomplete', 'off');

        $('#id_date').on('change', function () {
            $('#id_date').val($('#id_date').val().replaceAll('/', '-'))
        });

        $(document).ready(function () {

            $("#owl-demo").owlCarousel({

                loop: true,
                autoPlay: 3000,
                // items : 4,
                itemsDesktop: [1199, 3],
                itemsDesktopSmall: [979, 3]

            });

        });
    </script>
@endsection

@push('StackScript')
    <script>
        app.controller('myCtrl', function ($scope, $http) {
            $scope.form = 1;
            $scope.place_type = '{{ $object->type }}';
            $scope.reserve_type_id = null;
            $scope.has_reserve_type_options = false;
            $scope.tables = [];
            $scope.is_submited = false;

            $scope.GetPriceAsNumberHumanize = function (price) {
                return numberWithCommas(price);
            }

            $scope.SubmitReserveForm = function () {
                $scope.is_submited = true;

                if ($scope.form == 1) {

                    @if($object->type == 'hotel')
                        $scope.form = 3;
                    @else
                        $scope.form = 2;
                    @endif

                        $scope.is_submited = false;
                } else if ($scope.form == 2) {
                    $scope.form = 3;
                    $scope.is_submited = false;
                } else {
                    @if($object->type == 'hotel')
                    if (!$('input[name="hotel_room_id"]:checked').val()) {
                        showToast('لطفا اتاق مد نظر خودتان را انتخاب کنید!', 'error');
                        $('#id_hotel_room_id_required_error').show();
                        $scope.is_submited = false;
                        return;
                    }
                    @endif

                    $('#id_submit_button_2').css('cursor', 'not-allowed');

                    $("#id_reserve_form").attr('action', '{{ route('reserve', $object->slug) }}');
                    $("#id_reserve_form").submit();

                    $scope.is_submited = false;
                }
            }

            $scope.GetReserveTypeTables = function () {
                $scope.is_submited = true;
                $scope.has_reserve_type_options = false;

                var selectedItem = $('#id_reserve_type').find(":selected");
                if (!selectedItem.attr("data-has-price")) {
                    $('#id_submit_button_1').css('cursor', 'not-allowed');

                    var url = `/api/places/tables/{{ $object->id }}/${$scope.reserve_type_id}`;

                    $http.get(url).then(res => {
                        $('#id_submit_button_1').css('cursor', 'pointer');
                        $scope.is_submited = false;

                        $scope.tables = res['data']['data'];
                        $scope.has_reserve_type_options = true;

                    }).catch(err => {
                        showToast('خطایی رخ داد.', 'error');
                    });
                } else {
                    $scope.is_submited = false;
                }


            }

            $scope.SubmitAddRemoveToWishlists = function (type) {
                $scope.is_submited = true;
                var data = {
                    'type': type,
                };

                $('#id_add_to_wishlist').css("cursor", 'not-allowed');
                $('#id_remove_to_wishlist').css("cursor", 'not-allowed');

                var url = `{{ route('api.wishlists.add_and_remove', $object->id) }}`;

                $http.post(url, data).then(res => {
                    $scope.is_submited = false;
                    if (type == 'add') {
                        $('#id_add_to_wishlist').hide();
                        $('#id_remove_to_wishlist').show();
                    } else {
                        $('#id_add_to_wishlist').show();
                        $('#id_remove_to_wishlist').hide();
                    }

                    $('#id_add_to_wishlist').css("cursor", 'pointer');
                    $('#id_remove_to_wishlist').css("cursor", 'pointer');
                }).catch(err => {
                    showToast('خطایی رخ داد.', 'error');
                });
            }
        });
    </script>

    <script>
        @if($errors->any() && (!$errors->has('body') && !$errors->has('title') && !$errors->has('star')))
        showToast('{{ $errors->first() }}', 'error');
        @endif
    </script>
@endpush

@push('CSS')

@endpush
