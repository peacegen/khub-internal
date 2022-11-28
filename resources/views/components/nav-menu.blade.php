{{-- https://github.com/jackoftraits/laravel8-with-livewire/blob/master/resources/views/livewire/frontpage.blade.php --}}
<header class="divide-y divide-gray-800" x-data="{ show: false }">
    <nav class="flex items-center justify-between bg-primary-500 px-3 py-6 shadow-lg">
        <div class="h-12 w-full flex items-center">
            <a href="{{ url('/') }}" class="w-full flex gap-4 items-center">
                <!-- <x-icons.logo class="fill-gray-300 hover:fill-gray-100"/> -->
                <img src="/assets/img/peacegen-logo.png" class="w-14" alt="Peacegen Logo">
                <h1 class="text-white text-base leading-6 font-bold">Knowledge Hub <br /> Comms</h1>
            </a>
        </div>
        <div class="flex justify-end sm:w-8/12">
            <ul class="hidden sm:flex sm:text-left gap-3 text-gray-100 hover:text-gray-50 text-sm">
                <a href="{{ url('/') }}">
                    <li class="cursor-pointer rounded-md px-4 py-2 hover:bg-primary-600">Home</li>
                </a>
                 @foreach ($sideBarLinks as $item)
                    <a href="{{ $item['url'] }}">
                        <li class="cursor-pointer rounded-md px-4 py-2 hover:bg-primary-600">{{ __($item['label']) }}</li>
                    </a>
                @endforeach
                @foreach ($topNavLinks as $item)
                    @if ($item['label'] == "Register" || $item['label'] == "Logout")
                        <a href="{{ $item['url'] }}">
                            <li class="cursor-pointer rounded-md px-4 py-2 bg-green-900 hover:opacity-80">{{ __(__($item['label'])) }}</li>
                        </a>
                    @else
                        <a href="{{ $item['url'] }}">
                            <li class="cursor-pointer rounded-md px-4 py-2 hover:bg-primary-600">{{ __(__($item['label'])) }}</li>
                        </a>
                    @endif
                @endforeach
            </ul>
        </div>
        <div>
            <button @click="show =! show" class="sm:hidden block h-8 mr-3 text-gray-300 items-center hover:text-gray-100 focus:outline-none {{ $sideBarLinks ? '' : 'sm:hidden' }}">
                <svg class="w-8 fill-current" viewBox="0 0 24 24">
                    <path x-show="!show" fill-rule="evenodd" d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z"/>
                    <path x-show="show" fill-rule="evenodd" d="M18.278 16.864a1 1 0 0 1-1.414 1.414l-4.829-4.828-4.828 4.828a1 1 0 0 1-1.414-1.414l4.828-4.829-4.828-4.828a1 1 0 0 1 1.414-1.414l4.829 4.828 4.828-4.828a1 1 0 1 1 1.414 1.414l-4.828 4.829 4.828 4.828z"/>
                </svg>
            </button>
        </div>
    </nav>
    <div class="sm:flex block z-10 left-0 fixed overflow-x-hidden duration-300 w-full h-full bg-black/20" :class="show ? 'h-full opacity-100': 'h-0 opacity-0'" @click="show =! show">
        {{-- :class ="show ? 'sm:min-h-screen' : 'sm:min-h-0' --}}
        <aside :class="show ? 'block' : 'hidden'" class="duration-300 bg-primary-500 text-gray-700 divide-y divide-gray-700 divide-dashed sm:w-4/12 md:w-3/12 lg:w-2/12 sm:min-h-screen">
            <div :class="show ? 'block' : 'hidden'" class="pb-3 block sm:hidden">
            <ul class="text-gray-200 text-md divide-y divide-gray-100">
                    <a href="/">
                        <li class="cursor-pointer px-4 py-2 hover:bg-primary-600">Home</li>
                    </a>
                @foreach ($sideBarLinks as $item)
                    <a href="{{ $item['url'] }}">
                        <li class="cursor-pointer px-4 py-2 hover:bg-primary-600">{{ __($item['label']) }}</li>
                    </a>
                @endforeach
                @foreach ($topNavLinks as $item)
                    <a href="{{ $item['url'] }}">
                        <li class="cursor-pointer px-4 py-2 hover:bg-primary-600">{{ __($item['label']) }}</li>
                    </a>
                @endforeach
            </ul>
            </div>
        </aside>
    </div>
</header>
