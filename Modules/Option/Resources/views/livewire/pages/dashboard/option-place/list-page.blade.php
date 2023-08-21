<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            <div class="card-block">
                <h4 class="card-title">{{$titlePage}} مرکز {{ $place->name }}</h4>

                <hr>
                <form id="search">
                    <div class="form-group">
                        <div class="row">
                            @include('livewire.filters.search_input')
                            @include('livewire.filters.limit_select_box')
                        </div>
                    </div>
                </form>

                <a class="btn btn-primary pull-right" href="{{ route('option_places.create') }}?place_id={{ $this->place_id }}&next_url={{ $full_url }}">الحاق تشریفات به مرکز {{ $place->name }}</a>
                <a class="btn btn-primary pull-right" style="margin-left: 10px !important;" href="{{ route('options.create') }}?place_id={{ $this->place_id }}&next_url={{ $full_url }}">ثبت تشریفات جدید برای مرکز {{ $place->name }}</a>

                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>ردیف</th>
                        <th>مرکز</th>
                        <th>تشریفات</th>
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
                                       class="ml-2"> <label for="bulk_checkbox_{{ $item->id }}" style="font-weight: normal !important;">{{ $loop->iteration }}</label>
                            </td>
                            <td>{{ $item->place ? $item->place->name : '---' }}</td>
                            <td>{{ $item->option ? $item->option->title : '---' }}</td>

                            <td>{{ \Hekmatinasser\Verta\Verta:: instance($item->created_at)->format('%B %d، %Y') }}</td>
                            <td>
                                <div class="buttons ">
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
    @include('livewire.bulk_actions.bulk_actions_js', ['items' => $items, 'model' => \Modules\Option\Entities\OptionPlace::class])
@endpush


