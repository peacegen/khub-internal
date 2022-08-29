<div class="flex justify-center flex-col items-center mt-4">
    {{-- // TODO Work more on the homepage --}}
    @foreach ($data as $tag)
        <div class="w-3/4 origin-center mt-4">
            <div class="mt-4 text-lg">{{ $tag['name'] }}</div>
            <div class="mt-4 text-sm">{{ $tag['description'] }}</div>
            @include('components.carousel', ['items' => $tag['items']])
        </div>
    @endforeach

    <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>

    <script type="text/javascript">
        const flkty = new Flickity( '.carousel',{
            // options
        });
        flkty.on( 'change', function( index ) {
            livewire.emit('listener', index)
        });
    </script>
</div>
