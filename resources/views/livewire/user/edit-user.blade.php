<div>
    <div class="mx-auto bg-gray-100 p-12 sm:w-8/12 md:w-9/12 lg:w-10/12">
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
            <div class="mb-4">
            @isset($tag_list)
                <x-jet-label for="tags" value="{{ __('Tags') }}" />
                <div wire:ignore >
                    <select data-pharaonic="select2" data-width="element" multiple data-component-id="{{ $this->id }}" wire:model="tags">
                        <option value="">{{ __('Select a tag...') }}</option>
                        @foreach (\Spatie\Permission\Models\Role::all() as $role)
                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
            @endisset
            </div>
            @if (true)
                <x-jet-button class="" wire:click="update" wire:loading.attr="disabled">
                    {{ __('Update') }}
                </x-jet-button>
            @else
                <x-jet-button class="" wire:click="create" wire:loading.attr="disabled">
                    {{ __('Create') }}
                </x-jet-button>
            @endif
        </section>
    </div>
</div>

