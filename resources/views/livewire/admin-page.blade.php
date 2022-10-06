<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 w-2/3 items-center">
    <ul class="text-gray-900 text-lg bg-primary-100 text-center">
    <a href={{ route('edit-pages') }}>
        <li class="cursor-pointer px-4 py-2 hover:bg-primary-200">{{ __('Pages') }}</li>
    </a>
    <a href={{ route('edit-users') }}>
        <li class="cursor-pointer px-4 py-2 hover:bg-primary-200">{{ __('Users') }}</li>
    </a>
    <a href={{ route('edit-roles') }}>
        <li class="cursor-pointer px-4 py-2 hover:bg-primary-200">{{ __('Roles') }}</li>
    </a>
    <a href={{ route('edit-tags') }}>
        <li class="cursor-pointer px-4 py-2 hover:bg-primary-200">{{ __('Tags') }}</li>
    </ul>
</div>
