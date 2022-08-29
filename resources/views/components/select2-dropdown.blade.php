<div>
    <div wire:ignore>
        <select class="select2" name={{ $name }}>
            @foreach ($options as $option)
                <option value="{{ $option['value'] }}">{{ $option['text'] }}</option>
            @endforeach
        </select>
    </div>
</div>
