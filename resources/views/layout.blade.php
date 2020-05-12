<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="turbolinks-cache-control" content="no-cache">
        <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}">

        <title>ARK Blockchain Explorer</title>

        <!-- Styles -->
        <link href="{{ mix('css/app.css') }}" rel="stylesheet">
        <livewire:styles>

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}"></script>
        <livewire:scripts>
    </head>
    <body>
        <main class="theme-light bg-theme-page-background text-theme-text-content min-h-screen font-sans xl:pt-8">

            <!-- Top navigation -->
            <div class="sticky-top">@livewire('navigation')</div>

            <div class="max-w-2xl mx-auto md:pt-5">

                <!-- Content top section -->
                <div>@yield('content-top')</div>

                <!-- Main content section -->
                <div>@yield('content')</div>
            </div>

            <div class="network-problem-msg" wire:offline>
                Problem with the network connection
            </div>
        </main>
    </body>
</html>