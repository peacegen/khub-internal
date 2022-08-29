<div>
    {{-- // TODO Work more on the homepage --}}
    @foreach ($data as $tag)
    <div>
        <div>{{ $tag['name'] }}</div>
        <div>{{ $tag['description'] }}</div>
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
