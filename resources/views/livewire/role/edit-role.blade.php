<div>
    <div class="mx-auto bg-gray-100 p-12 sm:w-8/12 md:w-9/12 lg:w-10/12">
        <section class="text-gray-900">
            <div class="mb-4">
                <x-jet-label for="name" value="{{ __('Name') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" wire:model.debounce.800ms="name" required />
                @error('name') <span class="error">{{ $message }}</span> @enderror
            </div>
            @isset($permissions_list)
            <div class="mb-4">
                <x-jet-label for="roles" value="{{ __('Role') }}" />
                <div wire:ignore >
                    <select data-pharaonic="select2" data-width="element" data-component-id="{{ $this->id }}" wire:model="role">
                        <option value="">{{ __('Select a role...') }}</option>
                        @foreach($permission_list as $permission)
                            <option value="{{ $permission->id }}">{{ $permission->name }}</option>
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

