<div class="text-xs inline-flex items-center leading-sm px-3 py-1 bg-blue-200 rounded-full">
    <a href="{{ URL::to('/tags/'.$tag->slug) }}" class="text-blue-800">
        {{ $tag->name }}
    </a>
</div>
