<div class="flex justify-center flex-col items-center">
    {{-- // TODO Work more on the homepage --}}
    @if ($data && count($data))
    @foreach ($data as $tag)
        <div class="w-3/4 origin-center py-2">
            <div class="py-2 text-lg">{{ $tag['name'] }}</div>
            <div class="py-2 text-sm">{{ $tag['description'] }}</div>


            @include('components.carousel', ['items' => $tag['items'], 'default_url' => "{{ config('config.default-thumbnail') }}", 'options' => [
                'wrapAround' => true,
                'autoPlay' => 3000,
                'groupCells' => '80%',
]           ])
        </div>
    @endforeach
    @else
    <div class="text-lg">
        {{ __('Nothing to see here') }}
    </div>
    @endif



</div>
