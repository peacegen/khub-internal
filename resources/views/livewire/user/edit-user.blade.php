<div>
    <div class="mx-auto bg-gray-100 p-12 sm:w-8/12 md:w-9/12 lg:w-10/12">
        <a href="{{ route('edit-users') }}" class="text-blue-500 hover:text-blue-700 mb-4 inline-block">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 fill-black" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path>
        </svg>
        </a>
        <section class="text-gray-900">
            <div class="mb-4">
                <x-jet-label for="name" value="{{ __('Name') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" wire:model.debounce.800ms="name" required />
                @error('name') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="text" wire:model.debounce.800ms="email" required />
                @error('email') <span class="error">{{ $message }}</span> @enderror
            </div>
            @isset($role_list)
            <div class="mb-4">
                <x-jet-label for="roles" value="{{ __('Role') }}" />
                <div wire:ignore >
                    <select data-pharaonic="select2" data-width="element" data-component-id="{{ $this->id }}" wire:model="role">
                        <option value="">{{ __('Select a role...') }}</option>
                        @foreach($role_list as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            @endisset
            <x-jet-button class="" wire:click="update" wire:loading.attr="disabled">
                {{ __('Update') }}
            </x-jet-button>
        </section>
    </div>
</div>

