<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @trixassets

        <!-- Styles -->
        @livewireStyles
    </head>
    <body>
        <div class="min-h-screen bg-gray-100">
            {{-- //TODO Remove this and have a better top menu --}}
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                @if (Route::has('login'))
                    <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                        @auth
                            <a href="{{ url('/pages') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">{{ __('Pages') }}</a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">{{ __('Log in') }}</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">{{ __('Register') }}</a>
                            @endif
                        @endauth
                    </div>
                @endif
            </div>
            <h1>{{ $title }}</h1>
            {!! $content->render() !!}
        </div>
    </body>
</html>
