<div class="p-6">
    <div class="flex items-center">
    <a href="{{ route('admin') }}" class="text-blue-500 hover:text-blue-700 mb-4 inline-block">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 fill-black" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path>
        </svg>
    </a>
    </div>
    {{-- The data table --}}
    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-4 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">{{ __("Name") }}</th>
                                <th class="px-4 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">{{ __("Email") }}</th>
                                <th class="px-4 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">{{ __("Role") }}</th>
                                <th class="px-4 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">{{ __("Teams") }}</th>
                                <th class="px-4 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">{{ __("Actions") }}</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @if ($data->count())
                                @foreach ($data as $item)
                                    <tr>
                                        <td class="px-4 py-2">{{ $item->name }}</td>
                                        <td class="px-4 py-2">{{ $item->email }}</td>
                                        <td class="px-4 py-2">{{ $item->getRoleNames()[0] ?? '' }}</td>
                                        <td class="px-4 py-2">{{ $item->team }}</td>
                                        <td class="px-4 py-2 flex">
                                            <x-jet-button wire:click="update({{ $item->id }})">
                                                {{ __('Update') }}
                                            </x-jet-button>
                                            <x-jet-danger-button class="ml-2" wire:click="deleteShowModal({{ $item->id }})">
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
                </div>
            </div>
        </div>
    </div>

    <div class="mt-5">
    {{ $data->links() }}
    </div>

    {{-- The Delete Modal --}}
    <x-jet-dialog-modal wire:model="modalConfirmDeleteVisible">
        <x-slot name="title">
            {{ __('Delete Modal Title') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to delete this item?') }}
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('modalConfirmDeleteVisible')" wire:loading.attr="disabled">
                {{ __('Nevermind') }}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-2" wire:click="delete" wire:loading.attr="disabled">
                {{ __('Delete Item') }}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
