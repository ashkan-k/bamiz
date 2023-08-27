<div class="row">
    <div class="col-xs-12">
        <div class="col-lg-12">
            <div class="card-box">
                <h2 class="card-title"><b>{{ $titlePage }}</b></h2>

                <form class="form-horizontal"
                      action="{{ $type == 'edit' ? route('menus.update' , $item->id) : route('menus.store') }}"
                      method="post"
                      enctype="multipart/form-data">

                    @if($type == 'edit')
                        @method('PATCH')
                    @endif

                    @csrf

                    <input type="hidden" name="place_id" value="{{ request('place_id') }}">
                    <input type="hidden" name="next_url" value="{{ request('next_url') }}">

                    <div class="form-group">
                        <label class="control-label col-lg-2">عکس</label>
                        <div class="col-sm-10">

                            <input type="file" name="images[]" multiple
                                   class="form-control"
                                   placeholder="عکس را وارد کنید"
                                   value="{{ old('images') }}">

                            @error('images.*')
                            <span class="text-danger text-wrap">{{ $message }}</span>
                            @enderror

                            @error('images')
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
                                <a href="{{ request('next_url') }}"
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
        $('#id_city').select2();

        $(document).ready(function () {
            window.initSelectCompanyDrop = () => {
                $('#id_province').select2();
            }
            initSelectCompanyDrop();
            $('#id_province').on('change', function (e) {
                Livewire.emit('ProvinceChangeListener', e.target.value)
            });
            window.livewire.on('select2', () => {
                initSelectCompanyDrop();
            });

        });
    </script>
@endsection

@push("StackScript")



@endpush
