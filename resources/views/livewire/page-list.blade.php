<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <input type="text" wire:model="search" placeholder="Search pages..."/>
        @forelse ($pages as $page)
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
