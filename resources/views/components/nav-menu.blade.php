{{-- https://github.com/jackoftraits/laravel8-with-livewire/blob/master/resources/views/livewire/frontpage.blade.php --}}
<div class="divide-y divide-gray-800" x-data="{ show: false }">
    <nav class="flex items-center bg-gray-900 px-3 py-2 shadow-lg">
        <div>
            <button @click="show =! show" class="block h-8 mr-3 text-gray-400 items-center hover:text-gray-200 focus:text-gray-200 focus:outline-none">
                <svg class="w-8 fill-current" viewBox="0 0 24 24">
                    <path x-show="!show" fill-rule="evenodd" d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z"/>
                    <path x-show="show" fill-rule="evenodd" d="M18.278 16.864a1 1 0 0 1-1.414 1.414l-4.829-4.828-4.828 4.828a1 1 0 0 1-1.414-1.414l4.828-4.829-4.828-4.828a1 1 0 0 1 1.414-1.414l4.829 4.828 4.828-4.828a1 1 0 1 1 1.414 1.414l-4.828 4.829 4.828 4.828z"/>
                </svg>
            </button>
        </div>
        <div class="h-12 w-full flex items-center">
            <a href="{{ url('/') }}" class="w-full">
                <x-icons.logo fill="fill-gray-400"/>
            </a>
        </div>
        <div class="flex justify-end sm:w-8/12">
            {{-- Top Navigation --}}
            <ul class="hidden sm:flex sm:text-left text-gray-200 text-xs">
                @foreach ($topNavLinks as $item)
                    <a href="{{ $item->url }}">
                        <li class="cursor-pointer px-4 py-2 hover:bg-gray-800">{{ $item->label }}</li>
                    </a>
                @endforeach
            </ul>
        </div>
    </nav>
    <div class="sm:flex block z-10 left-0 fixed overflow-x-hidden duration-300" :class="show ? 'w-full': 'w-0'">
        {{-- :class ="show ? 'sm:min-h-screen' : 'sm:min-h-0' --}}
        <aside :class="show ? 'block' : 'hidden'" class="duration-300 bg-gray-900 text-gray-700 divide-y divide-gray-700 divide-dashed sm:w-4/12 md:w-3/12 lg:w-2/12 sm:min-h-screen">
            {{-- Desktop Web View --}}
            <ul class="hidden text-gray-200 text-xs sm:block sm:text-left">
                @foreach ($sideBarLinks as $item)
                    <a href="{{ $item->url }}">
                        <li class="cursor-pointer px-4 py-2 hover:bg-gray-800">{{ $item->label }}</li>
                    </a>
                @endforeach
            </ul>
            {{-- Mobile Web View --}}
            <div :class="show ? 'block' : 'hidden'" class="pb-3 divide-y divide-gray-800 block sm:hidden">
            <ul class="text-gray-200 text-sm">
                @foreach ($sideBarLinks as $item)
                    <a href="{{ $item->url }}">
                        <li class="cursor-pointer px-4 py-2 hover:bg-gray-800">{{ $item->label }}</li>
                    </a>
                @endforeach
            </ul>
                {{-- Top Navigation Mobile Web View --}}
                <ul class="text-gray-200 text-sm">
                    @foreach ($topNavLinks as $item)
                        <a href="{{ $item->url }}">
                            <li class="cursor-pointer px-4 py-2 hover:bg-gray-800">{{ $item->label }}</li>
                        </a>
                    @endforeach
                </ul>
            </div>
        </aside>
    </div>
</div>

