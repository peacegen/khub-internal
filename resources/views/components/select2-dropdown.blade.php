<div>
    <div wire:ignore>
        <select class="select2" name={{ $name }}>
            @foreach ($options as $option)
                <option value="{{ $option }}">{{ $option }}</option>
            @endforeach
        </select>
    </div>
</div>
