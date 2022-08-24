<div class="p-6">
    <div class="flex items-center justify-end">
        <x-jet-button wire:click="createShowModal">
            {{ __('Create') }}
        </x-jet-button>
    </div>

    <!-- The data table -->

    <table class="min-w-full divide-y divide-gray-200">
        <thead>
        <tr>
            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Title</th>
            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Link</th>
            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Content</th>
            <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Action</th>
        </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
        @if ($data->count())
        @foreach ($data as $item)
        <tr>
            <td class="px-6 py-4 text-sm whitespace-no-wrap">
                {{ $item->title }}
                {!! $item->is_default_home ? '<span class="text-green-400 text-xs font-bold">[Default Home Page]</span>':''!!}
                {!! $item->is_default_not_found ? '<span class="text-red-400 text-xs font-bold">[Default 404 Page]</span>':''!!}
            </td>
            <td class="px-6 py-4 text-sm whitespace-no-wrap">
                <a
                    class="text-indigo-600 hover:text-indigo-900"
                    target="_blank"
                    href="{{ URL::to('/'.$item->slug)}}"
                >
                    {{ $item->slug }}
                </a>
            </td>
            <td class="px-6 py-4 text-sm whitespace-no-wrap">{!! \Illuminate\Support\Str::limit($item->content->toPlainText(), 50, '...') !!}</td>
            <td class="px-6 py-4 text-right text-sm">
                <x-jet-button wire:click="updateShowModal({{ $item->id }})">
                    {{ __('Update') }}
                </x-jet-button>
                <x-jet-danger-button wire:click="deleteShowModal({{ $item->id }})">
                    {{ __('Delete') }}
                </x-jet-danger-button>
            </td>
        </tr>
        @endforeach
        @else
        <tr>
            <td class="px-6 py-4 text-sm whitespace-no-wrap" colspan="4">No Results Found</td>
        </tr>
        @endif
        </tbody>
    </table>

    {{ $data->links() }}

    <!--    Modal Form-->
    <x-jet-dialog-modal wire:model="modalFormVisible">
        <x-slot name="title">
            {{ __('Save Page') }}
        </x-slot>

        <x-slot name="content">
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
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('modalFormVisible')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>
            @if ($modelId)
                <x-jet-button class="ml-2" wire:click="update" wire:loading.attr="disabled">
                    {{ __('Update') }}
                </x-jet-button>
            @else
                <x-jet-button class="ml-2" wire:click="create" wire:loading.attr="disabled">
                    {{ __('Create') }}
                </x-jet-button>
            @endif


        </x-slot>
    </x-jet-dialog-modal>


    <!--    Delete confirmation modal-->
    <x-jet-dialog-modal wire:model="modalConfirmDeleteVisible">
        <x-slot name="title">
            {{ __('Delete Account') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to delete this page?') }}
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('modalConfirmDeleteVisible')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-3" wire:click="delete" wire:loading.attr="disabled">
                {{ __('Delete Page') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>

    {{-- <script>
        function uploadTrixAttachment(attachment) {
            //upload with livewire
            @this.upload('newFiles',
            attachment.file,
            function (uploadedUrl) {
                const eventName = "trix-upload-completed:${btoa(uploadedUrl)}";
                const listener = function (event) {
                    attachment.setAttributes(event.detail);
                    window.removeEventListener(eventName, listener);
                }

                window.addEventListener(eventName, listener);

                @this.call('completeUpload', uploadedUrl, eventName);
            },
            function () {},
            function (event) {
                attachment.setUploadProgress(event.detail.progress);
            }

            );
        }
        </script> --}}
</div>


