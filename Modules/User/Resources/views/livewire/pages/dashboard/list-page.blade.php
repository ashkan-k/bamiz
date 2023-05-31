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

                                <span
                                    class="label label-{{ $item->email_verified_at ? 'success' : 'danger' }}-border rounded">
                                    @if($item->email_verified_at != null)
                                        فعال
                                    @else

                                        غیر فعال
                                    @endif
                                </span>

                            </td>
                            <td>{{ $item->phone == null ? 'ندارد' : $item->phone }}</td>
                            <td>

                                <span wire:click="$emit('triggerChangeLevelModal' , {{ $item }})"
                                      class="label label-{{ $item->get_level_class() }}-border rounded">
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

    <!-- Modal -->
    <div wire:ignore.self class="modal fade bd-example-modal-lg" id="changeLevelModal" tabindex="-1" role="dialog"
         aria-labelledby="changeLevelModalTitle" aria-hidden="true" dir="rtl"
         style="text-align: right !important; margin-top: 250px">
        <div class="modal-dialog modal-dialog-centered" role="document">

            <div class="modal-content">
                <div class="modal-header" style="width: 100%!important;">
                    <h5 class="modal-title"
                        id="exampleModalLongTitle">تغییر نقش</h5>

                    <button type="button" class="close ml-2" data-dismiss="modal"
                            style="position: absolute!important;left: 0!important; top: 10px"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form wire:submit.prevent="ChangeLevel">
                    <div class="modal-body">
                        <label class="form-label"
                               for="id_level">نقش:</label>

                        <div>
                            <select wire:model="current_item_level" class="form-control" name="level">

                                <option @if(isset($current_item_level) && $current_item_level == 'admin') selected
                                        @endif value="admin">مدیر
                                </option>
                                <option @if(isset($current_item_level) && $current_item_level == 'staff') selected
                                        @endif value="staff">کارمند
                                </option>
                                <option @if(isset($current_item_level) && $current_item_level == 'user') selected
                                        @endif value="user">
                                    کاربر
                                </option>
                                <option
                                    @if(isset($current_item_level) && $current_item_level == 'restaurant_manager') selected
                                    @endif value="restaurant_manager">مدیر رستوران
                                </option>

                            </select>

                            @error('level')
                            <span class="text-danger text-wrap">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal" ng-disabled="is_submited">
                            بستن
                        </button>&nbsp;
                        <button type="submit" class="btn btn-primary">ذخیره
                        </button>
                    </div>
                </form>

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

    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function () {

        @this.on('triggerChangeLevelModal', orderId => {
            $('#changeLevelModal').modal('show');
        });
        });

        window.addEventListener('itemLevelUpdated', event => {
            $('#changeLevelModal').modal('hide');
            showToast('نقش آیتم مورد نظر با موفقیت تغییر کرد.', 'success');
        });
    </script>
@endpush

