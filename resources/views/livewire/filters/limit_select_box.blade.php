<div class="{{ isset($class) ? $class : 'col-lg-2' }}">
    <label class="control-label col-2">نتایج</label>
    <select wire:model="pagination" name="limit" id="limit" class="form-control rounded">
        <option>5</option>
        <option>10</option>
        <option>15</option>
        <option>20</option>
    </select>
</div>
