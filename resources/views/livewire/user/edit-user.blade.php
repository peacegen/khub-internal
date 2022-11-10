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
            {{-- @endisset --}}
            </div>
            @endisset
            @isset($team_list)
            <div class="mb-4">
                <x-jet-label for="teams" value="{{ __('Teams') }}" />
                <div wire:ignore >
                    <select data-pharaonic="select2" multiple data-width="element" data-component-id="{{ $this->id }}" wire:model="teams">
                        <option value="">{{ __('Select teams...') }}</option>
                        @foreach($team_list as $team)
                            <option value="{{ $team->id }}">{{ $team->name }}</option>
                        @endforeach
                    </select>
                </div>
            {{-- @endisset --}}
            </div>
            @endisset
            <x-jet-button class="" wire:click="update" wire:loading.attr="disabled">
                {{ __('Update') }}
            </x-jet-button>
        </section>
    </div>
</div>

