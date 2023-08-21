<div class="row">
    <div class="col-xs-12">
        <div class="col-lg-12">
            <div class="card-box">
                <h2 class="card-title"><b>{{ $titlePage }}</b></h2>

                <form class="form-horizontal" id="id_frm"
                      action="{{ $type == 'edit' ? route('reserve-types.update' , $item->id) : route('reserve-types.store') }}"
                      method="post"
                      enctype="multipart/form-data">

                    @if($type == 'edit')
                        @method('PATCH')
                    @endif

                    @csrf

                    <div class="form-group">
                        <label class="control-label col-lg-2">عنوان</label>
                        <div class="col-md-10">
                            <input id="id_title" required type="text" name="title"
                                   class="form-control"
                                   placeholder=" عنوان را وارد کنید"
                                   value="@if(old('title')){{ old('title') }}@elseif(isset($item->title)){{ $item->title }}@endif">

                            @error('title')
                            <span class="text-danger text-wrap">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">قیمت</label>
                        <div class="col-md-10">
                            <input id="price" type="text" name="price"
                                   class="form-control"
                                   placeholder=" قیمت را وارد کنید"
                                   value="@if(old('price')){{ old('price') }}@elseif(isset($item->price)){{ $item->price }}@endif">

                            <p class="text-danger">* اگر این طرح شامل زیر مجموعه است این فیلد را خالی بگذارید.</p>

                            @error('price')
                            <span class="text-danger text-wrap">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="m-1-25 m-b-20">
                            <div class="modal-footer">
                                <a href="{{ route('reserve-types.index') }}"
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
        FormatInputNumberWithComma('price', 'id_frm');

        @if(isset($item->price))
            $('#price').val('{{ number_format($item->price) }}');
        @endif
    </script>
@endsection
