<div>
    <div class="bg_color_1" style="transform: none; margin-top: 100px !important;">
        <div class="container margin_60_35" style="transform: none;">
            <div class="row" style="transform: none;">
                <div class="col-lg-12">
                    <div class="box_cart">

                        <div class="message text-center">
                            <p> ویرایش اطلاعات کاربری</p>
                        </div>

                        <div>
                            <div class="form_title">
                                <h3><strong>1</strong>مشخصات کاربری</h3>
                            </div>
                            <div class="step">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>نام و نام خانوادگی</label>
                                            <input type="text" class="form-control" id="name" name="name" value="">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>شماره تلفن</label>
                                            <input type="number" class="form-control" id="phoneNumber" placeholder=""
                                                   name="phoneNumber">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <br>
                                            <button id="btn_fast_register" type="button"
                                                    class="btn_1 full-width outline"><i
                                                    class="icon-user-add"></i>ثبت نام فوری
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" id="verify_div" style="display: none;">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>کد تایید ثبت نام</label>
                                            <input type="number" class="form-control" id="verify_code" placeholder=""
                                                   name="verify_code">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <br>
                                            <button id="btn_fast_register_verify" type="button"
                                                    class="btn_1 full-width purchase"><i class="icon-check"></i>تاید ثبت
                                                نام
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>

                        <div class="message text-center">
                            <p> لیست رزرو های من</p>
                        </div>

                        <div class="form_title">
                            <h3><strong>2</strong>لیست رزرو ها</h3>
                            <br>
                            {{--                            <h6>در صورت تمایل می توانید میز خود را با انتخاب هر کدام از موارد زیر تزئین نمائید</h6>--}}
                            <h6>در صورت تمایل می توانید هر یک از رزرو های خود را تا پیش از زمان موعد لغو نمائید.</h6>
                            <br>
                            <table class="table table-striped cart-list">
                                <thead>
                                <th>مرکز</th>
                                <th>تاریخ</th>
                                <th>زمان شروع (ساعت)</th>
                                <th>تعداد نفرات</th>
                                <th>مبلغ</th>
                                <th>نوع</th>
                                <th>اتاق هتل</th>
                                <th>تشریفات</th>
                                <th>وضعیت</th>
                                <th>عملیات</th>
                                </thead>
                                <tbody>

                                @foreach ($items as $item)
                                    <tr>
                                        <td>{{ $item->place ? $item->place->name : '---' }}</td>
                                        <td>{{ \Hekmatinasser\Verta\Verta:: instance($item->date)->format('%B %d، %Y') }}</td>
                                        <td>{{ $item->start_time }}</td>
                                        <td>{{ $item->guest_count }}</td>
                                        <td>{{ number_format($item->amount) }}</td>
                                        <td>
                                            {{  $item->get_type() }}
                                        </td>
                                        <td>{{ $item->hotel_room ? $item->hotel_room->title : 'ندارد' }}</td>
                                        <td>
                                            {{  $item->get_option_names() ?: '---' }}
                                        </td>
                                        <td>

                                <span wire:click="$emit('triggerChangeStatusModal' , {{ $item }})"
                                      class="label_mouse_cursor label label-{{ $item->status ? 'success' : 'danger' }}-border rounded">
                                    @if($item->status)
                                        فعال
                                    @else
                                        غیر فعال
                                    @endif
                                </span>

                                        </td>

                                        <td style="padding-right: 0 !important; text-align: center !important;">
                                            <button
                                                id="id_button_"
                                                class="btn btn-danger"> کنسل
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                        <div class="step">
                        </div>
                    </div>
                </div>
                <!-- /col -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
</div>


