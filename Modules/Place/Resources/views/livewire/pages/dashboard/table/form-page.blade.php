<div class="row">
    <div class="col-xs-12">
        <div class="col-lg-12">
            <div class="card-box">
                <h2 class="card-title"><b>{{ $titlePage }}</b></h2>

                <form class="form-horizontal"
                      action="{{ $type == 'edit' ? route('tables.update' , $item->id) : route('tables.store') }}"
                      method="post"
                      enctype="multipart/form-data">

                    @if($type == 'edit')
                        @method('PATCH')
                    @endif

                    @csrf

                        @if(request('place_id'))
                            <input type="hidden" name="place_id" value="{{ request('place_id') }}">
                            <input type="hidden" name="next_url" value="{{ route('tables.index') }}?place_id={{ request('place_id') }}">
                        @endif

                    <div class="form-group">
                        <label class="control-label col-lg-2">نام</label>
                        <div class="col-md-10">
                            <input id="title" type="text" name="title"
                                   class="form-control" required
                                   placeholder="نام را وارد کنید"
                                   value="@if(old('title')){{ old('title') }}@elseif(isset($item->title)){{ $item->title }}@endif">

                            @error('title')
                            <span class="text-danger text-wrap">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    @if(!request('place_id'))
                        <div class="form-group" wire:ignore>
                            <label class="control-label col-lg-2">مرکز</label>
                            <div class="col-md-10">

                                <select id="id_place" class="form-control" name="place_id" required>
                                    <option value="">مرکز را انتخاب کنید</option>

                                    @foreach($places as $place)

                                        <option @if(isset($item->place_id) && $item->place_id == $place->id) selected
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

                    <div class="form-group">
                        <label class="control-label col-lg-2">برای مناسبت</label>
                        <div class="col-md-10">

                            <select class="form-control" name="reserve_type_id" required>
                                <option value="">برای مناسبت را انتخاب کنید</option>

                                @foreach($reserve_types as $reserve_type)
                                    <option
                                        @if(isset($item->reserve_type_id) && $item->reserve_type_id == $reserve_type->id) selected
                                        @endif value="{{ $reserve_type->id }}">{{ $reserve_type->title }}
                                    </option>
                                @endforeach

                            </select>

                            @error('reserve_type_id')
                            <span class="text-danger text-wrap">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">قیمت</label>
                        <div class="col-md-10">
                            <input id="price" type="number" name="price"
                                   class="form-control" required
                                   placeholder="قیمت را وارد کنید"
                                   value="@if(old('price')){{ old('price') }}@elseif(isset($item->price)){{ $item->price }}@endif">

                            @error('price')
                            <span class="text-danger text-wrap">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="m-1-25 m-b-20">
                            <div class="modal-footer">
                                <a href="{{ route('tables.index') }}?place_id={{ request('place_id') }}"
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

@push("StackScript")
    <script>
        $('#id_place').select2();
    </script>
@endpush
