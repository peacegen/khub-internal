<div>
<div class="py-4 flex">
    <a href="{{ URL::to('/pages/'.$page->slug) }}" class="relative w-1/3">
    <img src="{{ $page->thumbnail_url }}" class="" alt="{{ $page->title }}"/>
    </a>
    <div class="w-2/3">
        <a href="{{ URL::to('/pages/'.$page->slug) }}" class="relative">
        <div class="text-lg px-2">
        {{ $page->title }}
        </div>
        </a>
        @if(count($page->tags))
            <div class="px-2 py-2 flex-row">
                @foreach ($page->tags as $tag)
                    <x-tag-container :tag='$tag'/>
                @endforeach
            </div>
        @endif
        <div class="text-md py-2 px-2 truncate">
        {{ $page->content->toPlainText() }}
        </div>
    </div>
</div>
</div>
