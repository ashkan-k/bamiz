<div class="row">
    <div class="col-xs-12">
        <div class="col-lg-12">
            <div class="card-box">
                <h2 class="card-title"><b>{{ $titlePage }}</b></h2>

                <form class="form-horizontal"
                      action="{{ $type == 'edit'  ?  route('reserves.update' , $reserve_id)  :  route('reserves.store') }}"
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
                                    <option @if(isset($item->user_id) && $item->user_id == $user->id) selected
                                            @endif value="{{ $user->id }}">{{ $user->fullname() }}
                                    </option>
                                @endforeach
                            </select>

                        </div>
                    </div>


                    <div class="form-group" wire:ignore>
                        <label class="control-label col-lg-2">مرکز</label>
                        <div class="col-md-10">

                            <select id="id_place" required class="form-control" name="place_id">

                                <option value="">مرکز را انتخاب کنید</option>

                                @foreach($places as $place)
                                    <option @if(isset($item->place_id) && $item->place_id == $user->id) selected
                                            @endif value="{{ $place->id }}">{{ $place->name }}
                                    </option>
                                @endforeach
                            </select>

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">تاریخ</label>
                        <div class="col-md-10">
                            <input required type="date" name="date"
                                   class="form-control"
                                   placeholder=" تاریخ را وارد کنید"
                                   value="@if(old('date')){{ old('date') }}@elseif(isset($item->date)){{ $item->date }}@endif">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">زمان شروع</label>
                        <div class="col-md-10">
                            <input required type="time" name="start_time"
                                   class="form-control"
                                   placeholder=" زمان شروع را وارد کنید"
                                   value="@if(old('start_time')){{ old('start_time') }}@elseif(isset($item->start_time)){{ $item->start_time }}@endif">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">زمان پایان</label>
                        <div class="col-md-10">
                            <input type="time" name="end_time"
                                   class="form-control"
                                   placeholder=" زمان پایان را وارد کنید"
                                   value="@if(old('end_time')){{ old('end_time') }}@elseif(isset($item->end_time)){{ $item->end_time }}@endif">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">تعداد مهمانان</label>
                        <div class="col-md-10">
                            <input required type="text" name="guest_count"
                                   class="form-control"
                                   placeholder="تعداد مهمانان را وارد کنید"
                                   value="@if(old('guest_count')){{ old('guest_count') }}@elseif(isset($item->guest_count)){{ $item->guest_count }}@endif">
                        </div>
                    </div>

                    {{--                    <div class="form-group">--}}
                    {{--                        <label class="control-label col-lg-2">تشریفات ویژه (اختیاری)</label>--}}
                    {{--                        <div class="col-md-10">--}}

                    {{--                            <select wire:model.defer='option_id' multiple class="form-control" name="option_id[]"--}}
                    {{--                                    multiple data-live-search="true">--}}

                    {{--                                @foreach($options as $c)--}}
                    {{--                                    <option value="{{ $c->id }}">{{ $c->title }}</option>--}}
                    {{--                                @endforeach--}}

                    {{--                            </select>--}}

                    {{--                        </div>--}}
                    {{--                    </div>--}}

                    <div class="form-group">
                        <label class="control-label col-lg-2">قیمت رزرو</label>
                        <div class="col-md-10">
                            <input required type="text" name="amount"
                                   class="form-control"
                                   placeholder="قیمت را وارد کنید"
                                   value="@if(old('amount')){{ old('amount') }}@elseif(isset($item->amount)){{ $item->amount }}@endif">
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
        $('#id_user').select2();
        $('#id_place').select2();
    </script>
@endsection

@push("StackScript")



@endpush
