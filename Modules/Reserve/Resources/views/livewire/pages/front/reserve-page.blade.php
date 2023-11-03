<div>
    <div class="hero_in cart_section start_bg_zoom">
        <div class="wrapper">
            <div class="container">
                <div class="bs-wizard clearfix">
                    <div class="bs-wizard-step">
                        <div class="text-center bs-wizard-stepnum">انتخاب مرکز</div>
                        <div class="progress">
                            <div class="progress-bar"></div>
                        </div>
                        <a class="bs-wizard-dot"></a>
                    </div>

                    <div class="bs-wizard-step active">
                        <div class="text-center bs-wizard-stepnum">فاکتور رزرو</div>
                        <div class="progress">
                            <div class="progress-bar"></div>
                        </div>
                        <a class="bs-wizard-dot"></a>
                    </div>

                    <div class="bs-wizard-step disabled">
                        <div class="text-center bs-wizard-stepnum">پرداخت</div>
                        <div class="progress">
                            <div class="progress-bar"></div>
                        </div>
                        <a class="bs-wizard-dot"></a>
                    </div>
                </div>
                <!-- End bs-wizard -->
            </div>
        </div>
    </div>
    <div class="bg_color_1" style="transform: none;">
        <div class="container margin_60_35" style="transform: none;">
            <div class="row" style="transform: none;">
                <div class="col-lg-8">
                    <div class="box_cart">

                        <div class="message text-center">
                            <p> برای رزرو باید حتما در سایت بامیز ثبت نام نمائید</p>
                        </div>

                    {{--                        <div>--}}
                    {{--                            <div class="form_title">--}}
                    {{--                                <h3><strong>1</strong>مشخصات کاربری</h3>--}}
                    {{--                            </div>--}}
                    {{--                            <div class="step">--}}
                    {{--                                <div class="row">--}}
                    {{--                                    <div class="col-sm-4">--}}
                    {{--                                        <div class="form-group">--}}
                    {{--                                            <label>نام و نام خانوادگی</label>--}}
                    {{--                                            <input type="text" class="form-control" id="name" name="name" value="">--}}
                    {{--                                        </div>--}}
                    {{--                                    </div>--}}
                    {{--                                    <div class="col-sm-4">--}}
                    {{--                                        <div class="form-group">--}}
                    {{--                                            <label>شماره تلفن</label>--}}
                    {{--                                            <input type="number" class="form-control" id="phoneNumber" placeholder=""--}}
                    {{--                                                   name="phoneNumber">--}}
                    {{--                                        </div>--}}
                    {{--                                    </div>--}}
                    {{--                                    <div class="col-sm-4">--}}
                    {{--                                        <div class="form-group">--}}
                    {{--                                            <br>--}}
                    {{--                                            <button id="btn_fast_register" type="button" class="btn_1 full-width outline"><i--}}
                    {{--                                                    class="icon-user-add"></i>ثبت نام فوری--}}
                    {{--                                            </button>--}}
                    {{--                                        </div>--}}
                    {{--                                    </div>--}}
                    {{--                                </div>--}}
                    {{--                                <div class="row" id="verify_div" style="display: none;">--}}
                    {{--                                    <div class="col-sm-4">--}}
                    {{--                                        <div class="form-group">--}}
                    {{--                                            <label>کد تایید ثبت نام</label>--}}
                    {{--                                            <input type="number" class="form-control" id="verify_code" placeholder=""--}}
                    {{--                                                   name="verify_code">--}}
                    {{--                                        </div>--}}
                    {{--                                    </div>--}}
                    {{--                                    <div class="col-sm-4">--}}
                    {{--                                        <div class="form-group">--}}
                    {{--                                            <br>--}}
                    {{--                                            <button id="btn_fast_register_verify" type="button"--}}
                    {{--                                                    class="btn_1 full-width purchase"><i class="icon-check"></i>تاید ثبت نام--}}
                    {{--                                            </button>--}}
                    {{--                                        </div>--}}
                    {{--                                    </div>--}}
                    {{--                                </div>--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}
                    {{--                        <hr>--}}
                    <!--End step -->

                        <div class="form_title">
                            <h3><strong>1</strong>مشخصات رزرو</h3>
                            <br>
                            <table class="table table-striped cart-list">
                                <tbody class="text-left">
                                <tr>
                                    <td style="padding-right: 0 !important; text-align: center !important;">
                                        نام محل
                                    </td>
                                    <td style="padding-right: 0 !important; text-align: center !important;">
                                        <strong> {{ $place->name }} </strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding-right: 0 !important; text-align: center !important;">
                                        تاریخ رزرو
                                    </td>
                                    <td style="padding-right: 0 !important; text-align: center !important;">
                                        <strong> {{ str_replace('-', '/', $data['date']) }} </strong>
                                    </td>
                                </tr>
                                @if(isset($data['start_time']))
                                    <tr>
                                        <td style="padding-right: 0 !important; text-align: center !important;">
                                            ساعت رزرو
                                        </td>
                                        <td style="padding-right: 0 !important; text-align: center !important;">
                                            <strong> ساعت {{ $data['start_time'] }} </strong>
                                        </td>
                                    </tr>
                                @endif
                                <tr>
                                    <td style="padding-right: 0 !important; text-align: center !important;">
                                        مدت رزرو
                                    </td>
                                    @if($place->type == 'hotel')
                                        <td style="padding-right: 0 !important; text-align: center !important;">
                                            <strong>{{ $data['days_number'] }} روز </strong>
                                        </td>
                                    @else
                                        <td style="padding-right: 0 !important; text-align: center !important;">
                                            <strong>2 ساعت </strong>
                                        </td>
                                    @endif
                                </tr>
                                <tr>
                                    <td style="padding-right: 0 !important; text-align: center !important;">
                                        تعداد مهمان
                                    </td>
                                    <td style="padding-right: 0 !important; text-align: center !important;">
                                        <strong> {{ $data['guest_count'] }} مهمان </strong>
                                    </td>
                                </tr>

                                @if(isset($data['children_guest_count']) && $place->type == 'hotel')
                                    <tr>
                                        <td style="padding-right: 0 !important; text-align: center !important;">
                                            تعداد خردسالان
                                        </td>
                                        <td style="padding-right: 0 !important; text-align: center !important;">
                                            <strong> {{ $data['children_guest_count'] ?? 0 }} مهمان </strong>
                                        </td>
                                    </tr>
                                @endif

                                <tr>
                                    <td style="padding-right: 0 !important; text-align: center !important;">
                                        @if($place->type == 'hotel')
                                            اتاق انتخابی
                                        @else
                                            شماره میز
                                        @endif
                                    </td>
                                    <td style="padding-right: 0 !important; text-align: center !important;">
                                        <strong>
                                            @if($place->type == 'hotel')
                                                {{ $reserve->hotel_room ? $reserve->hotel_room->title : '---' }}
                                            @else
                                                @if(isset($data['room_number']))
                                                    {{ $data['room_number'] }}
                                                @else
                                                    به انتخاب مرکز
                                                @endif
                                            @endif
                                        </strong>
                                    </td>
                                </tr>

                                @if($place->food_discount)
                                    <tr>
                                        <td style="padding-right: 0 !important; text-align: center !important;">
                                            @if($place->type == 'hotel')
                                                تخفیف اتاق
                                            @else
                                                تخفیف سفارش غذا (در محل)
                                            @endif
                                        </td>
                                        <td style="padding-right: 0 !important; text-align: center !important;">
                                            <strong>{{ $place->food_discount }} درصد</strong>
                                        </td>
                                    </tr>
                                @endif

                                </tbody>
                            </table>
                        </div>
                        <hr>
{{--                        <div class="form_title">--}}
{{--                            <h3><strong>2</strong>تشریفات</h3>--}}
{{--                            <br>--}}
{{--                            --}}{{--                            <h6>در صورت تمایل می توانید میز خود را با انتخاب هر کدام از موارد زیر تزئین نمائید</h6>--}}
{{--                            <h6>در صورت تمایل می توانید هر یک از تشریفات زیر را به رزرو خود اضافه نمائید.</h6>--}}
{{--                            <br>--}}
{{--                            <table class="table table-striped cart-list">--}}
{{--                                <thead>--}}
{{--                                <th>عنوان</th>--}}
{{--                                <th style="content: 'مبلغ' !important;">مبلغ</th>--}}
{{--                                <th>تصویر نمونه</th>--}}
{{--                                <th>توضیحات</th>--}}
{{--                                <th>عملیات</th>--}}
{{--                                </thead>--}}
{{--                                <tbody>--}}
{{--                                @foreach($place->options as $op)--}}
{{--                                    <tr>--}}
{{--                                        <td style="padding-right: 0 !important; text-align: center !important;"> {{ $op->title }} </td>--}}
{{--                                        <td style="padding-right: 0 !important; text-align: center !important;">--}}
{{--                                            @if($op->discount_amount) {{ number_format($op->discount_amount) }} @else {{ number_format($op->amount) }} @endif--}}
{{--                                            @if($op->discount_amount)--}}
{{--                                                <del>{{ number_format($op->amount) }}</del> تومان--}}
{{--                                                <br>--}}
{{--                                                {{ number_format($op->discount_amount) }} تومان--}}
{{--                                            @else--}}
{{--                                                {{ number_format($op->amount) }} تومان--}}
{{--                                            @endif--}}
{{--                                        </td>--}}
{{--                                        <td style="padding-right: 0 !important; text-align: center !important;">--}}
{{--                                            <a href="{{ $op->get_image() }}" target="_blank">--}}
{{--                                                <img width="50" src="{{ $op->get_image() }}"--}}
{{--                                                     alt="{{ $op->title }}">--}}
{{--                                            </a>--}}
{{--                                        </td>--}}
{{--                                        <td style="padding-right: 0 !important; text-align: center !important;"> {!! \Illuminate\Support\Str::limit($op->description , 20) !!} </td>--}}
{{--                                        <td style="padding-right: 0 !important; text-align: center !important;">--}}
{{--                                            @if(array_search($op->id , $options) !== false)--}}
{{--                                                <button--}}
{{--                                                    wire:click="RemoveOption('{{ $op->id }}', {{ $op->discount_amount ?: $op->amount }})"--}}
{{--                                                    id="id_button_{{ $op->id }}"--}}
{{--                                                    onclick="$('#id_button_{{ $op->id }}').prop('disabled', true)"--}}
{{--                                                    class="btn btn-danger"> حذف--}}
{{--                                                </button>--}}
{{--                                            @else--}}
{{--                                                <button--}}
{{--                                                    wire:click="AddNewOption('{{ $op->id }}', {{ $op->discount_amount ?: $op->amount }})"--}}
{{--                                                    id="id_button_{{ $op->id }}"--}}
{{--                                                    onclick="$('#id_button_{{ $op->id }}').prop('disabled', true)"--}}
{{--                                                    class="btn btn-success"> افزودن--}}
{{--                                                </button>--}}
{{--                                            @endif--}}
{{--                                        </td>--}}
{{--                                    </tr>--}}

{{--                                @endforeach--}}

{{--                                </tbody>--}}
{{--                            </table>--}}
{{--                        </div>--}}
{{--                        <div class="step">--}}
{{--                        </div>--}}
{{--                        <hr>--}}

                        @if($place->terms)
                            <div id="policy">
                                <h5>قوانین و مقررارت</h5>
                                <p class="nomargin">{!! $place->terms !!}</p>
                            </div>
                        @endif
                    </div>
                </div>
                <!-- /col -->

                <aside class="col-lg-4" id="sidebar" wire:ignore
                       style="position: relative; overflow: visible; box-sizing: border-box; min-height: 1116.6px;">

                    <div class="theiaStickySidebar"
                         style="padding-top: 0px; padding-bottom: 1px; position: absolute; transform: translateY(771.2px); top: 0px; width: 350px;">
                        <div class="box_detail">
                            <form action="{{ $payment_url }}" method="post">

                                @csrf
                                <input type="hidden" name="options" wire:model='options'>

                                <div id="total_cart">
                                    <h5 style="text-align: center"> لیست سفارش رزرو میز</h5>
                                </div>
                                <ul class="cart_details" id="card_detail">
                                    <li> مبلغ رزرو مرکز
                                        <span>
                                             @if($place->food_discount && $place->type == 'hotel')
                                                <del>{{ number_format($total_price_without_discount) }} تومان</del>
                                            @else
                                                {{ number_format($total_price_without_discount) }} تومان
                                            @endif

                                        </span></li>

                                    @if($place->food_discount && $place->type == 'hotel')
                                        <li> مبلغ با تخفیف
                                            <span>{{ number_format($total_price - $options_price) }} تومان</span></li>
                                    @endif
                                </ul>

{{--                                <ul class="cart_details" id="card_detail">--}}
{{--                                    <li>مبلغ رزرو تشریفات <span id="options_price">{{ number_format($options_price) }} تومان </span>--}}
{{--                                    </li>--}}
{{--                                </ul>--}}

                                <ul class="cart_details" id="card_detail">
                                    <li>مالیات بر ارزش افزوده: <span id="task_amount">{{ number_format(CalculateTaskAmount($total_price)) }} تومان </span>
                                    </li>
                                </ul>

                                <div id="total_cart">
                                    جمع کل <span class="float-right" id="total_price">{{ number_format($total_price) }}  تومان </span>
                                </div>

                                <ul class="cart_details" id="card_detail">
                                    <li>
                                        <input type="checkbox" required value="1" id="id_terms"><label for="id_terms"
                                                                                                       class="ml-2">قوانین
                                            و مقرارت را می پذیرم</label>
                                    </li>
                                </ul>

                                <button type="submit" id="id_submit" class="btn_1 full-width purchase">پرداخت آنلاین
                                </button>
                            </form>
                        </div>
                        <div class="resize-sensor"
                             style="position: absolute; inset: 0px; overflow: hidden; z-index: -1; visibility: hidden;">
                            <div class="resize-sensor-expand"
                                 style="position: absolute; left: 0; top: 0; right: 0; bottom: 0; overflow: hidden; z-index: -1; visibility: hidden;">
                                <div
                                    style="position: absolute; left: 0px; top: 0px; transition: all 0s ease 0s; width: 360px; height: 356px;"></div>
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

@section('Scripts')
    <script>
        $('#id_terms').change(function () {
            $('#id_submit').prop("disabled", !this.checked);
            if (this.checked) {
                $('#id_submit').css("cursor", 'pointer');
            } else {
                $('#id_submit').css("cursor", 'not-allowed');
            }
        }).change()
    </script>
@endsection

@push('StackScript')
    <script type="text/javascript">
        window.addEventListener('reserveOptionsUpdated', event => {
            $('#id_button_' + event['detail']['option_id']).prop('disabled', false);

            $('#total_price').html(`${numberWithCommas(event['detail']['price'])} تومان`);
            $('#options_price').html(`${numberWithCommas(event['detail']['options_price'])} تومان`);
            $('#task_amount').html(`${numberWithCommas(event['detail']['task_amount'])} تومان`);
        });
    </script>
@endpush
