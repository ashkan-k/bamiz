<div class="row">
    <div class="col-xs-12">
        <div class="col-lg-12">
            <div class="card-box">
                <h2 class="card-title"><b>{{ $titlePage }}</b></h2>

                <form class="form-horizontal"
                      action="{{ $type == 'edit' ? route('settings.update' , $item->id) : route('settings.store') }}"
                      method="post"
                      enctype="multipart/form-data">

                    @if($type == 'edit')
                        @method('PATCH')
                    @endif

                    @csrf

                    <div class="form-group">
                        <label class="control-label col-lg-2">کلید</label>
                        <div class="col-md-10">
                            <input id="key" type="text" name="key"
                                   class="form-control" required
                                   placeholder="نام را وارد کنید"
                                   value="@if(old('key')){{ old('key') }}@elseif(isset($item->key)){{ $item->key }}@endif">

                            @error('key')
                            <span class="text-danger text-wrap">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group" wire:ignore>
                        <label class="control-label col-lg-2">مقدار</label>
                        <div class="col-md-10">
                                <textarea id="id_value" type="text" name="value"
                                          class="form-control" required rows="8"
                                          placeholder="مقدار را وارد کنید">@if(old('value')){{ old('value') }}@elseif(isset($item->value)){{ $item->value }}@endif</textarea>

                            @error('value')
                            <span class="text-danger text-wrap">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="m-1-25 m-b-20">
                            <div class="modal-footer">
                                <a href="{{ route('settings.index') }}"
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
        CKEDITOR.replace('id_value');
    </script>
@endsection

@push("StackScript")



@endpush
