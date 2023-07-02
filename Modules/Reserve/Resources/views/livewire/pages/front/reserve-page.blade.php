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
                                <tbody>
                                <tr>
                                    <td>
                                        نام محل
                                    </td>
                                    <td>
                                        <strong> {{ $place->name }} </strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        تاریخ رزرو
                                    </td>
                                    <td>
                                        <strong> {{ $data['date'] }} </strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        ساعت رزرو
                                    </td>
                                    <td>
                                        <strong> ساعت {{ $data['start_time'] }} </strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        مدت رزرو
                                    </td>
                                    <td>
                                        <strong>2 ساعت </strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        تعداد صندلی
                                    </td>
                                    <td>
                                        <strong> {{ $data['guest_count'] }} صندلی </strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        @if($place->type == 'hotel')
                                            شماره اتاق
                                        @else
                                            شماره میز
                                        @endif
                                    </td>
                                    <td>
                                        <strong>
                                            @if(isset($data['room_number']))
                                                {{ $data['room_number'] }}
                                            @else
                                                به انتخاب مرکز
                                            @endif
                                        </strong>
                                    </td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                        <hr>
                        <div class="form_title">
                            <h3><strong>2</strong>خدمات تشریفات</h3>
                            <br>
                            {{--                            <h6>در صورت تمایل می توانید میز خود را با انتخاب هر کدام از موارد زیر تزئین نمائید</h6>--}}
                            <h6>در صورت تمایل می توانید هر یک از تشریفات زیر را به رزرو خود اضافه نمائید.</h6>
                            <br>
                            <table class="table table-striped cart-list">
                                <thead>
                                <th>عنوان</th>
                                <th>مبلغ</th>
                                <th>تصویر نمونه</th>
                                <th>توضیحات</th>
                                <th>عملیات</th>
                                </thead>
                                <tbody>
                                @foreach($place->options as $op)
                                    <tr>
                                        <td> {{ $op->title }} </td>
                                        <td> {{ number_format($op->amount) }} تومان</td>
                                        <td><img width="50" src="{{ $op->get_image() }}"
                                                 alt="{{ $op->title }}"></td>
                                        <td> {!! \Illuminate\Support\Str::limit($op->description , 20) !!} </td>
                                        <td>
                                            @if(array_search($op->id , $options) !== false)
                                                <button wire:click="RemoveOption('{{ $op->id }}')"
                                                        class="btn btn-danger"> حذف
                                                </button>
                                            @else
                                                <button wire:click="AddNewOption('{{ $op->id }}')"
                                                        class="btn btn-success"> افزودن
                                                </button>
                                            @endif
                                        </td>
                                    </tr>

                                @endforeach

                                </tbody>
                            </table>
                        </div>
                        <div class="step">
                        </div>
                        <hr>
                        <div id="policy">
                            <h5>کسر از فیش</h5>
                            <p class="nomargin"> {{ $place->name }} در راستای رفاه حال مشتریان هزینه رزرو را از مبلغ
                                سفارش در محل
                                کسر می کند و شما فقط هزینه سفارش خود را در محل پرداخت می کنید و هزینه رزرو برای شما
                                کاملا رایگان می باشد. </p>
                        </div>
                        <hr>
                        <!--End step -->
                        <div id="policy">
                            <h5>شرایط لغو رزرو</h5>
                            <p class="nomargin"> با توجه به سیاست های {{ $place->name }} لغو رزرو <strong
                                    style="color: red"> شامل
                                    20 درصد کل هزینه رزرو می باشد </strong> و الباقی مبلغ رزرو به حساب کاربری در بامیز
                                عودت داده می شود</p>
                        </div>
                    </div>
                </div>
                <!-- /col -->

                <aside class="col-lg-4" id="sidebar" wire:ignore
                       style="position: relative; overflow: visible; box-sizing: border-box; min-height: 1116.6px;">

                    <div class="theiaStickySidebar"
                         style="padding-top: 0px; padding-bottom: 1px; position: absolute; transform: translateY(771.2px); top: 0px; width: 350px;">
                        <div class="box_detail">
                            {{--                            <form action="{{ route('payment' , [$place->slug]) }}" method="post">--}}
                            <form method="post">

                                @csrf
                                <input type="hidden" name="options" wire:model='options'>

                                <div id="total_cart">
                                    <h5 style="text-align: center"> لیست سفارش رزرو میز</h5>
                                </div>
                                <ul class="cart_details" id="card_detail">
                                    <li> مبلغ رزرو هر نفر <span>{{ $price }} تومان</span></li>
                                    <li>خدمات تشریفات <span id="options_price">{{ $options_price }} تومان </span></li>
                                </ul>
                                <div id="total_cart">
                                    جمع کل <span class="float-right" id="total_price">{{ number_format(($price * $data['guest_count']) + $options_price) }}  تومان </span>
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
    <script>
        function numberWithCommas(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }
    </script>

    <script type="text/javascript">
        window.addEventListener('reserveOptionsUpdated', event => {
            $('#total_price').html(numberWithCommas(event['detail']['price']));
            $('#options_price').html(numberWithCommas(event['detail']['options_price']));
        });
    </script>
@endpush
