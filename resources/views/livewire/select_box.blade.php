<div class="{{ isset($class) ? $class : 'col-lg-3' }}">
    <label class="control-label col-2">{{ isset($label) ?? $label }}</label>
    <select onchange="submit()" name="{{ isset($name) ?? $name }}" id="{{ isset($name) ?? $name }}"
            class="form-control rounded">
        <option value="">{{ isset($placeholder) ? $placeholder : 'همه موارد' }}</option>
        @foreach($items as $item)
            <option value="{{ $item->id }}"
                    @if($item->id == request($name) ) selected @endif>
                {{ $item->name }}
            </option>
        @endforeach
    </select>
</div>
