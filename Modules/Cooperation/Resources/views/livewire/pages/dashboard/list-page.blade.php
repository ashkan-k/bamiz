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

                <a class="btn btn-primary pull-right" href="{{ route('cooperations.create') }}">افزودن درخواست همکاری
                    جدید</a>

                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>نام</th>
                        <th>نام خانوادگی</th>
                        <th>تلفن</th>
                        <th>فایل ضمیمه</th>
                        <th>تاریخ ثبت</th>
                        <th>اعمال</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach ($items as $item)
                        <tr>
                            <td>{{ $item->first_name ?: '---' }}</td>
                            <td>{{ $item->last_name ?: '---' }}</td>
                            <td>{{ $item->phone ?: '---' }}</td>
                            <td>

                                @if($item->file)
                                    <span onclick="window.open('{{ $item->get_file() }}', '_blank')"
                                          class="label_mouse_cursor label label-warning-border rounded">
                                        دانلود فایل
                                    </span>
                                @else
                                    <span class="label_mouse_cursor label label-warning-border rounded">
                                         بدون فایل
                                    </span>
                                @endif

                            </td>

                            <td>{{ \Hekmatinasser\Verta\Verta:: instance($item->created_at)->format('%B %d، %Y') }}</td>
                            <td>
                                <div class="buttons ">
                                    <a href="{{ route('cooperations.edit' , $item->id) }}"
                                       class="btn btn-primary btn-action mr-1"
                                       data-toggle="tooltip" title=""
                                       data-original-title="ویرایش"><i
                                            class="fas fa-pencil-alt"></i><i
                                            class="fa fa-pencil"> </i> </a>
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

                {{ $items->onEachSide(3)->links('livewire.pagination') }}

            </div>
        </div>
    </div>
</div>

@push('StackScript')
    @include('livewire.delete')
@endpush

