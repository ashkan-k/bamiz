<div class="row">
    <div class="col-xs-12">
        <div class="col-lg-12">
            <div class="card-box">
                <h2 class="card-title"><b>{{ $titlePage }}</b></h2>

                <form class="form-horizontal"
                      action="{{ $type == 'edit' ? route('tickets.update' , $item->id) : route('tickets.store') }}"
                      method="post"
                      enctype="multipart/form-data">

                    @if($type == 'edit')
                        @method('PATCH')
                    @endif

                    @csrf

                    <div class="form-group">
                        <label class="control-label col-lg-2">عنوان</label>
                        <div class="col-md-10">
                            <input id="title" type="text" name="title"
                                   class="form-control" required
                                   placeholder="عنوان را وارد کنید"
                                   value="@if(old('title')){{ old('title') }}@elseif(isset($item->title)){{ $item->title }}@endif">

                            @error('title')
                            <span class="text-danger text-wrap">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">دسته بندی</label>
                        <div class="col-md-10">

                            <select id="id_ticket_category_id" class="form-control" name="ticket_category_id" required>

                                @foreach($categories as $category)

                                    <option
                                        @if(isset($category->ticket_category_id) && $category->ticket_category_id == $category->id) selected
                                        @endif value="{{ $category->id }}">{{ $category->title }}
                                    </option>

                                @endforeach

                            </select>

                            @error('ticket_category_id')
                            <span class="text-danger text-wrap">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">متن تیکت</label>
                        <div class="col-md-10">
                                <textarea id="id_text" type="text" name="text"
                                          class="form-control" required rows="8"
                                          placeholder="متن تیکت را وارد کنید">@if(old('text')){{ old('text') }}@elseif(isset($item->text)){{ $item->text }}@endif</textarea>

                            @error('text')
                            <span class="text-danger text-wrap">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">فایل</label>
                        <div class="col-sm-10">

                            <input type="file" name="file"
                                   class="form-control"
                                   placeholder="فایل را وارد کنید"
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
                                <a href="{{ route('tickets.index') }}"
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
