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
        <!-- Script stack -->
        @stack('scripts')
        <!-- Select script -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <script src="{{ asset("assets/js/pharaonic.select2.js") }}"></script>

        <!-- Carousel Style -->
        @yield('carousel-styles')

        <!-- Styles -->

        <x-rich-text-trix-styles />
        @livewireStyles

        <!-- Stacked Styles -->
        @stack('styles')


    </head>
    <body class="font-sans antialiased">
        <x-jet-banner />

        <div class="flex flex-col min-h-screen bg-gray-100">
            <!-- Nav Menu -->
            @livewire('nav-menu')
            <!-- End Nav Menu -->
            <div>
                <!-- Page Content -->
                <main>
                    {{ $slot }}
                </main>
            </div>
            <x-footer/>
        </div>

        @stack('modals')


    </body>
    @livewireScripts
    @yield('scripts')
</html>
