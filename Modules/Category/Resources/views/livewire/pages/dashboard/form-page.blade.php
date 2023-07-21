<div class="row">
    <div class="col-xs-12">
        <div class="col-lg-12">
            <div class="card-box">
                <h2 class="card-title"><b>{{ $titlePage }}</b></h2>

                <form class="form-horizontal"
                      action="{{ $type == 'edit' ? route('place-categories.update' , $item->id) : route('place-categories.store') }}"
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
                                   placeholder="نام را وارد کنید"
                                   value="@if(old('title')){{ old('title') }}@elseif(isset($item->title)){{ $item->title }}@endif">

                            @error('title')
                            <span class="text-danger text-wrap">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group" wire:ignore>
                        <label class="control-label col-lg-2">والد</label>
                        <div class="col-md-10">

                            <select id="id_parent_id" class="form-control" name="parent_id">

                                <option value="">بدون والد</option>

                                @foreach($parents as $parent)

                                    <option
                                        @if(isset($item->parent_id) && $item->parent_id == $parent->id) selected
                                        @endif value="{{ $parent->id }}">{{ $parent->title }}
                                    </option>

                                @endforeach

                            </select>

                            @error('parent_id')
                            <span class="text-danger text-wrap">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">عکس</label>
                        <div class="col-sm-10">

                            <input type="file" name="image"
                                   class="form-control"
                                   placeholder="عکس را وارد کنید"
                                   value="{{ old('image') }}">

                            @error('image')
                            <span class="text-danger text-wrap">{{ $message }}</span>
                            @enderror

                            @if(isset($item) && $item->image)
                                <div class="input-field col s12 mt-3">
                                    <p>تصویر قبلی:</p>
                                    <a href="{{ $item->get_image() }}" target="_blank"><img
                                            src="{{ $item->get_image() }}"
                                            width="70"
                                            alt="{{ $item->title }}"></a>
                                </div>
                            @endif
                        </div>

                    </div>

                    <div class="col-lg-12">
                        <div class="m-1-25 m-b-20">
                            <div class="modal-footer">
                                <a href="{{ route('place-categories.index') }}"
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
        $('#id_parent_id').select2();
    </script>
@endsection
