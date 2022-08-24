<div>
    <div class="mt-4">
        <x-jet-label for="title" value="{{ __('Page Title') }}" />
        <x-jet-input id="title" class="block mt-1 w-full" type="text" wire:model.debounce.800ms="title" required />
        @error('title') <span class="error">{{ $message }}</span> @enderror
    </div>
    <div class="mt-4">
        <x-jet-label for="slug" value="{{ __('Slug') }}" />
        <x-jet-input id="slug" class="block mt-1 w-full" type="text" wire:model.debounce.800ms="slug" required />
        @error('slug') <span class="error">{{ $message }}</span> @enderror
    </div>
    <div class="mt-4">
        <label>
            <input class="form-checkbox" type="checkbox" value="{{ $isSetToDefaultHomePage }}" wire:model="isSetToDefaultHomePage"/>
            <span class="ml-2 text-sm text-gray-600">Set as the default home page</span>
        </label>
    </div>
    <div class="mt-4">
        <label>
            <input class="form-checkbox" type="checkbox" value="{{ $isSetToDefaultNotFoundPage }}" wire:model="isSetToDefaultNotFoundPage"/>
            <span class="ml-2 text-sm text-red-600">Set as the default 404 error page</span>
        </label>
    </div>
    <div class="mb-4" wire:model.debounce.365ms="content" wire:ignore>
        <x-trix-field id="content" name="content"/>
        @error('content') <span class="error">{{ $message }}</span> @enderror
    </div>
</div>
