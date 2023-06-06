<div class="row">
    <div class="col-xs-12">
        <div class="col-lg-12">
            <div class="card-box">
                <h2 class="card-title"><b>{{ $titlePage }}</b></h2>

                <form class="form-horizontal"
                      action="{{ $type == 'edit' ? route('option_places.update' , $item->id) : route('option_places.store') }}"
                      method="post"
                      enctype="multipart/form-data">

                    @if($type == 'edit')
                        @method('PATCH')
                    @endif

                    @csrf

                    <input type="hidden" name="place_id" value="{{ request('place_id') }}">
                    <input type="hidden" name="next_url" value="{{ request('next_url') }}">

                    <div class="form-group" wire:ignore>
                        <label class="control-label col-lg-2">مرکز</label>
                        <div class="col-md-10">
                            <select id="id_option_id" class="form-control" multiple name="option_id[]" >


                                @foreach($options as $option)

                                    <option
                                        @if(isset($place) && in_array($option->id, $place->options()->pluck('option_id')->toArray())) selected
                                        @endif value="{{ $option->id }}">{{ $option->title }}
                                    </option>

                                @endforeach

                            </select>

                            @error('option_id')
                            <span class="text-danger text-wrap">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="m-1-25 m-b-20">
                            <div class="modal-footer">
                                <a href="{{ route('option_places.index') }}"
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
        $('#id_option_id').select2();
    </script>
@endsection

@push("StackScript")



@endpush
