<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            <div class="card-block">
                <h4 class="card-title">{{$titlePage}}</h4>

                @include('livewire.searchBox')

                <a class="btn btn-primary pull-right" href="{{ route('users.create') }}">افزودن کاربر جدید</a>

                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>نام کابری</th>
                        <th>نام</th>
                        <th>نام خانوادگی</th>
                        <th>ایمیل</th>
                        <th>وضعیت</th>
                        <th>تلفن</th>
                        <th>نقش</th>
                        <th>عکس</th>
                        <th>تاریخ ثبت نام</th>
                        <th>اعمال</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach ($items as $item)
                        <tr>
                            <td>{{$item->username}}</td>
                            <td>{{$item->first_name}}</td>
                            <td>{{$item->last_name}}</td>
                            <td>{{$item->email}}</td>
                            <td>

                                <span class=" @if($item->email_verified_at != null)

                                {{ "label label-success-border rounded" }}

                                @else

                                {{ "label label-danger-border rounded" }}

                                @endif">

                                    @if($item->email_verified_at != null)

                                        فعال

                                    @else

                                        غیر فعال

                                    @endif

                                </span>

                            </td>
                            <td>{{ $item->phone == null ? 'ندارد' : $item->phone }}</td>
                            <td>

                                <span class="label label-{{ $item->get_level_class() }}-border rounded">
                                    {{ $item->get_level() }}
                                </span>

                            </td>

                            <td>
                                <a href="{{ $item->get_avatar() }}" target="-_blank"><img width="50"
                                                                                          src="{{ $item->get_avatar() }}"
                                                                                          alt="عکس کابر"></a>
                            </td>

                            <td>{{ \Hekmatinasser\Verta\Verta:: instance($item->created_at)->format('%B %d، %Y') }}</td>
                            <td>
                                <div class="buttons ">
                                    <a href="{{ route('users.edit' , $item->id) }}"
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

                {{ $items->links('livewire.pagination') }}

            </div>
        </div>
    </div>
</div>

@push('StackScript')
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function () {

        @this.on('triggerDelete', orderId => {
            Swal.fire({
                title: "هشدار ! ",
                icon: 'warning',
                text: "آیا می خواهید این کابر حذف شود ؟ 🤔",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#00aced',
                cancelButtonColor: '#e6294b',
                confirmButtonText: 'تایید',
                cancelButtonText: 'انصراف'
            }).then((result) => {
                //if user clicks on delete
                if (result.value) {
                    // calling destroy method to delete
                @this.call('destroy', orderId)
                    // success response
                    Swal.fire({
                        title: session('message'),
                        icon: 'success',
                        type: 'success'
                    });

                }
            });
        });
        })
    </script>
@endpush

