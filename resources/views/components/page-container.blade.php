<div>
<a href="{{ URL::to('/pages/'.$page->slug) }}" class="relative">
<div class="py-2 flex">
    <img src="{{ $page->thumbnail_url }}" class="w-1/3" alt="{{ $page->title }}"/>
    <div>
        <div class="text-lg py-2 px-2 truncate">
        {{ $page->title }}
        </div>
        <div class="text-sm py-2 px-2 truncate">
        {{ $page->content->toPlainText() }}
        </div>
    </div>
</div>
</a>
</div>
