<div class="row">
    <div class="col-xs-12">
        <div class="col-lg-12">
            <div class="card-box">
                <h2 class="card-title"><b>{{ $titlePage }}</b></h2>

                <form class="form-horizontal"
                      action="{{ $type == 'edit' ? route('cooperations.update' , $item->id) : route('cooperations.store') }}"
                      method="post"
                      enctype="multipart/form-data">

                    @if($type == 'edit')
                        @method('PATCH')
                    @endif

                    @csrf

                    <div class="form-group">
                        <label class="control-label col-lg-2">نام</label>
                        <div class="col-md-10">
                            <input id="title" type="text" name="first_name"
                                   class="form-control"
                                   placeholder="نام را وارد کنید"
                                   value="@if(old('first_name')){{ old('first_name') }}@elseif(isset($item->first_name)){{ $item->first_name }}@endif">

                            @error('first_name')
                            <span class="text-danger text-wrap">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">نام خانوادگی</label>
                        <div class="col-md-10">
                            <input id="last_name" type="text" name="last_name"
                                   class="form-control"
                                   placeholder="نام خانوادگی را وارد کنید"
                                   value="@if(old('last_name')){{ old('last_name') }}@elseif(isset($item->last_name)){{ $item->last_name }}@endif">
                            @error('last_name')
                            <span class="text-danger text-wrap">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">شماره تلفن</label>
                        <div class="col-md-10">
                            <input required type="text" name="phone"
                                   class="form-control"
                                   placeholder="شماره تلفن را وارد کنید"
                                   value="@if(old('phone')){{ old('phone') }}@elseif(isset($item->phone)){{ $item->phone }}@endif">
                            @error('phone')
                            <span class="text-danger text-wrap">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">آدرس</label>
                        <div class="col-md-10">
                                <textarea id="id_address" type="text" name="address"
                                          class="form-control" required rows="8"
                                          placeholder="آدرس را وارد کنید">@if(old('address')){{ old('address') }}@elseif(isset($item->address)){{ $item->address }}@endif</textarea>

                            @error('address')
                            <span class="text-danger text-wrap">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group" wire:ignore>
                        <label class="control-label col-lg-2">توضیحات</label>
                        <div class="col-md-10">
                                <textarea id="id_description" type="text" name="description"
                                          class="form-control" required rows="8"
                                          placeholder="آدرس را وارد کنید">@if(old('description')){{ old('description') }}@elseif(isset($item->description)){{ $item->description }}@endif</textarea>

                            @error('description')
                            <span class="text-danger text-wrap">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">عکس</label>
                        <div class="col-sm-10">

                            <input type="file" name="file"
                                   class="form-control"
                                   placeholder="عکس را وارد کنید"
                                   value="{{ old('file') }}">

                            @error('file')
                            <span class="text-danger text-wrap">{{ $message }}</span>
                            @enderror

                            @if(isset($item) && $item->file)
                                <div class="input-field col s12 mt-3">
                                    <p>فایل قبلی:</p>
                                    <a class="btn btn-warning" href="{{ $item->get_file() }}" target="_blank">دانلود
                                        فایل</a>
                                </div>
                            @endif
                        </div>

                    </div>

                    <div class="col-lg-12">
                        <div class="m-1-25 m-b-20">
                            <div class="modal-footer">
                                <a href="{{ route('cooperations.index') }}"
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
        CKEDITOR.replace('id_description');
    </script>
@endsection

@push("StackScript")



@endpush
