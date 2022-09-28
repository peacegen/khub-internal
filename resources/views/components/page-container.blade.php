<div>
<a href="{{ URL::to('/pages/'.$page->slug) }}" class="relative">
<div class="py-4 flex">
    <img src="{{ $page->thumbnail_url }}" class="w-1/3" alt="{{ $page->title }}"/>
    <div class="w-2/3">
        <div class="text-lg px-2">
        {{ $page->title }}
        </div>
        <div class="text-sm py-2 px-2 truncate">
        {{ $page->content->toPlainText() }}
        </div>
    </div>
</div>
</a>
</div>
