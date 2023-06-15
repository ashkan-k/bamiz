<div class="bulk-actions">
    <div class="row">
        <div class="col-md-5 pt-2">
            <input type="checkbox" id="checkAll" wire:change="AddItemsToBulkAction(<?php echo json_encode($items->pluck('id')->toArray() ); ?>)" {{--[checked]="data && bulk_action_items.length == data.length" (change)="AddItemsToBulkAction(data,$event)" --}}>
            <label for="checkAll" class="mr-3">انتخاب همه</label>
        </div>
        <div class="col-md-3">
            <p class="mt-2">عملیات دست جمعی موارد انتخاب شده</p>
        </div>
        <div class="col-md-2">
            <select wire:model="bulk_action" name="bulk-action" id="bulkAction" class="form-control">
                <option value="" disabled selected>انتخاب عملیات</option>
                @foreach($actions as $action)
                    <option value="{{ $action[0] }}">{{ $action[1] }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <button type="button" onclick="SubmitBulkActionConfirm()" class="btn btn-info" >برو انجام بده</button>
        </div>
    </div>
</div>

