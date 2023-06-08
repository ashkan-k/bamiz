<div class="row">
    <div class="col-xs-12">
        <div class="col-lg-12">
            <div class="card-box">
                <h2 class="card-title"><b>{{ $titlePage }}</b></h2>

                <form class="form-horizontal"
                      action="{{ $type == 'edit' ? route('reserves.update' , $item->id) : route('reserves.store') }}"
                      method="post"
                      enctype="multipart/form-data">

                    @if($type == 'edit')
                        @method('PATCH')
                    @endif

                    @csrf

                    <div class="form-group" wire:ignore>
                        <label class="control-label col-lg-2">کاربر</label>
                        <div class="col-md-10">

                            <select id="id_user" required class="form-control" name="user_id">

                                <option value="">کاربر را انتخاب کنید</option>

                                @foreach($users as $user)
                                    <option @if(old('user_id')) @if(old('user_id') == $user->id ) selected
                                            @endif @elseif(isset($item->user_id) && $item->user_id == $user->id) selected
                                            @endif value="{{ $user->id }}">{{ $user->fullname() }}
                                    </option>
                                @endforeach
                            </select>

                            @error('user_id')
                            <span class="text-danger text-wrap">{{ $message }}</span>
                            @enderror

                        </div>
                    </div>


                    <div class="form-group" wire:ignore>
                        <label class="control-label col-lg-2">مرکز</label>
                        <div class="col-md-10">

                            <select id="id_place" required class="form-control" name="place_id">

                                <option value="">مرکز را انتخاب کنید</option>

                                @foreach($places as $place)
                                    <option @if(old('place_id')) @if(old('place_id') == $place->id ) selected
                                            @endif @elseif(isset($item->place_id) && $item->place_id == $place->id) selected
                                            @endif value="{{ $place->id }}" value="{{ $place->id }}">{{ $place->name }}
                                    </option>
                                @endforeach
                            </select>

                            @error('place_id')
                            <span class="text-danger text-wrap">{{ $message }}</span>
                            @enderror

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">مناسبت (موضوع رزرو)</label>
                        <div class="col-md-10">

                            <select id="id_type" required class="form-control" name="type">

                                <option value="">مناسبت را انتخاب کنید</option>

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

                    <div class="form-group">
                        <label class="control-label col-lg-2">تاریخ</label>
                        <div class="col-md-10">
                            <input id="id_date" required type="text" name="date"
                                   class="form-control"
                                   placeholder=" تاریخ را وارد کنید"
                                   value="@if(old('date')){{ old('date') }}@elseif(isset($item->date)){{ $item->date }}@endif">

                            @error('date')
                            <span class="text-danger text-wrap">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">زمان شروع</label>
                        <div class="col-md-10">
                            <input id="id_start_time" required type="text" name="start_time"
                                   class="form-control" autocomplete="off"
                                   placeholder=" زمان شروع را وارد کنید"
                                   value="@if(old('start_time')){{ old('start_time') }}@elseif(isset($item->start_time)){{ $item->start_time }}@endif">

                            @error('start_time')
                            <span class="text-danger text-wrap">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">زمان پایان</label>
                        <div class="col-md-10">
                            <input id="id_end_time" type="text" name="end_time"
                                   class="form-control" autocomplete="off"
                                   placeholder=" زمان پایان را وارد کنید"
                                   value="@if(old('end_time')){{ old('end_time') }}@elseif(isset($item->end_time)){{ $item->end_time }}@endif">

                            @error('end_time')
                            <span class="text-danger text-wrap">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">تعداد مهمانان</label>
                        <div class="col-md-10">
                            <input required type="text" name="guest_count"
                                   class="form-control"
                                   placeholder="تعداد مهمانان را وارد کنید"
                                   value="@if(old('guest_count')){{ old('guest_count') }}@elseif(isset($item->guest_count)){{ $item->guest_count }}@endif">

                            @error('guest_count')
                            <span class="text-danger text-wrap">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">تشریفات ویژه (اختیاری)</label>
                        <div class="col-md-10">

                            <select id="id_option" class="form-control" name="option_id[]"
                                    multiple data-live-search="true">

                                @foreach($options as $option)
                                    <option
                                        @if(count(old('option_id', []))) @if(in_array($option->id, old('option_id'))) selected
                                        @endif @elseif(isset($item) && count($item->options_pluck_ids()) > 0 && in_array($option->id, $item->options_pluck_ids())) selected
                                        @endif value="{{ $option->id }}" value="{{ $option->id }}">{{ $option->title }}
                                    </option>
                                @endforeach

                            </select>

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">قیمت رزرو (تومان)</label>
                        <div class="col-md-10">
                            <input required type="number" name="amount"
                                   class="form-control"
                                   placeholder="قیمت را وارد کنید"
                                   value="@if(old('amount')){{ old('amount') }}@elseif(isset($item->amount)){{ $item->amount }}@endif">

                            @error('amount')
                            <span class="text-danger text-wrap">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="m-1-25 m-b-20">
                            <div class="modal-footer">
                                <a href="{{ route('reserves.index') }}"
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
    <script>
        kamaDatepicker('id_date', {
            placeholder: 'تاریخ',
            buttonsColor: 'blue',
            markHolidays: true
        });
        $("#id_date").attr('autocomplete', 'off');

        $('#id_date').on('change', function () {
            $('#id_date').val($('#id_date').val().replaceAll('/', '-'))
        });

        $(document).ready(function () {
            $("#id_start_time").timepicker();
            $("#id_end_time").timepicker();
        });
    </script>
    <script>
        $('#id_user').select2();
        $('#id_place').select2();
        $('#id_option').select2();
    </script>
@endsection

@push("StackScript")



@endpush
