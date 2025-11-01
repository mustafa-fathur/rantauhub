<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
        <title>{{ $title ?? config('app.name', 'RantauHub') }}</title>
        @livewireStyles
    </head>
    <body class="min-h-screen">
        <div class="relative min-h-screen flex items-center justify-center p-6 md:p-12">
            <!-- Full-bleed background image + overlay -->
            <img src="{{ asset('assets/images/auth-background.png') }}" alt="Auth Background" class="absolute inset-0 -z-10 w-full h-full object-cover">
            <div class="absolute inset-0 -z-10 bg-black/30"></div>

            <!-- Slot (auth card) -->
            <div class="w-full max-w-md">
                {{ $slot }}
            </div>
        </div>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireScripts
        @fluxScripts
    </body>
</html>

