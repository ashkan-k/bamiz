<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            <div class="card-block">
                <h4 class="card-title">{{$titlePage}}</h4>

                <hr>
                <form id="search">
                    <div class="form-group">
                        <div class="row">
                            @include('livewire.filters.search_input')
                            @include('livewire.filters.limit_select_box')
                        </div>
                    </div>
                </form>

                <a class="btn btn-primary pull-right" href="{{ route('galleries.create') }}?place_id={{ $this->place_id }}&next_url={{ $full_url }}">افزودن گالری جدید</a>

                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>مرکز</th>
                        <th>عکس</th>
                        <th>اعمال</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach ($items as $item)
                        <tr>
                            <td>{{$item->place ? $item->place->name : '---'}}</td>
                            <td>
                                <a href="{{ $item->get_image() }}" target="-_blank"><img width="50"
                                                                                         src="{{ $item->get_image() }}"
                                                                                         alt="عکس"></a>
                            </td>

                            <td>
                                <div class="buttons ">
{{--                                    <a href="{{ route('galleries.edit' , $item->id) }}"--}}
{{--                                       class="btn btn-primary btn-action mr-1"--}}
{{--                                       data-toggle="tooltip" title=""--}}
{{--                                       data-original-title="ویرایش"><i--}}
{{--                                            class="fas fa-pencil-alt"></i><i--}}
{{--                                            class="fa fa-pencil"> </i> </a>--}}
                                    <button wire:click="$emit('triggerDelete' , {{ $item->id }})"
                                            type="button"
                                            data-original-title="حذف"
                                            data-toggle="tooltip"
                                            class="btn btn-danger btn-action"><i
                                            class="fa fa-trash"> </i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                {{ $items->links('livewire.pagination') }}

            </div>
        </div>
    </div>
</div>

@push('StackScript')
    @include('livewire.delete')
@endpush

