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
                <x-jet-label for="permissions" value="{{ __('Permissions') }}" />
                <div wire:ignore >
                    <select data-pharaonic="select2" multiple data-component-id="{{ $this->id }}" wire:model="permissions">
                        @foreach($permissions_list as $permission)
                            <option value="{{ $permission->name }}">{{ Str::title($permission->name) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            @endisset
            @if ($isNew)
            <x-jet-button class="" wire:click="create" wire:loading.attr="disabled">
                {{ __('Create') }}
            </x-jet-button>
            @else
            <x-jet-button class="" wire:click="update" wire:loading.attr="disabled">
                {{ __('Update') }}
            </x-jet-button>
            @endif
        </section>
    </div>
</div>

