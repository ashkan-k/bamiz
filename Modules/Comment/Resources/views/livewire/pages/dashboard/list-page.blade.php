<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            <div class="card-block">
                <h4 class="card-title">{{$titlePage}}</h4>

                @include('livewire.searchBox')

                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>عنوان</th>
                        <th>متن</th>
                        <th>کاربر</th>
                        <th>مرکز | مقاله</th>
                        <th>لایک</th>
                        <th>وضعیت</th>
                        <th>تاریخ ثبت</th>
                        <th>اعمال</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach ($items as $item)
                        <tr>
                            <td>{{$item->title}}</td>
                            <td title="{{ $item->body }}">{{\Illuminate\Support\Str::limit($item->body , 20)}}</td>
                            <td>{{$item->user->fullname()}}</td>
                            <td>
                                {{ $item->commentable_type == 'Modules\Article\Entities\Article' ?  $item->commentable->title  :  $item->commentable->name }}
                            </td>
                            <td>{{$item->like_count}}</td>
                            <td>

                                <span wire:click="$emit('triggerChangeLevelModal' , {{ $item }})"
                                      class="label_mouse_cursor label label-{{ $item->get_status_class() }}-border rounded">
                                    {{ $item->get_status() }}
                                </span>

                            </td>
                            <td>{{ \Hekmatinasser\Verta\Verta:: instance($item->created_at)->format('%B %d، %Y') }}</td>
                            <td>
                                <div class="buttons ">
                                    <a href="{{ route('comments.edit' , $item->id) }}"
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
                text: "آیا می خواهید این آیتم حذف شود ؟ 🤔",
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

