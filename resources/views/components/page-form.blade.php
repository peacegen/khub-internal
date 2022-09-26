<div>
    <x-jet-form-section submit="createPage">
        <x-slot name="title">
            {{ __('Save Page') }}
        </x-slot>

        <x-slot name="description">
            {{ __('Create a new page.') }}
        </x-slot>


        <x-slot name="form">
            <div class="col-span-6">
                {{ $title }}
                <x-jet-label for="title" value="{{ __('Page Title') }}" />
                <x-jet-input id="title" class="block mt-1 w-full" type="text" wire:model.debounce.800ms="page.title" required />
                @error('title') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="col-span-6">
                {{ $slug }}
                <x-jet-label for="slug" value="{{ __('Slug') }}" />
                <x-jet-input id="slug" class="block mt-1 w-full" type="text" wire:model.debounce.800ms="page.slug" required />
                @error('slug') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div>
            @isset($tag_list)
                <div wire:ignore>
                    <select data-pharaonic="select2" multiple data-component-id="{{ $this->id }}" wire:model="tags">
                        @foreach ($tag_list() as $tag)
                            <option value="{{ $tag }}">{{ $tag }}</option>
                        @endforeach
                    </select>
                </div>
            @endisset
            </div>
        </x-slot>

        <x-slot name="actions">
            <x-jet-secondary-button wire:click="cancel" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>
            @isset ($page->id)
                <x-jet-button class="ml-2" wire:click="update" wire:loading.attr="disabled">
                    {{ __('Update') }}
                </x-jet-button>
            @else
                <x-jet-button class="ml-2" wire:click="create" wire:loading.attr="disabled">
                    {{ __('Create') }}
                </x-jet-button>
            @endisset
        </x-slot>


    </x-jet-form-section>
</div>
