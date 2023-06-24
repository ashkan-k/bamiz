<?php $all_items =  json_encode($items->pluck('id')->toArray() ); ?>

<div class="bulk-actions">
    <div class="row">
        <div class="col-md-5 pt-2">
            <input type="checkbox" id="checkAll"
                   wire:change="$emit('triggerAddBulkActionEvent', <?php echo $all_items ?>, 'checkAll', <?php echo $all_items ?>)">
            <label for="checkAll" class="mr-3">انتخاب همه</label>
        </div>
        <div class="col-md-3">
            <p class="mt-2">عملیات دست جمعی موارد انتخاب شده</p>
        </div>
        <div class="col-md-2">
            <select ng-model="bulk_action" name="bulk-action" id="bulkAction" class="form-control">
                <option value="" disabled selected>انتخاب عملیات</option>
                @foreach($actions as $action)
                    <option value="{{ $action[0] }}">{{ $action[1] }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <button type="button" ng-click="SubmitBulkActionConfirm()" class="btn btn-info" >برو انجام بده</button>
        </div>
    </div>
</div>
