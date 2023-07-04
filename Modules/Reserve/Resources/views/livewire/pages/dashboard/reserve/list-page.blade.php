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
                            {{--                            @include('livewire.filters.select_box', ['label' => 'وضعیت', 'name' => 'status', 'items' => $status_filter_items])--}}
                            @include('livewire.filters.limit_select_box')
                        </div>
                    </div>
                </form>

                <a class="btn btn-primary pull-right" href="{{ route('reserves.create') }}">افزودن رزرو جدید</a>

                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>ردیف</th>
                        <th>کاربر</th>
                        <th>مرکز</th>
                        <th>تاریخ</th>
                        <th>زمان شروع</th>
                        <th>زمان پایان</th>
                        <th>تعداد نفرات</th>
                        <th>مبلغ</th>
                        <th>نوع</th>
                        <th>تشریفات</th>
                        <th>وضعیت</th>
                        <th>تاریخ ثبت</th>
                        <th>اعمال</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach ($items as $item)
                        <tr>
                            <td>
                                <input type="checkbox"
                                       id="bulk_checkbox_{{ $item->id }}"
                                       wire:change="$emit('triggerAddBulkActionEvent' , {{ $item->id }}, 'bulk_checkbox_{{ $item->id }}', <?php echo json_encode($items->pluck('id')->toArray()); ?>)"
                                       class="ml-2"> <label for="bulk_checkbox_{{ $item->id }}"
                                                            style="font-weight: normal !important;">{{ $loop->iteration }}</label>
                            </td>
                            <td>{{ $item->user ? $item->user->fullname() : '---' }}</td>
                            <td>{{ $item->place ? $item->place->name : '---' }}</td>
                            <td>{{ \Hekmatinasser\Verta\Verta:: instance($item->date)->format('%B %d، %Y') }}</td>
                            <td>{{ $item->start_time }}</td>
                            <td>{{ $item->end_time }}</td>
                            <td>{{ $item->guest_count }}</td>
                            <td>{{ number_format($item->amount) }}</td>
                            <td>
                                {{  $item->get_type() }}
                            </td>
                            <td>
                                {{  $item->get_option_names() }}
                            </td>
                            <td>

                                <span wire:click="$emit('triggerChangeStatusModal' , {{ $item }})"
                                      class="label_mouse_cursor label label-{{ $item->status ? 'success' : 'danger' }}-border rounded">
                                    @if($item->status)
                                        فعال
                                    @else
                                        غیر فعال
                                    @endif
                                </span>

                            </td>

                            <td>{{ \Hekmatinasser\Verta\Verta:: instance($item->created_at)->format('%B %d، %Y') }}</td>
                            <td>
                                <div class="buttons ">
                                    @if($item->user_description)
                                        <button ng-click="ShowUserDescriptionModal('{{ $item->user_description }}')"
                                                type="button"
                                                data-original-title="نمایش متن توضیحات کاربر"
                                                data-toggle="tooltip"
                                                class="btn btn-warning btn-action"><i
                                                class="fa fa-eye"> </i>
                                        </button>
                                    @endif

                                    <a href="{{ route('reserves.edit' , $item->id) }}"
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

                @include('livewire.bulk_actions.bulk_actions', ['actions' => [['delete', 'حذف کردن']], 'items' => $items])

                {{ $items->onEachSide(3)->links('livewire.pagination') }}

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
                               for="id_status">وضعیت:</label>

                        <div>
                            <select wire:model="data.status" class="form-control" name="status">

                                <option @if(isset($current_item_status) && $current_item_status == '1') selected
                                        @endif value="1">فعال
                                </option>
                                <option @if(isset($current_item_status) && $current_item_status == '0') selected
                                        @endif value="0">غیرفعال
                                </option>

                            </select>

                            @error('status')
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

    <!-- Modal -->
    <div wire:ignore.self class="modal fade bd-example-modal-lg" id="showUserDescriptionModal" tabindex="-1"
         role="dialog"
         aria-labelledby="changeStatusModalTitle" aria-hidden="true" dir="rtl"
         style="text-align: right !important; margin-top: 250px">
        <div class="modal-dialog modal-dialog-centered" role="document">

            <div class="modal-content">
                <div class="modal-header" style="width: 100%!important;">
                    <h5 class="modal-title"
                        id="exampleModalLongTitle">نمایش توضیحات کاربر</h5>

                    <button type="button" class="close ml-2" data-dismiss="modal"
                            style="position: absolute!important;left: 0!important; top: 10px"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form>
                    <div class="modal-body">
                        <label class="form-label"
                               for="id_is_active">متن:</label>

                        <div>
                            <textarea ng-model="user_description" disabled class="form-control" rows="8"></textarea>
                        </div>
                    </div>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal" ng-disabled="is_submited">
                            بستن
                        </button>
                    </div>
                </form>

            </div>

        </div>
    </div>

</div>

@push('StackScript')
    @include('livewire.delete')
    @include('livewire.bulk_actions.bulk_actions_js', ['items' => $items, 'model' => \Modules\Reserve\Entities\Reserve::class])

    <script>
        app.controller('myCtrl', function ($scope, $http) {
            $scope.user_description = null;

            $scope.ShowUserDescriptionModal = function (user_description) {
                $scope.user_description = user_description;
                $('#showUserDescriptionModal').modal('show');
            }
        });
    </script>

    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function () {

        @this.on('triggerChangeStatusModal', orderId => {
            $('#changeStatusModal').modal('show');
        });
        });

        window.addEventListener('itemStatusUpdated', event => {
            $('#changeStatusModal').modal('hide');
            showToast('وضعیت آیتم مورد نظر با موفقیت تغییر کرد.', 'success');
        });
    </script>
@endpush

