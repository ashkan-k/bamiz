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
        @charset "utf-8";

        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            font-family: Vazir, serif;
        }

        html {
            font-size: 10px;
        }

        #app {
            width: 100%;
            height: 100%;
        }

        input {
            text-align: right;
            direction: rtl;
            border: 0;
            margin: 10px;
        }

        textarea:focus,
        input:focus {
            outline: none;
        }

        .map_container {
            color: rgba(0, 0, 0, 0.7);
            background-color: rgba(255, 255, 255, 0);
            direction: rtl;
            text-align: right;
            font-size: 1.4rem;
        }

        .search-box {
            position: absolute;
            /*top: 5px;*/
            /*right: 5px;*/
            z-index: 1000;
            min-width: 250px;
            max-width: 300px;
            margin-top: 0 !important;
        }

        .search-box__item {
            background-color: white;
            margin-top: 3px;
            border-top: none;
            border: 1px solid #a8a7a7;
            border-radius: 5px;
        }

        .search-results {
            overflow: auto;
            max-height: 40vh;
            display: none;
        }

        .search-result-item {
            border-bottom: 1px solid #ccc;
            padding: 10px;
            cursor: pointer;
        }

        .search-result-item img {
            width: 20px;
            margin-left: 5px;
        }

        .search-result-item-title {
            font-weight: bolder;
        }

        .search-result-item-address {
            font-size: 1rem;
        }

        .clear-seach {
            cursor: pointer;
            position: absolute;
            left: 40px;
            padding: 10px;
            display: none;
        }

        .btn-seach {
            background-color: #ff0871;
            height: 41px;
            width: 35px;
            text-align: center;
            border-top-left-radius: 5px;
            border-bottom-left-radius: 5px;
            color: white;
            cursor: pointer;
            position: absolute;
            left: 1px;
            justify-content: center;
            align-items: center;
            padding: 5px;
            border-right: 1px solid #a8a7a7;
        }

        .flex-row {
            display: flex;
            flex-direction: row;
        }
    </style>
@endsection

<div class="row">
    <div class="col-xs-12">
        <div class="col-lg-12">
            <div class="card-box">
                <h2 class="card-title"><b>{{ $titlePage }}</b></h2>

                <form class="form-horizontal"
                      action="{{ $type == 'edit' ? route('places.update' , $item->id) : route('places.store') }}"
                      method="post"
                      enctype="multipart/form-data">

                    @if($type == 'edit')
                        @method('PATCH')
                    @endif

                    @csrf

                    <div class="form-group">
                        <label class="control-label col-lg-2">نام مرکز</label>
                        <div class="col-md-10">
                            <input id="name" type="text" name="name"
                                   class="form-control" required
                                   placeholder="نام را وارد کنید"
                                   value="@if(old('name')){{ old('name') }}@elseif(isset($item->name)){{ $item->name }}@endif">

                            @error('name')
                            <span class="text-danger text-wrap">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">نامک (کد مرکز)</label>
                        <div class="col-md-10">
                            <input id="slug" type="text" name="slug"
                                   class="form-control"
                                   placeholder="نامک (کد مرکز) را وارد کنید"
                                   value="@if(old('slug')){{ old('slug') }}@elseif(isset($item->slug)){{ $item->slug }}@endif">

                            @error('slug')
                            <span class="text-danger text-wrap">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group" wire:ignore>
                        <label class="control-label col-lg-2">توضیحات مرکز</label>
                        <div class="col-md-10">
                                <textarea id="id_description" type="text" name="description"
                                          class="form-control" required rows="8"
                                          placeholder="توضیحات را وارد کنید">@if(old('description')){{ old('description') }}@elseif(isset($item->description)){{ $item->description }}@endif</textarea>

                            @error('description')
                            <span class="text-danger text-wrap">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">تعداد صندلی های هر میز مرکز</label>
                        <div class="col-md-10">
                            <input id="chairs_people_count" type="text" name="chairs_people_count"
                                   class="form-control" required
                                   placeholder="تعداد صندلی ها را وارد کنید"
                                   value="@if(old('chairs_people_count')){{ old('chairs_people_count') }}@elseif(isset($item->chairs_people_count)){{ $item->chairs_people_count }}@else 1 @endif">

                            @error('chairs_people_count')
                            <span class="text-danger text-wrap">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">تخفیف (درصد)</label>
                        <div class="col-md-10">
                            <input id="food_discount" type="number" name="food_discount"
                                   class="form-control"
                                   placeholder="تخفیف را وارد کنید"
                                   value="@if(old('food_discount')){{ old('food_discount') }}@elseif(isset($item->food_discount)){{ $item->food_discount }}@endif">

                            @error('food_discount')
                            <span class="text-danger text-wrap">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    @if(auth()->user()->is_staff())
                        <div class="form-group" wire:ignore>
                            <label class="control-label col-lg-2">مدیر مرکز</label>
                            <div class="col-md-10">

                                <select id="id_user" class="form-control" name="user_id" required>

                                    @foreach($users as $user)

                                        <option @if(isset($item->user_id) && $item->user_id == $user->id) selected
                                                @endif value="{{ $user->id }}">{{ $user->fullname() }}
                                        </option>

                                    @endforeach

                                </select>

                                @error('user_id')
                                <span class="text-danger text-wrap">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    @endif

                    <div class="form-group">
                        <label class="control-label col-lg-2">نوع مرکز</label>
                        <div class="col-md-10">

                            <select id="id_type" class="form-control" name="type" required>
                                <option value="">نوع مرکز را انتخاب کنید</option>

                                @foreach($types as $type)
                                    <option @if(old('type')) @if(old('type') == $type['id'] ) selected
                                            @endif @elseif(isset($item->type) && $item->type == $type['id']) selected
                                            @endif value="{{ $type['id'] }}"
                                            value="{{ $type['id'] }}">{{ $type['name'] }}
                                    </option>
                                @endforeach

                            </select>

                            @error('type')
                            <span class="text-danger text-wrap">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    @if(auth()->user()->is_staff())
                        <div class="form-group">
                            <label class="control-label col-lg-2">دسته بندی</label>
                            <div class="col-md-10">

                                <select class="form-control" name="category_id" required>

                                    @foreach($categories as $category)

                                        <option
                                            @if(isset($item->category_id) && $item->category_id == $category->id) selected
                                            @endif value="{{ $category->id }}">{{ $category->title }}
                                        </option>

                                    @endforeach

                                </select>

                                @error('category_id')
                                <span class="text-danger text-wrap">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    @endif

                    <div class="form-group" id="id_extra_person_fee_box">
                        <label class="control-label col-lg-2">هزینه هر نفر اضافه</label>
                        <div class="col-md-10">
                            <input id="id_minor_min_age" type="number" name="minor_min_age"
                                   placeholder="هزینه هر نفر اضافه را وارد کنید"
                                   value="@if(old('minor_min_age')){{ old('minor_min_age') }}@elseif(isset($item->minor_min_age)){{ $item->minor_min_age }}@endif"
                                   class="form-control">

                            @error('minor_min_age')
                            <span class="text-danger text-wrap">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group" id="id_minor_min_age_box" style="display: none !important;">
                        <label class="control-label col-lg-2">حداکثر سن خردسالان</label>
                        <div class="col-md-10">
                            <input id="id_extra_person_fee" type="number" name="extra_person_fee"
                                   placeholder="حداکثر سن خردسالان را وارد کنید"
                                   value="@if(old('extra_person_fee')){{ old('extra_person_fee') }}@elseif(isset($item->extra_person_fee)){{ $item->extra_person_fee }}@endif"
                                   class="form-control">

                            @error('extra_person_fee')
                            <span class="text-danger text-wrap">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group" wire:ignore>
                        <label class="control-label col-lg-2">استان</label>
                        <div class="col-md-10">

                            <select id="id_province" class="form-control" name="province_id" required>

                                <option value="">استان را انتخاب کنید</option>

                                @foreach($provinces as $province)

                                    <option
                                        @if(isset($item->province_id) && $item->province_id == $province->id) selected
                                        @endif value="{{ $province->id }}">{{ $province->title }}
                                    </option>

                                @endforeach

                            </select>

                            @error('province_id')
                            <span class="text-danger text-wrap">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">شهر</label>
                        <div class="col-md-10">

                            <select id="id_city" class="form-control" name="city_id" required>

                                <option value="">شهر را انتخاب کنید</option>

                                @foreach($cities as $city)

                                    <option @if(isset($item->city_id) && $item->city_id == $city->id) selected
                                            @endif value="{{ $city->id }}">{{ $city->title }}
                                    </option>

                                @endforeach

                            </select>

                            @error('city_id')
                            <span class="text-danger text-wrap">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-lg-2">قوانین و مقررات مرکز</label>
                        <div class="col-md-10">
                                <textarea type="text" name="terms" id="id_terms"
                                          class="form-control" required rows="6"
                                          placeholder="قوانین و مقررات مرکز را وارد کنید">@if(old('terms')){{ old('terms') }}@elseif(isset($item->terms)){{ $item->terms }} @else @if($item->type == 'hotel')<ul>
                                    <li>خردسال زیر ۲ سال رایگان</li>
                                    <li>لغو تا ۲۴ ساعت کل هزینه یک شب </li>
                                    <li>لغو تا ۴۸ساعت ۵۰ درصد یک شب</li>
                                    <li>لغوتا ۷۲ ساعت ۳۰ درصد</li>
                                    <li>پذیرش زوج فقط با مدارک محرمیت</li>
                                    </ul> @else <ul>
                                    <li>کنسلی کمتر از 24 ساعت قبل از ورود مهمان مصادف با 100 درصد جریمه است.</li>
                                    <li>رعایت نظم در محیط کافه و رستوران الزامی است.</li>
                                    <li>رعایت حجاب اسلامی در محیط کافه و رستوران الزامی است.</li>
                                    </ul>@endif @endif</textarea>

                            @error('terms')
                            <span class="text-danger text-wrap">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    @if(auth()->user()->is_staff())

                        <div class="form-group">
                            <label class="control-label col-lg-2">آدرس پوشه تور مجازی</label>
                            <div class="col-md-10">
                                <textarea id="id_tour_link" type="text" name="tour_link"
                                          class="form-control" required rows="4"
                                          placeholder="آدرس پوشه تور مجازی را وارد کنید">@if(old('tour_link')){{ old('tour_link') }}@elseif(isset($item->tour_link)){{ $item->tour_link }}@endif</textarea>

                                @error('tour_link')
                                <span class="text-danger text-wrap">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-2">فایل گیف تور مجازی</label>
                            <div class="col-sm-10">

                                <input type="file" name="tour_gif"
                                       class="form-control"
                                       placeholder="فایل گیف تور مجازی را وارد کنید"
                                       value="{{ old('tour_gif') }}">

                                @error('tour_gif')
                                <span class="text-danger text-wrap">{{ $message }}</span>
                                @enderror

                                @if(isset($item) && $item->tour_gif)
                                    <div class="row">
                                        <br>
                                        <a href="{{ $item->tour_gif }}" target="_blank" class="btn btn-warning">
                                            مشاهده فایل
                                        </a>
                                    </div>
                                @endif
                            </div>

                        </div>

                    @endif

                    <div class="form-group">
                        <label class="control-label col-lg-2">عکس منوی غذا</label>
                        <div class="col-sm-10">

                            <input type="file" name="menu_image"
                                   class="form-control"
                                   placeholder="عکس منوی غذا را وارد کنید"
                                   value="{{ old('menu_image') }}">

                            @error('menu_image')
                            <span class="text-danger text-wrap">{{ $message }}</span>
                            @enderror

                            @if(isset($item) && $item->menu_image)
                                <div class="row">
                                    <br>
                                    @foreach( $item->menu_image['images'] as $key => $image)
                                        <div class="col-sm-2 col-xs-10 "
                                             style="border-radius: 20px;box-shadow: 5px 10px 18px rgba(32,32,32,0.55); margin-right: 30px ; margin-top: 30px">
                                            <label class="control-label">
                                                {{ $key }}
                                                <input required type="radio" name="imagesThumb"
                                                       value="{{ $image }}" {{ $item->menu_image['thumb'] == $image ? 'checked' : '' }} />
                                                <a href="{{ $image }}" target="_blank"><img
                                                        style="border-radius: 20px; margin-bottom: 8px;"
                                                        src="{{ $image }}" width="100%"></a>
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>

                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">عکس</label>
                        <div class="col-sm-10">

                            <input type="file" name="cover"
                                   class="form-control"
                                   placeholder="عکس را وارد کنید"
                                   value="{{ old('cover') }}">

                            @error('cover')
                            <span class="text-danger text-wrap">{{ $message }}</span>
                            @enderror

                            @if(isset($item) && $item->cover)
                                <div class="row">
                                    <br>
                                    @foreach( $item->cover['images'] as $key => $image)
                                        <div class="col-sm-2 col-xs-10 "
                                             style="border-radius: 20px;box-shadow: 5px 10px 18px rgba(32,32,32,0.55); margin-right: 30px ; margin-top: 30px">
                                            <label class="control-label">
                                                {{ $key }}
                                                <input required type="radio" name="imagesThumb"
                                                       value="{{ $image }}" {{ $item->cover['thumb'] == $image ? 'checked' : '' }} />
                                                <a href="{{ $image }}" target="_blank"><img
                                                        style="border-radius: 20px; margin-bottom: 8px;"
                                                        src="{{ $image }}" width="100%"></a>
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>

                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">بنر</label>
                        <div class="col-sm-10">

                            <input type="file" name="banner"
                                   class="form-control"
                                   placeholder="بنر را وارد کنید"
                                   value="{{ old('banner') }}">

                            @error('banner')
                            <span class="text-danger text-wrap">{{ $message }}</span>
                            @enderror

                            @if(isset($item) && $item->banner)
                                <div class="row">
                                    <br>
                                    <div class="col-sm-2 col-xs-10 "
                                         style="border-radius: 20px;box-shadow: 5px 10px 18px rgba(32,32,32,0.55); margin-right: 30px ; margin-top: 30px">
                                        <label class="control-label">
                                            <a href="{{ $item->banner }}" target="_blank"><img
                                                    style="border-radius: 20px; margin-bottom: 8px;"
                                                    src="{{ $item->banner }}" width="100%"></a>
                                        </label>
                                    </div>
                                </div>
                            @endif
                        </div>

                    </div>

                    <div class="form-group" wire:ignore
                         style="width: 100% !important; height: 500px !important; @if(isset($item)) margin-top: 80px @else margin-top: 50px @endif !important; overflow: hidden !important;">
                        <label class="control-label col-lg-2">آدرس روی نقشه</label>
                        <div class="col-md-10" style="margin-top: 30px !important;">
                            <div class="map_container search-box">
                                <div class="map_container search-box__item  flex-row">
                                    <input autocomplete="off" type="text" id="search"
                                           placeholder="دنبال کجا می&zwnj;گردید..."/><span
                                        class="clear-seach">&#10006;</span>
                                    <div class="btn-seach">
                                        <span>برو</span>
                                    </div>
                                </div>
                                <div class="map_container search-box__item search-results">
                                    <div class="search-result-item"></div>
                                </div>
                            </div>
                            <div id="app" style="width: 100% !important; height: 500px !important;"></div>
                        </div>

                        @error('address_lat')
                        <span class="text-danger text-wrap">{{ $message }}</span>
                        @enderror

                        @error('address_long')
                        <span class="text-danger text-wrap">{{ $message }}</span>
                        @enderror
                    </div>

                    <input type="hidden" id="id_address_lat" name="address_lat" value="">
                    <input type="hidden" id="id_address_long" name="address_long" value="">

                    <div class="col-lg-12">
                        <div class="m-1-25 m-b-20">
                            <div class="modal-footer">
                                <a href="{{ route('places.index') }}"
                                   class="btn btn-danger btn-border-radius waves-effect">
                                    بازگشت
                                </a>
                                <button class="btn btn-info btn-border-radius waves-effect" type="submit">ثبت</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

@section('Scripts')
    <script type="text/javascript" src="https://cdn.map.ir/web-sdk/1.4.2/js/mapp.env.js"></script>
    <script type="text/javascript" src="https://cdn.map.ir/web-sdk/1.4.2/js/mapp.min.js"></script>

    <script>
        CKEDITOR.replace('id_description');
        CKEDITOR.replace('id_terms');
    </script>

    <script>
        $('#id_user').select2();
        // $('#id_city').select2();

        $(document).ready(function () {
            window.initSelectCompanyDrop = () => {
                $('#id_province').select2();
            }
            initSelectCompanyDrop();
            $('#id_province').on('change', function (e) {
                Livewire.emit('ProvinceChangeListener', e.target.value)
            });
            window.livewire.on('select2', () => {
                initSelectCompanyDrop();
            });

        });
    </script>

    <script>
        $(document).ready(function () {
            @if($item->type == 'hotel')
            $('#id_minor_min_age_box').show();
            // $('#id_extra_person_fee_box').show();
            @endif

            $("#id_type").change(function () {
                var selected_type = $('#id_type').find(":selected").val();
                if (selected_type == 'hotel') {
                    $('#id_minor_min_age_box').show();
                    // $('#id_extra_person_fee_box').show();
                } else {
                    $('#id_minor_min_age_box').hide();
                    // $('#id_extra_person_fee_box').hide();
                }
            });
        });
    </script>

    <script type="module">
        $(document).ready(function () {
            var API_KEY = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjkxODM2YTc4YjQ1MWY1ODk5NmE1NTM2MmNiYmFjZmFiZGRmYTY5MzQzN2YxNDUzOTNmN2Q2MWE1MjI3ZmViNTRmYmI2OTM4ZmM5YWMyYTkyIn0.eyJhdWQiOiIyMjk0MSIsImp0aSI6IjkxODM2YTc4YjQ1MWY1ODk5NmE1NTM2MmNiYmFjZmFiZGRmYTY5MzQzN2YxNDUzOTNmN2Q2MWE1MjI3ZmViNTRmYmI2OTM4ZmM5YWMyYTkyIiwiaWF0IjoxNjg4MTQ1NzA4LCJuYmYiOjE2ODgxNDU3MDgsImV4cCI6MTY5MDczNzcwOCwic3ViIjoiIiwic2NvcGVzIjpbImJhc2ljIl19.lA2hR9BeYbGBvk0APHQR2goL78g40sNGIuRICJumxLY2J33UQzamiHQaAk_DJNYaHLZjfDqG8toL3sg7ayWaeOlmkB-WnqS2iAaepdAwG_JX98-ciY6kn8amIwpUGHD8q7DYMfZvTZojjIGXOKTjjQhJDVwl53G86vJEpelC4_Zy-Lobydel2IDvW39MPifL3tkNIMnA-cwAlXz83HyGTMDYN987cqI7FXtaFsgo6Qf6KjDNERKE3br67sTifkZTPagM30CUQZebLTWDK1aDWuBa2L3HvnC_ux4V1SPVlrWaM-hx7peKcieHXgOJEfSA2Bvf3XlAXYE-tM8LeJLW0A';

            //create map and layers
            var app = new Mapp({
                element: '#app',
                presets: {
                    latlng: {
                        @if(isset($item->address_lat))
                        lat: '{{ $item->address_lat }}',
                        @else
                        lat: 35.73249,
                        @endif

                            @if(isset($item->address_long))
                        lng: '{{ $item->address_long }}',
                        @else
                        lng: 51.42268,
                        @endif
                    },

                    @if(isset($item->address_lat) && isset($item->address_long))
                    zoom: 16
                    @else
                    zoom: 7
                    @endif
                },
                apiKey: API_KEY
            });

            app.addVectorLayers();

            var drawnMarker = new L.LayerGroup();

            app.map.addLayer(drawnMarker);

            // Show selected location as a marker
            @if(isset($item->address_lat) && isset($item->address_long))
            ShowMarker(app, '{{ $item->address_lat }}', '{{ $item->address_long }}');
            @endif

            //search object
            const search = {
                params: {
                    text: null
                },
                search: function (options, calback) {
                    if (options.text === null || options.text === '') {
                        return null;
                    }
                    //prepare data
                    const data = {};
                    for (let key in options) {
                        if (options[key] !== null && options[key] !== '') {
                            data[key] = options[key];
                        }
                    }
                    calback(null); ///show results
                    $.ajax({
                        url: `https://map.ir/search/v2/`,
                        data: JSON.stringify(data),
                        method: 'POST',
                        beforeSend: function (request) {
                            request.setRequestHeader('x-api-key', API_KEY);
                            request.setRequestHeader('content-type', 'application/json');
                        },
                        success: function (data, status) {
                            calback(data); ///show results
                        },
                        error: function (error) {
                            calback({'odata.count': 0, value: []}); /// show results
                        }
                    });
                },
                setParams: function (key, value, onUpdate, calback) {
                    this.params[key] = value;
                    if (onUpdate) {
                        this.search(this.params, calback);
                    }
                }
            };

            function showResults(results) {
                if (results === null) {
                    $('.search-results').text('در حال جستجو...');
                    $('.search-results').show();
                } else {
                    let count = results['odata.count'];
                    if (count > 0) {
                        $('.clear-seach').show();
                        let html = '';
                        results['value'].forEach(function (item, index) {
                            html += `<div data-title="${item.title}" data-address="${
                                item.address
                            }" data-lat="${item.geom.coordinates[1]}" data-lon="${
                                item.geom.coordinates[0]
                            }" class="search-result-item">`;
                            html += `<p class="search-result-item-title"><img src="https://map.ir/css/images/marker-default-white.svg"/>${
                                item.title
                            }</p>`;
                            html += `<p class="search-result-item-address">${item.address}</p>`;
                            html += `</div>`;
                        });
                        //show results
                        $('.search-results').html(html);
                        $('.search-result-item').on('click', function (e) {
                            let lat = e.currentTarget.getAttribute('data-lat');
                            let lng = e.currentTarget.getAttribute('data-lon');
                            let title = e.currentTarget.getAttribute('data-title');
                            let address = e.currentTarget.getAttribute('data-address');

                            ShowMarker(app, parseFloat(lat), parseFloat(lng));

                            app.map.flyTo({
                                lat,
                                lng
                            });

                            // app.addMarker({
                            //     name: 'basic-marker',
                            //     latlng: {
                            //         lat,
                            //         lng
                            //     },
                            //     popup: {
                            //         title: {
                            //             html: title
                            //         },
                            //         description: {
                            //             html: address
                            //         },
                            //         open: true
                            //     }
                            // });
                            // app.map.flyTo({
                            //     lat,
                            //     lng
                            // });
                        });
                        $('.search-results').show();
                    } else {
                        $('.clear-seach').show();
                        $('.search-results').html('<p>نتیجه ای یافت نشد</p>');
                    }
                }
            }

            // Implement location picker
            app.map.on('click', function (e) {
                // آدرس یابی و نمایش نتیجه در یک باکس مشخص
                ShowMarker(app, e.latlng.lat, e.latlng.lng);

                // برای سفارشی سازی نمایش نتیجه به جای متد بالا از متد زیر میتوان استفاده کرد

                // app.findReverseGeocode({
                //   state: {
                //     latlng: {
                //       lat: e.latlng.lat,
                //       lng: e.latlng.lng
                //     },
                //     zoom: 16
                //   },
                //   after: function(data) {
                //     app.addMarker({
                //       name: 'advanced-marker',
                //       latlng: {
                //         lat: e.latlng.lat,
                //         lng: e.latlng.lng
                //       },
                //       icon: app.icons.red,
                //       popup: {
                //         title: {
                //           i18n: 'آدرس '
                //         },
                //         description: {
                //           i18n: data.address
                //         },
                //         class: 'marker-class',
                //         open: true
                //       }
                //     });
                //   }
                // });
            });

            function ShowMarker(app, lat, long) {
                $('#id_address_lat').val(lat);
                $('#id_address_long').val(long);

                console.log('sssssssssssssss')
                console.log(app)
                console.log(lat)
                console.log(long)

                app.addMarker({
                    name: 'advanced-marker',
                    latlng: {
                        lat: lat,
                        lng: long,
                    },
                    icon: app.icons.red,
                    popup: false
                });

                app.showReverseGeocode({
                    state: {
                        latlng: {
                            lat: lat,
                            lng: long,
                        },
                        zoom: 16
                    }
                });
            }

            //clear search
            $('.clear-seach').click(function () {
                search.params = {
                    text: null
                };

                $('.search-results').html('');
                $('.search-results').hide();
                $('.clear-seach').hide();
                $('input#search').val('');
                $('.leaflet-container').css('cursor', '');

                if (app.groups.features !== undefined) {
                    app.removeMarkers({
                        group: app.groups.features.markers
                    });
                }
                drawnMarker.clearLayers();
            });

            //text change event handling
            $('#search').on('keyup paste', function (e) {
                let text = $('input#search').val();
                if (text.length > 1) {
                    search.setParams('text', text, true, showResults);
                }
            });
        });
    </script>
@endsection
