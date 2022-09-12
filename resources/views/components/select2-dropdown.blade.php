<div>
    @section('select2-scripts')
    <x:pharaonic-select2::scripts />
    @endsection
    <div wire:ignore>
        <select class="select2" name={{ $name }}>
            @foreach ($options as $option)
                <option value="{{ $option }}">{{ $option }}</option>
            @endforeach
        </select>
    </div>
</div>
