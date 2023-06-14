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
                            @include('livewire.filters.select_box', ['label' => 'وضعیت', 'name' => 'is_active', 'items' => $status_filter_items])
                            @include('livewire.filters.limit_select_box')
                        </div>
                    </div>
                </form>

                <a class="btn btn-primary pull-right" href="{{ route('places.create') }}">افزودن مکان جدید</a>

                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>نام</th>
                        <th>مالک</th>
                        <th>دسته بندی</th>
                        <th>استان</th>
                        <th>شهر</th>
                        <th>تعداد میز</th>
                        <th>عکس</th>
                        <th>وضعیت</th>
                        <th>تاریخ ثبت</th>
                        <th>اعمال</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach ($items as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->user ? $item->user->fullname() : '---' }}</td>
                            <td>{{ $item->category ? $item->category->title : '---' }}</td>
                            <td>{{ $item->province ? $item->province->title : '---' }}</td>
                            <td>{{ $item->city ? $item->city->title : '---' }}</td>
                            <td>{{ $item->chairs_people_count }}</td>
                            <td>
                                <a href="{{ $item->get_cover() }}" target="-_blank"><img width="50"
                                                                                         src="{{ $item->get_cover() }}"
                                                                                         alt="عکس کابر"></a>
                            </td>
                            <td>

                                <span wire:click="$emit('triggerChangeStatusModal' , {{ $item }})"
                                      class="label_mouse_cursor label label-{{ $item->is_active ? 'success' : 'danger' }}-border rounded">
                                    @if($item->is_active)
                                        فعال
                                    @else
                                        غیر فعال
                                    @endif
                                </span>

                            </td>

                            <td>{{ \Hekmatinasser\Verta\Verta:: instance($item->created_at)->format('%B %d، %Y') }}</td>
                            <td>
                                <div class="buttons ">
                                    <a href="{{ route('foods.index') }}?place_id={{ $item->id }}"
                                       class="btn btn-info btn-action mr-1"
                                       data-toggle="tooltip" title=""
                                       data-original-title="منوی غذا"><i
                                            class="fas fa-birthday-cake"></i><i
                                            class="fa fa-birthday-cake"> </i> </a>
                                    <a href="{{ route('option_places.index') }}?place_id={{ $item->id }}"
                                       class="btn btn-success btn-action mr-1"
                                       data-toggle="tooltip" title=""
                                       data-original-title="تشریفات"><i
                                            class="fas fa-check-square-o-alt"></i><i
                                            class="fa fa-check-square-o"> </i> </a>
                                    <a href="{{ route('galleries.index') }}?place_id={{ $item->id }}"
                                       class="btn btn-warning btn-action mr-1"
                                       data-toggle="tooltip" title=""
                                       data-original-title="گالری تصاویر"><i
                                            class="fas fa-image-alt"></i><i
                                            class="fa fa-image"> </i> </a>
                                    <a href="{{ route('places.edit' , $item->id) }}"
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
    <div wire:ignore.self class="modal fade bd-example-modal-lg" id="changeStatusModal" tabindex="-1" role="dialog"
         aria-labelledby="changeStatusModalTitle" aria-hidden="true" dir="rtl"
         style="text-align: right !important; margin-top: 250px">
        <div class="modal-dialog modal-dialog-centered" role="document">

            <div class="modal-content">
                <div class="modal-header" style="width: 100%!important;">
                    <h5 class="modal-title"
                        id="exampleModalLongTitle">تغییر وضعیت</h5>

                    <button type="button" class="close ml-2" data-dismiss="modal"
                            style="position: absolute!important;left: 0!important; top: 10px"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form wire:submit.prevent="ChangeStatus">
                    <div class="modal-body">
                        <label class="form-label"
                               for="id_is_active">وضعیت:</label>

                        <div>
                            <select wire:model="data.is_active" class="form-control" name="is_active">

                                <option @if(isset($current_item_is_active) && $current_item_is_active == '1') selected
                                        @endif value="1">فعال
                                </option>
                                <option @if(isset($current_item_is_active) && $current_item_is_active == '0') selected
                                        @endif value="0">غیرفعال
                                </option>

                            </select>

                            @error('is_active')
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
                text: "آیا می خواهید این کابر آیتم شود ؟ 🤔",
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

        @this.on('triggerChangeStatusModal', orderId => {
            $('#changeStatusModal').modal('show');
        });
        });

        window.addEventListener('itemStatusUpdated', event => {
            $('#changeStatusModal').modal('hide');
            showToast('نقش آیتم مورد نظر با موفقیت تغییر کرد.', 'success');
        });
    </script>
@endpush

