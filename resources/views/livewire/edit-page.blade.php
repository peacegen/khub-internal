<div>
    <div class="mx-auto bg-gray-100 p-12 min-h-screen sm:w-8/12 md:w-9/12 lg:w-10/12">
        <section class="text-gray-900">
            <div class="mb-4">
                <x-jet-label for="title" value="{{ __('Page Title') }}" />
                <x-jet-input id="title" class="block mt-1 w-full" type="text" wire:model.debounce.800ms="title" required />
                @error('title') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <x-jet-label for="slug" value="{{ __('Slug') }}" />
                <x-jet-input id="slug" class="block mt-1 w-full" type="text" wire:model.debounce.800ms="slug" required />
                @error('slug') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4" wire:model.debounce.365ms="content" wire:ignore>
                <x-jet-label for="content" value="{{ __('Content') }}" />
                <x-trix-field id="content" name="content" value="{!! $page->content->toTrixHtml() !!}"/>
                @error('content') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
            @isset($tag_list)
                <x-jet-label for="tags" value="{{ __('Tags') }}" />
                <div wire:ignore>
                    <select data-pharaonic="select2" multiple data-component-id="{{ $this->id }}" wire:model="tags">
                        @foreach ($tag_list as $tag)
                        <option value="{{ $tag }}">{{ $tag }}</option>
                        @endforeach
                    </select>
                </div>
                {{-- <select class="select2" multiple wire:model="tags">
                    @foreach ($tag_list as $tag)
                        <option value="{{ $tag }}">{{ $tag }}</option>
                    @endforeach
                </select> --}}
            @endisset
            </div>
            <div class="mb-3">
                <x-jet-label for="thumbnail" value="{{ __('Thumbnail') }}" />
                <input type="file" wire:model="thumbnail" class="">
                <div>
                    @error('thumbnail') <span class="text-sm text-red-500 italic">{{ $message }}</span>@enderror
                </div>
                <div wire:loading wire:target="thumbnail" class="text-sm italic">Uploading...</div>
            </div>
            @if (!$is_new)
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

