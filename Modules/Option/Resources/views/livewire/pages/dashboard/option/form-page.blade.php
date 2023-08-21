<div class="row">
    <div class="col-xs-12">
        <div class="col-lg-12">
            <div class="card-box">
                <h2 class="card-title"><b>{{ $titlePage }}</b></h2>

                <form class="form-horizontal" id="id_frm"
                      action="{{ $type == 'edit' ? route('options.update' , $item->id) : route('options.store') }}"
                      method="post"
                      enctype="multipart/form-data">

                    @if($type == 'edit')
                        @method('PATCH')
                    @endif

                    @csrf

                        @if(request('place_id'))
                            <input type="hidden" name="place_id" value="{{ request('place_id') }}">
                            <input type="hidden" name="next_url"
                                   value="{{ route('option_places.index') }}?place_id={{ request('place_id') }}">
                        @endif

                    @if(!isset($item->id) && !request('place_id'))
                            <div class="form-group" wire:ignore>
                                <label class="control-label col-lg-2">مرکز</label>
                                <div class="col-md-10">

                                    <select id="id_place" class="form-control" name="place_id">
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

                    <div class="form-group" wire:ignore>
                        <label class="control-label col-lg-2">توضیحات</label>
                        <div class="col-md-10">
                                <textarea id="id_description" type="text" name="description"
                                          class="form-control" rows="8"
                                          placeholder="توضیحات را وارد کنید">@if(old('description')){{ old('description') }}@elseif(isset($item->description)){{ $item->description }}@endif</textarea>

                            @error('description')
                            <span class="text-danger text-wrap">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">ملبغ (تومان)</label>
                        <div class="col-md-10">
                            <input id="amount" type="text" name="amount"
                                   class="form-control" required
                                   placeholder="ملبغ (تومان) را وارد کنید"
                                   value="@if(old('amount')){{ old('amount') }}@elseif(isset($item->amount)){{ $item->amount }}@endif">

                            @error('amount')
                            <span class="text-danger text-wrap">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">ملبغ تخفیفی (تومان)</label>
                        <div class="col-md-10">
                            <input id="discount_amount" type="text" name="discount_amount"
                                   class="form-control"
                                   placeholder="ملبغ تخفیفی (تومان) را وارد کنید"
                                   value="@if(old('discount_amount')){{ old('discount_amount') }}@elseif(isset($item->discount_amount)){{ $item->discount_amount }}@endif">

                            @error('discount_amount')
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
                                <a href="{{ route('options.index') }}?place_id={{ request('place_id') }}"
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
        FormatInputNumberWithComma('amount', 'id_frm');
        FormatInputNumberWithComma('discount_amount', 'id_frm');

        @if(isset($item->amount))
            $('#amount').val('{{ number_format($item->amount) }}');
        @endif
        @if(isset($item->discount_amount))
            $('#discount_amount').val('{{ number_format($item->discount_amount) }}');
        @endif
    </script>

    <script>
        $('#id_place').select2();
    </script>

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
