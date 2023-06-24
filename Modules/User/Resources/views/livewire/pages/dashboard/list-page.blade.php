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
                            @include('livewire.filters.select_box', ['label' => 'نقش', 'name' => 'level', 'items' => $level_filter_items])
                            @include('livewire.filters.limit_select_box')
                        </div>
                    </div>
                </form>

                <a class="btn btn-primary pull-right" href="{{ route('users.create') }}">افزودن کاربر جدید</a>

                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>ردیف</th>
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
                            <td>
                                <input type="checkbox"
                                       id="bulk_checkbox_{{ $item->id }}"
                                       wire:change="$emit('triggerChangeStatusModal' , {{ $item->id }}, 'bulk_checkbox_{{ $item->id }}', <?php echo json_encode($items->pluck('id')->toArray()); ?>)"
                                       class="ml-2"> <label for="bulk_checkbox_{{ $item->id }}" style="font-weight: normal !important;">{{ $loop->iteration }}</label>
                            </td>
                            <td>{{$item->username}}</td>
                            <td>{{$item->first_name}}</td>
                            <td>{{$item->last_name}}</td>
                            <td>{{$item->email}}</td>
                            <td>

                                <span wire:click="$emit('triggerChangeActiveModal' , {{ $item }})"
                                    class="label_mouse_cursor label label-{{ $item->email_verified_at ? 'success' : 'danger' }}-border rounded">
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
                                      class="label_mouse_cursor label label-{{ $item->get_level_class() }}-border rounded">
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

                @include('livewire.bulk_actions.bulk_actions', ['actions' => [['delete', 'حذف کردن']], 'items' => $items])

                {{ $items->onEachSide(3)->links('livewire.pagination') }}

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
                            <select wire:model="data.level" class="form-control" name="level">

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

    <!-- Modal -->
    <div wire:ignore.self class="modal fade bd-example-modal-lg" id="changeActiveModal" tabindex="-1" role="dialog"
         aria-labelledby="changeLevelModalTitle" aria-hidden="true" dir="rtl"
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

                <form wire:submit.prevent="ChangeActive">
                    <div class="modal-body">
                        <label class="form-label"
                               for="id_level">وضعیت:</label>

                        <div>
                            <select wire:model="data.active_status" class="form-control" name="active_status">

                                <option @if(isset($current_item_level) && $current_item_level == 'admin') selected
                                        @endif value="1">فعال
                                </option>
                                <option @if(isset($current_item_level) && $current_item_level == 'staff') selected
                                        @endif value="0">غیرفعال
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
    @include('livewire.delete')
    @include('livewire.bulk_actions.bulk_actions_js', ['items' => $items, 'model' => \Modules\User\Entities\User::class])

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

    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function () {

        @this.on('triggerChangeActiveModal', orderId => {
            $('#changeActiveModal').modal('show');
        });
        });

        window.addEventListener('itemActiveUpdated', event => {
            $('#changeActiveModal').modal('hide');
            showToast('وضعیت آیتم مورد نظر با موفقیت تغییر کرد.', 'success');
        });
    </script>
@endpush

