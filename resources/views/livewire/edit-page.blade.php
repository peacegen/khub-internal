<div>
    <div class="mx-auto bg-gray-100 p-12 min-h-screen sm:w-8/12 md:w-9/12 lg:w-10/12">
        <section class="divide-y text-gray-900">
            <div class="col-span-6">
                <x-jet-label for="title" value="{{ __('Page Title') }}" />
                <x-jet-input id="title" class="block mt-1 w-full" type="text" wire:model.debounce.800ms="title" required />
                @error('title') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="col-span-6">
                <x-jet-label for="slug" value="{{ __('Slug') }}" />
                <x-jet-input id="slug" class="block mt-1 w-full" type="text" wire:model.debounce.800ms="slug" required />
                @error('slug') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4" wire:model.debounce.365ms="content" wire:ignore>
                <x-trix-field id="content" name="content" value=""/>
                @error('content') <span class="error">{{ $message }}</span> @enderror
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
        </section>
</div>

