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

                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>کاربر</th>
                        <th>آگهی</th>
                        <th>قیمت (تومن)</th>
                        <th>کد پیگیری</th>
                        <th>ip</th>
                        <th>وضعیت</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach ($items as $item)
                        <tr>
                            <td>{{ $item->user ? $item->user->fullname() : '---' }}</td>
                            <td>{{$item->reserve ? $item->reserve->place->name : '---'}}</td>
                            <td>{{ number_format($item->amount) }}</td>
                            <td>{{ $item->refID ?: '---' }}</td>
                            <td>{{ $item->ip }}</td>
                            <td>
                                <span
                                    class="label_mouse_cursor label label-{{ $item->status ? 'success' : 'danger' }}-border rounded">
                                        @if($item->status)
                                        موفق
                                    @else
                                        ناموفق
                                    @endif
                                </span>
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
