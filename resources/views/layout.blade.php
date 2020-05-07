<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}">

        <title>ARK Blockchain Explorer</title>

        <!-- Styles -->
        <link href="{{ mix('css/app.css') }}" rel="stylesheet">
        <livewire:styles>

    </head>
    <body>
        <main class="theme-light bg-theme-page-background text-theme-text-content min-h-screen font-sans xl:pt-8">

            <!-- Top navigation -->
            <div class="sticky-top">@livewire('navigation')</div>

            <div class="max-w-2xl mx-auto md:pt-5">

                <!-- Content top section -->
                <div class="px-5">
                    <!-- Page title -->
                    <h1 class="text-2xl md:text-3xl mb-5 md:mb-6 text-theme-text-primary sm:mr-5">
                        @yield('page-title')
                    </h1>
                </div>

                <!-- Main content section -->
                <div class="main-content mb-5 py-5 md:py-10 md:rounded-lg">
                    <div class="px-5 sm:px-10">
                        @yield('content')
                    </div>
                </div>
            </div>

            <!-- Scripts -->
            <script src="{{ mix('js/app.js') }}"></script>
            <livewire:scripts>

        </main>
    </body>
</html>
