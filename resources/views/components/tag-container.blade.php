<div class="text-xs inline-flex items-center leading-sm px-3 py-1 bg-primary-background rounded-full">
    <a href="{{ URL::to('/tags/'.$tag->slug) }}" class="text-primary-text">
        {{ $tag->name }}
    </a>
</div>
