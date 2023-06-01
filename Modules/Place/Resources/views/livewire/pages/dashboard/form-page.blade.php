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
                        <label class="control-label col-lg-2">تعداد میز های مرکز</label>
                        <div class="col-md-10">
                            <input id="chairs_people_count" type="text" name="chairs_people_count"
                                   class="form-control" required
                                   placeholder="تعداد میز را وارد کنید"
                                   value="@if(old('chairs_people_count')){{ old('chairs_people_count') }}@elseif(isset($item->chairs_people_count)){{ $item->chairs_people_count }}@else 1 @endif">

                            @error('chairs_people_count')
                            <span class="text-danger text-wrap">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
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

                    <div class="form-group">
                        <label class="control-label col-lg-2">استان</label>
                        <div class="col-md-10">

                            <select wire:model="province" id="id_province" class="form-control" name="province_id" required>

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
                                <div class="input-field col s12 mt-3">
                                    <p>تصویر قبلی:</p>
                                    <a href="{{ $item->get_cover() }}" target="_blank"><img
                                            src="{{ $item->get_cover() }}"
                                            width="70"
                                            alt="{{ $item->title }}"></a>
                                </div>
                            @endif
                        </div>

                    </div>

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
    <script>
        CKEDITOR.replace('id_description');
    </script>

    <script>
        $('#id_user').select2();
        // $('#id_province').select2();
        $('#id_city').select2();
    </script>
@endsection

@push("StackScript")



@endpush
