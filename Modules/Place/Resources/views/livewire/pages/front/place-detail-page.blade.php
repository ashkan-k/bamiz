@section('Styles')
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
                    <li><a href="#menu_image">منوی غذا</a></li>
                    <li><a href="#galley">گالری تصاویر</a></li>
                    <li><a href="#map">موقعیت</a></li>
                    <li><a href="#comments">نظرات</a></li>
                    <li><a href="#worktime">ساعت کاری</a></li>
                    <li><a href="#sidebar">رزرو</a></li>
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

                        <h3>منوی غذا</h3>
                        <div id="instagram-feed" class="clearfix"></div>
                        <div class="mt-3 mb-5" id="menu_image"
                             style="width: 300px !important; height: 169px !important; !important; ;border-radius: 20px;box-shadow: 5px 10px 18px rgba(32,32,32,0.55);">
                            <label class="control-label">
                                <a href="{{ $object->get_menu_image('original') }}" target="_blank"><img
                                        style="border-radius: 20px; margin-bottom: 8px;"
                                        src="{{ $object->get_menu_image(300) }}"></a>
                            </label>
                        </div>
                        {{--                        <img src="{{ $object->get_menu_image(300) }}" style="width: 200px !important; height: 200% !important;" alt="{{ $object->name }}">--}}
                        <hr>


                        <h3 id="galley">گالری تصاویر</h3>
                        <div class="clearfix"></div>

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
                </div>
                <!-- /col -->

                {{--                <aside class="col-lg-4" id="sidebar"--}}
                {{--                       style="position: relative; overflow: visible; box-sizing: border-box; min-height: 1610.6px;">--}}

                {{--                    <div class="theiaStickySidebar"--}}
                {{--                         style="padding-top: 0px; padding-bottom: 1px; position: fixed; transform: translateY(-51.4px); top: 0px; left: 204.6px; width: 350px;">--}}

                {{--                        @if($errors->any() && (!$errors->has('body') && !$errors->has('title') && !$errors->has('star')))--}}

                {{--                            <div class="alert alert-danger text-center">--}}

                {{--                                @foreach($errors->all() as $e)--}}
                {{--                                    {{ $e }}<br>--}}
                {{--                                @endforeach--}}

                {{--                            </div>--}}

                {{--                        @endif--}}

                {{--                        <form action="{{ route('reserve' , $object->slug) }}" method="post">--}}

                {{--                            @csrf--}}

                {{--                            @auth--}}
                {{--                                <input type="hidden" name="place_id" value="{{ $object->id }}">--}}
                {{--                                <input type="hidden" name="user_id" value="{{ auth()->id() }}">--}}
                {{--                            @endauth--}}

                {{--                            <div class="box_detail" wire:ignore>--}}
                {{--                                <div class="price">--}}
                {{--                                    <span> {{ $price ? number_format($price) : '---' }} <small> تومان هزینه رزرو هر نفر</small></span>--}}
                {{--                                    <div class="score"><strong>{{ $object->reserves()->where('status', 1)->count() }}--}}
                {{--                                            رزرو موفق</strong></div>--}}
                {{--                                    <br>--}}
                {{--                                    <div class="text-center" style="margin-top: 10px;color: red"><strong>هزینه رزرو از--}}
                {{--                                            مبلغ--}}
                {{--                                            فاکتور سفارش کسر می شود</strong></div>--}}
                {{--                                </div>--}}

                {{--                                <div class="form-group mt-2">--}}
                {{--                                    @if(in_array($object->type, ['restaurant', 'cafe']))--}}
                {{--                                        <small style="color: red">تعداد صندلی های هر میز--}}
                {{--                                            : {{ $object->chairs_people_count }}</small>--}}
                {{--                                    @endif--}}
                {{--                                    <input required class="form-control" type="text"--}}
                {{--                                           value="{{ old('guest_count') }}"--}}
                {{--                                           name="guest_count" id="quest_count"--}}
                {{--                                           placeholder="تعداد مهمانان">--}}
                {{--                                </div>--}}

                {{--                                <div class="form-group">--}}
                {{--                                    <input required class="form-control" type="text" name="date"--}}
                {{--                                           id="id_date" value="{{ old('date') }}"--}}
                {{--                                           placeholder="تاریخ رزرو">--}}
                {{--                                </div>--}}

                {{--                                @if($object->type == 'hotel')--}}
                {{--                                    <div class="form-group mt-2">--}}
                {{--                                        <input required class="form-control" type="text"--}}
                {{--                                               value="{{ old('days_number') }}"--}}
                {{--                                               name="days_number" id="quest_count"--}}
                {{--                                               placeholder="تعداد روز">--}}
                {{--                                    </div>--}}
                {{--                                @endif--}}

                {{--                                <div class="form-group clearfix mt-2">--}}
                {{--                                    <select required class="form-control" id="chain_no" name="start_time">--}}
                {{--                                        <option value="">ساعت رزرو</option>--}}

                {{--                                        @foreach($times as $c)--}}
                {{--                                            <option @if(old('start_time') == $c) selected @endif value="{{ $c }}">--}}
                {{--                                                ساعت {{ $c }} </option>--}}
                {{--                                        @endforeach--}}

                {{--                                    </select>--}}
                {{--                                    @if(in_array($object->type, ['restaurant', 'cafe']))--}}
                {{--                                        <p class="text-danger" style="margin-bottom: 0 !important;">مدت زمان حضور در محل--}}
                {{--                                            دو--}}
                {{--                                            ساعت می باشد.</p>--}}
                {{--                                    @endif--}}

                {{--                                    @if(in_array($object->type, ['restaurant', 'cafe']))--}}
                {{--                                        <select ng-model="reserve_type_id" ng-change="GetReserveTypeTables()" required--}}
                {{--                                                class="form-control mt-3" id="id_reserve_type" name="reserve_type_id">--}}
                {{--                                            <option value="" data-has-price="null">مناسبت (موضوع رزرو) را انتخاب کنید--}}
                {{--                                            </option>--}}

                {{--                                            @foreach($reserve_types as $res_type)--}}
                {{--                                                <option data-has-price="{{ $res_type->price }}"--}}
                {{--                                                        @if(old('reserve_type_id') == $res_type->id) selected--}}
                {{--                                                        @endif value="{{ $res_type->id }}">{{ $res_type->title }}--}}
                {{--                                                </option>--}}
                {{--                                            @endforeach--}}

                {{--                                            --}}{{--                                            @foreach($reserve_types as $res_type)--}}
                {{--                                            --}}{{--                                                <option @if(old('type')) @if(old('type') == $res_type['id'] ) selected--}}
                {{--                                            --}}{{--                                                        @endif @elseif(isset($item->type) && $item->type == $res_type['id']) selected--}}
                {{--                                            --}}{{--                                                        @endif value="{{ $res_type['id'] }}"--}}
                {{--                                            --}}{{--                                                        value="{{ $res_type['id'] }}">{{ $res_type['name'] }}--}}
                {{--                                            --}}{{--                                                </option>--}}
                {{--                                            --}}{{--                                            @endforeach--}}
                {{--                                        </select>--}}


                {{--                                        <select ng-if="tables.length > 0" required class="form-control mt-3"--}}
                {{--                                                id="id_table_id" name="table_id">--}}
                {{--                                            <option value="">شماره میز مد نظر را انتخاب کنید</option>--}}

                {{--                                            <option ng-repeat="item in tables"--}}
                {{--                                                    ng-selected="item.id == {{ old('table_id', '-1') }}"--}}
                {{--                                                    value="[[ item.id ]]">[[ item.title ]]--}}
                {{--                                            </option>--}}
                {{--                                        </select>--}}
                {{--                                    @endif--}}

                {{--                                    <div class="text-center text-danger"><b>سفارش تشریفات در صورت--}}
                {{--                                            تمایل در--}}
                {{--                                            مرحله بعد--}}
                {{--                                            انجام می شود</b></div>--}}

                {{--                                    @if(auth()->check())--}}
                {{--                                        <button id="btn_check_reserve" type="submit"--}}
                {{--                                                class="btn_1 full-width outline mt-5">--}}
                {{--                                            <i--}}
                {{--                                                class="icon-calendar-outlilne"></i> تکمیل رزرو--}}
                {{--                                        </button>--}}

                {{--                                        <button ng-click="SubmitAddRemoveToWishlists('add')"--}}
                {{--                                                ng-disabled="is_submited"--}}
                {{--                                                @if($is_Added_To_WishList) style="display: none" @endif--}}
                {{--                                                id="id_add_to_wishlist"--}}
                {{--                                                class="btn_1 full-width outline wishlist mt-3"><i--}}
                {{--                                                class="icon_heart"></i> اضافه به علاقه مندی ها--}}
                {{--                                        </button>--}}
                {{--                                        <button ng-click="SubmitAddRemoveToWishlists('remove')"--}}
                {{--                                                ng-disabled="is_submited"--}}
                {{--                                                @if(!$is_Added_To_WishList) style="display: none" @endif--}}
                {{--                                                id="id_remove_to_wishlist"--}}
                {{--                                                class="btn_1 full-width outline wishlist mt-3"><i--}}
                {{--                                                class="icon_heart"></i> حذف از علاقه مندی ها--}}
                {{--                                        </button>--}}
                {{--                                    @else--}}
                {{--                                        <button--}}
                {{--                                            onclick="window.location.href = '{{ route('login') }}?next=/{{ request()->path() }}'"--}}
                {{--                                            id="btn_check_reserve" type="button" class="btn_1 full-width outline mt-5">--}}
                {{--                                            <i--}}
                {{--                                                class="icon-calendar-outlilne"></i> ورود به سایت برای رزرو--}}
                {{--                                        </button>--}}

                {{--                                        <hr>--}}
                {{--                                        <span class="alert alert-danger">برای افزدون به علاقه مندی ها ابتدا <a--}}
                {{--                                                class="text-info"--}}
                {{--                                                href="{{ route('login') }}"> وارد </a> شوید</span>--}}
                {{--                                    @endif--}}

                {{--                                </div>--}}
                {{--                            </div>--}}
                {{--                        </form>--}}
                {{--                        <div class="resize-sensor"--}}
                {{--                             style="position: absolute; inset: 0px; overflow: hidden; z-index: -1; visibility: hidden;">--}}
                {{--                            <div class="resize-sensor-expand"--}}
                {{--                                 style="position: absolute; left: 0; top: 0; right: 0; bottom: 0; overflow: hidden; z-index: -1; visibility: hidden;">--}}
                {{--                                <div--}}
                {{--                                    style="position: absolute; left: 0px; top: 0px; transition: all 0s ease 0s; width: 360px; height: 536px;"></div>--}}
                {{--                            </div>--}}
                {{--                            <div class="resize-sensor-shrink"--}}
                {{--                                 style="position: absolute; left: 0; top: 0; right: 0; bottom: 0; overflow: hidden; z-index: -1; visibility: hidden;">--}}
                {{--                                <div--}}
                {{--                                    style="position: absolute; left: 0; top: 0; transition: 0s; width: 200%; height: 200%"></div>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                </aside>--}}
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
                @if(in_array($object->type, ['restaurant', 'cafe']))
                    <p class="text-danger" style="margin-bottom: 0 !important;">
                        تعداد صندلی های هر میز
                        : {{ $object->chairs_people_count }}
                    </p>
                    {{--                    <small style="color: red">تعداد صندلی های هر میز--}}
                    {{--                        : {{ $object->chairs_people_count }}</small>--}}
                @endif
                @error('guest_count')
                <span class="text-danger text-wrap">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>تاریخ رزرو</label>
                <input required class="form-control" type="text" name="date"
                       id="id_date" value="{{ old('date') }}"
                       placeholder="تاریخ رزرو">

                @error('date')
                <span class="text-danger text-wrap">{{ $message }}</span>
                @enderror
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
            @if(in_array($object->type, ['restaurant', 'cafe']))
                <p class="text-danger" style="margin-bottom: 0 !important;">مدت زمان حضور در محل
                    دو
                    ساعت می باشد.</p>
            @endif

            @if(in_array($object->type, ['restaurant', 'cafe']))
                <div class="form-group" style="margin-top: 1rem !important;">
                    <label>مناسبت (موضوع رزرو)</label>
                    <select ng-model="reserve_type_id" ng-change="GetReserveTypeTables()" required
                            class="form-control" id="id_reserve_type" name="reserve_type_id">
                        <option value="" data-has-price="null">مناسبت (موضوع رزرو) را انتخاب کنید
                        </option>

                        @foreach($reserve_types as $res_type)
                            <option data-has-price="{{ $res_type->price }}"
                                    @if(old('reserve_type_id') == $res_type->id) selected
                                    @endif value="{{ $res_type->id }}">{{ $res_type->title }} @if($res_type->price)
                                    ({{ $res_type->price }} تومان)@endif
                            </option>
                        @endforeach

                        {{--                                            @foreach($reserve_types as $res_type)--}}
                        {{--                                                <option @if(old('type')) @if(old('type') == $res_type['id'] ) selected--}}
                        {{--                                                        @endif @elseif(isset($item->type) && $item->type == $res_type['id']) selected--}}
                        {{--                                                        @endif value="{{ $res_type['id'] }}"--}}
                        {{--                                                        value="{{ $res_type['id'] }}">{{ $res_type['name'] }}--}}
                        {{--                                                </option>--}}
                        {{--                                            @endforeach--}}
                    </select>

                    @error('reserve_type_id')
                    <span class="text-danger text-wrap">{{ $message }}</span>
                    @enderror
                </div>


                <div ng-if="tables.length > 0" class="form-group">
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

                    @error('table_id')
                    <span class="text-danger text-wrap">{{ $message }}</span>
                    @enderror
                </div>
            @endif

            <div class="text-center text-danger mt-2 mb-2"><b>سفارش تشریفات در صورت
                    تمایل در
                    مرحله بعد
                    انجام می شود</b></div>

            <div class="text-center">
                {{--                <input ng-if="!reserve_form.$valid || is_submited" style="cursor: not-allowed;" type="button" value="مرحله بعد" class="btn_1 full-width">--}}
                {{--                <input ng-if="reserve_form.$valid && !is_submited" ng-click="form=2" type="button" value="مرحله بعد" class="btn_1 full-width">--}}
                <input type="submit" value="مرحله بعد" class="btn_1 full-width">
            </div>
        </div>

        <div class="sign-in-wrapper" ng-show="form == 2">

            <div class="text-center mt-2 mb-2"><b>تشریفات</b></div>
            <hr>

            <div class="row">
                @foreach($object->options as $op)
                    <div class="form-group col-12">
                        <label for="id_option_{{ $op->id }}">{{ $op->title }}</label>
                        <input id="id_option_{{ $op->id }}" type="checkbox" name="option_id[]" value="{{ $op->id }}">

                        <p class="pull-left">{{ number_format($op->amount) ?: '---' }} تومان</p>

                        {{--                        <span>{!! \Illuminate\Support\Str::limit($op->description, 50) !!}</span>--}}
                        <a href="{{ $op->get_image() }}"><img class="pull-left mb-3"
                                                              style="clear: both !important;"
                                                              src="{{ $op->get_image() }}" width="50"
                                                              alt="{{ $op->title }}"></a>
                        <hr style="clear: both !important;margin-top: 1rem;margin-bottom: 1rem;border: 0;border-top: 3px solid rgba(0, 0, 0, 0.1);"/>
                    </div>


                @endforeach
            </div>

            <div class="text-center text-danger mt-2 mb-2"><b>تشریفات مورد نظر خود را در صورت نیاز انتخاب کنید.
                    (اختیاری)</b></div>

            <div class="text-center">
                <input type="submit" value="تکمیل رزرو" class="btn_1 full-width">
            </div>
        </div>

    </form>
    <!--form -->
</div>
<!-- /Sign In Popup -->

@section('Scripts')
    <script>
        $(document).ready(function () {
            $("#sign-in").delay(1500).fadeIn(500);
        });
    </script>

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
        });
        @endif

    </script>

    <script>
        kamaDatepicker('id_date', {
            placeholder: 'تاریخ رزرو',
            buttonsColor: 'blue',
            markHolidays: true,
            markToday: true,
        });
        $("#id_date").attr('autocomplete', 'off');

        $('#id_date').on('change', function () {
            $('#id_date').val($('#id_date').val().replaceAll('/', '-'))
        });
    </script>
@endsection

@push('StackScript')
    <script>
        app.controller('myCtrl', function ($scope, $http) {
            $scope.form = 1;
            $scope.reserve_type_id = null;
            $scope.tables = [];

            $scope.GetPriceAsNumberHumanize = function (price) {
                return numberWithCommas(price);
            }

            // $scope.SubmitReserveForm = function (new_number) {
            //     $scope.ChangeForm(2);
            // }

            $scope.SubmitReserveForm = function () {
                if ($scope.form == 1){
                    $scope.form = 2;
                }else {
                    $("#id_reserve_form").attr('action', '{{ route('reserve', $object->slug) }}');
                    $("#id_reserve_form").submit();
                    console.log( $("#id_reserve_form"))
                }
            }

            $scope.GetReserveTypeTables = function () {
                var selectedItem = $('#id_reserve_type').find(":selected");
                if (!selectedItem.attr("data-has-price")) {
                    var url = `/api/places/tables/{{ $object->id }}/${$scope.reserve_type_id}`;

                    $http.get(url).then(res => {
                        $scope.is_submited = false;

                        $scope.tables = res['data']['data'];

                    }).catch(err => {
                        showToast('خطایی رخ داد.', 'error');
                    });
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
@endpush

@push('CSS')

@endpush
