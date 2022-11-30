<div class="flex justify-center flex-col items-center">
    @if ($data && count($data))
    <div class="w-full sm:w-4/5 divide-y-2 p-2">
    @foreach ($data as $tag)
        <div class="origin-center">
            <div class="origin-center mt-4">
                @if($tag['slug'])
                    <a class="py-2 text-lg" href="{{ route('tags', $tag['slug']) }}">{{ $tag['name'] }}</a>
                @else
                <div class="py-2 text-lg">{{ $tag['name'] }}</div>
                @endif
                <div class="py-2 text-sm">{{ $tag['description'] }}</div>
            </div>

            @include('components.carousel', ['items' => $tag['items'], 'default_url' => "{{ config('config.default-thumbnail') }}",
            'options' => [
                'wrapAround' => true,
                'autoPlay' => 3000,
                'groupCells' => '80%',
            ]])
        </div>
    @endforeach
    </div>
    @else
    <div class="text-lg">
        {{ __('Nothing to see here') }}
    </div>
    @endif
</div>
