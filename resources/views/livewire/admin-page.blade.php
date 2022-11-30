<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 w-2/5 items-center">
    <ul class="text-gray-900 text-lg text-center mt-8 bg-primary-100 overflow-hidden shadow-xl max-w-7xl sm:rounded-lg mx-auto">
    @can('edit-pages')
        <a href={{ route('edit-pages') }}>
            <li class="cursor-pointer px-4 py-2 mt-2 transition hover:bg-primary-200">{{ __('Pages') }}</li>
        </a>
    @endcan
    @can('edit-users')
    <a href={{ route('edit-users') }}>
        <li class="cursor-pointer px-4 py-2 transition hover:bg-primary-200">{{ __('Users') }}</li>
    </a>
    @endcan
    @can('edit-roles')
    <a href={{ route('edit-roles') }}>
        <li class="cursor-pointer px-4 py-2 transition hover:bg-primary-200">{{ __('Roles') }}</li>
    </a>
    @endcan
    @can('edit-tags')
    <a href={{ route('edit-tags') }}>
        <li class="cursor-pointer px-4 py-2 mb-2 transition hover:bg-primary-200">{{ __('Tags') }}</li>
    </a>
    @endcan
    </ul>
</div>
