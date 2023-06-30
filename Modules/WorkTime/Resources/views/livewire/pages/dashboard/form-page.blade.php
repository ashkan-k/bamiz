<div class="row">
    <div class="col-xs-12">
        <div class="col-lg-12">
            <div class="card-box">
                <h2 class="card-title"><b>{{ $titlePage }}</b></h2>

                <form class="form-horizontal"
                      action="{{ $type == 'edit' ? route('worktimes.update' , $item->id) : route('worktimes.store') }}"
                      method="post"
                      enctype="multipart/form-data">

                    @if($type == 'edit')
                        @method('PATCH')
                    @endif

                    @csrf

                    <input type="hidden" name="next_url" value="{{ request('next_url') }}">

                    @if(isset($place))
                        <input type="hidden" name="place_id" value="{{ $place->id }}">
                    @else
                        <div class="form-group" wire:ignore>
                            <label class="control-label col-lg-2">مرکز</label>
                            <div class="col-md-10">

                                <select id="id_place_id" required class="form-control" name="place_id">

                                    <option value="">مرکز را انتخاب کنید</option>

                                    @foreach($places as $place)

                                        <option
                                            @if((isset($item->place_id) && $item->place_id == $place->id) || (old('place_id') == $place->id)) selected
                                            @endif value="{{ $place->id }}">{{ $place->name }}
                                        </option>

                                    @endforeach

                                </select>

                                @error('place_id')
                                <span class="text-danger text-wrap">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    @endif

                    <div class="form-group" wire:ignore>
                        <label for="id_week_days" class="control-label col-lg-2">روز های هفته</label>
                        <div class="col-lg-10">
                            <select required name="week_days[]" id="id_week_days"
                                    class="form-control" multiple data-live-search="true">
                                <option @if((isset($item->week_days) && in_array('شنبه', $item->week_days))) selected
                                        @endif value="شنبه">شنبه
                                </option>
                                <option @if((isset($item->week_days) && in_array('یکشنبه', $item->week_days))) selected
                                        @endif value="یکشنبه">یکشنبه
                                </option>
                                <option @if((isset($item->week_days) && in_array('دو شنبه', $item->week_days))) selected
                                        @endif value="دو شنبه">دو شنبه
                                </option>
                                <option @if((isset($item->week_days) && in_array('سه شنبه', $item->week_days))) selected
                                        @endif value="سه شنبه">سه شنبه
                                </option>
                                <option
                                    @if((isset($item->week_days) && in_array('چهار شنبه', $item->week_days))) selected
                                    @endif value="چهار شنبه">چهار شنبه
                                </option>
                                <option
                                    @if((isset($item->week_days) && in_array('پنچ شنبه', $item->week_days))) selected
                                    @endif value="پنچ شنبه">پنچ شنبه
                                </option>
                                <option @if((isset($item->week_days) && in_array('جمعه', $item->week_days))) selected
                                        @endif value="جمعه">جمعه
                                </option>
                            </select>

                            @error('week_days')
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

                    <div class="col-lg-12">
                        <div class="m-1-25 m-b-20">
                            <div class="modal-footer">
                                <a href="{{ route('worktimes.index') }}"
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
        $(document).ready(function () {
            $("#id_start_time").timepicker();
            $("#id_end_time").timepicker();
        });
    </script>
    <script>
        $('#id_place_id').select2();
        $('#id_week_days').select2();
    </script>
@endsection

@push("StackScript")



@endpush
