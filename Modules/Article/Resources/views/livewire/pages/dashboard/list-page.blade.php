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
                            @include('livewire.filters.select_box', ['label' => 'وضعیت', 'name' => 'status', 'items' => $status_filter_items])
                            @include('livewire.filters.limit_select_box')
                        </div>
                    </div>
                </form>

                <a class="btn btn-primary pull-right"
                   href="{{ route('articles.create') }}">افزودن
                    مقاله جدید</a>

                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>ردیف</th>
                        <th>عنوان</th>
                        <th>کاربر</th>
                        <th>تعداد لایک</th>
                        <th>وضعیت</th>
                        <th>عکس</th>
                        <th>اعمال</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach ($items as $item)
                        <tr>
                            <td wire:ignore>
                                <input type="checkbox" ng-model="bulk_checkbox_{{ $item->id }}{{ $item->id }}"
                                       id="bulk_checkbox_{{ $item->id }}"
                                       ng-checked="selected_items.includes({{ $item->id }})"
                                       wire:change="$emit('triggerChangeStatusModal' , {{ $item->id }}, 'bulk_checkbox_{{ $item->id }}')"
{{--                                       ng-change="AddItemsToBulkAction('{{ $item->id }}', bulk_checkbox_{{ $item->id }})"--}}
                                       class="ml-2"> <label for="bulk_checkbox_{{ $item->id }}" style="font-weight: normal !important;">{{ $loop->iteration }}</label>
                            </td>
                            <td>{{$item->title}}</td>
                            <td>{{$item->user ? $item->user->fullname() : '---'}}</td>
                            <td>{{$item->like_count}}</td>
                            <td>

                                <span wire:click="$emit('triggerChangeLevelModal' , {{ $item }})"
                                      class="label_mouse_cursor label label-{{ $item->get_status_class() }}-border rounded">
                                    {{ $item->get_status() }}
                                </span>

                            </td>
                            <td>
                                <a href="{{ $item->get_image() }}" target="-_blank"><img width="50"
                                                                                         src="{{ $item->get_image() }}"
                                                                                         alt="عکس"></a>
                            </td>

                            <td>
                                <div class="buttons ">
                                    <a href="{{ route('articles.edit' , $item->id) }}"
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
</div>

@push('StackScript')
    @include('livewire.delete')
    @include('livewire.bulk_actions.bulk_actions_js', ['items' => $items, 'model' => \Modules\Article\Entities\Article::class])
@endpush

