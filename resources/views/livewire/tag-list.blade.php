<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div wire:ignore>
            <input class="rounded border-gray-500 px-2 py-1 " type="text" wire:model="search" placeholder="Search pages..."/>
        </div>
        @forelse ($pageList as $page)
            <div class="">
                <x-page-container :page='$page'/>
            </div>
        @empty
            <div class="py-2">
                <div class="text-lg py-2">
                    No pages found
                </div>
            </div>
        @endforelse
    </div>
</div>
