{{-- https://github.com/jackoftraits/laravel8-with-livewire/blob/master/resources/views/livewire/frontpage.blade.php --}}
<div>
    <div class="divide-y divide-gray-800" x-data="{ show: false }">
        <nav class="flex items-center bg-primary-500 px-3 py-2 shadow-lg">
            <div>
                <button @click="show =! show" class="block h-8 mr-3 text-gray-300 items-center hover:text-gray-100 focus:outline-none {{ $sideBarLinks ? '' : 'sm:hidden' }}">
                    <svg class="w-8 fill-current" viewBox="0 0 24 24">
                        <path x-show="!show" fill-rule="evenodd" d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z"/>
                        <path x-show="show" fill-rule="evenodd" d="M18.278 16.864a1 1 0 0 1-1.414 1.414l-4.829-4.828-4.828 4.828a1 1 0 0 1-1.414-1.414l4.828-4.829-4.828-4.828a1 1 0 0 1 1.414-1.414l4.829 4.828 4.828-4.828a1 1 0 1 1 1.414 1.414l-4.828 4.829 4.828 4.828z"/>
                    </svg>
                </button>
            </div>
            <div class="h-12 w-full flex items-center">
                <a href="{{ url('/') }}" class="w-full">
                    <x-icons.logo class="fill-gray-300 hover:fill-gray-100"/>
                </a>
            </div>
            <div class="flex justify-end sm:w-8/12">
                {{-- Top Navigation --}}
                <ul class="hidden sm:flex sm:text-left text-gray-100 hover:text-gray-50 text-xs">
                    @foreach ($topNavLinks as $item)
                        <a href="{{ url($item['url']) }}">
                            <li class="cursor-pointer px-4 py-2 hover:bg-primary-600">{{ __(__($item['label'])) }}</li>
                        </a>
                    @endforeach
                    @auth
                    {{-- logout --}}
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <li class="cursor-pointer px-4 py-2 hover:bg-primary-600">{{ __('Logout') }}</li>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    @else
                    {{-- login --}}
                        <li wire:click="$set('loginModalVisible', 'true')" class="cursor-pointer px-4 py-2 hover:bg-primary-600">{{ __('Login') }}</li>
                    @endauth
                </ul>
            </div>
        </nav>
        <div class="sm:flex block z-10 left-0 fixed overflow-x-hidden duration-300" :class="show ? 'w-full': 'w-0'">
            {{-- :class ="show ? 'sm:min-h-screen' : 'sm:min-h-0' --}}
            <aside :class="show ? 'block' : 'hidden'" class="duration-300 bg-primary-500 text-gray-700 divide-y divide-gray-700 divide-dashed sm:w-4/12 md:w-3/12 lg:w-2/12 sm:min-h-screen">
                {{-- Desktop Web View --}}
                <ul class="hidden text-gray-200 text-sm sm:block sm:text-left">
                    @foreach ($sideBarLinks as $item)
                        <a href="{{ $item['url'] }}">
                            <li class="cursor-pointer px-4 py-2 hover:bg-primary-600">{{ __($item['label']) }}</li>
                        </a>
                    @endforeach
                </ul>
                {{-- Mobile Web View --}}
                <div :class="show ? 'block' : 'hidden'" class="pb-3 divide-y divide-gray-800 block sm:hidden">
                <ul class="text-gray-200 text-md">
                    @foreach ($sideBarLinks as $item)
                        <a href="{{ $item['url'] }}">
                            <li class="cursor-pointer px-4 py-2 hover:bg-primary-600">{{ __($item['label']) }}</li>
                        </a>
                    @endforeach
                </ul>
                {{-- Top Navigation Mobile Web View --}}
                <ul class="text-gray-200 text-md">
                    @foreach ($topNavLinks as $item)
                        <a href="{{ $item['url'] }}">
                            <li class="cursor-pointer px-4 py-2 hover:bg-primary-600">{{ __($item['label']) }}</li>
                        </a>
                    @endforeach
                    @auth
                        <li class="cursor-pointer px-4 py-2 hover:bg-primary-600">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Logout') }}
                                </a>
                            </form>
                        </li>
                    @else
                        <li wire:click="$set('loginModalVisible', 'true')" class="cursor-pointer px-4 py-2 hover:bg-primary-600">{{ __('Login') }}</li>
                    @endauth
                </ul>
                </div>
            </aside>
        </div>
    </div>
    <div>
        <!-- Start Modal -->
        <x-jet-dialog-modal wire:model="loginModalVisible">
            <x-slot name="title">
                {{ __('Login') }}
            </x-slot>

            <x-slot name="content">
                <!-- Content -->
                <a href="{{ route('auth.google') }}">
                    <x-google-sign-in />
                </a>
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$set('loginModalVisible', 'false')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-jet-secondary-button>
            </x-slot>
        </x-jet-dialog-modal>
        <!-- End Modal -->
    </div>
</div>

