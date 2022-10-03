<!DOCTYPE html>
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
        @stack('scripts')

        <!-- Scripts -->
        @yield('carousel-styles')

        <!-- Styles -->

        <x-rich-text-trix-styles />
        @livewireStyles

        <!-- Stacked Styles -->
        @stack('styles')




    </head>
    <body class="font-sans antialiased">
        <x-jet-banner />

        @hasrole('admin|super-admin')
        <x-admin-menu/>

        @else

        <x-nav-menu/>
        @endhasrole

        <div class="min-h-screen bg-gray-100">
            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

    </body>
    @livewireScripts
</html>
