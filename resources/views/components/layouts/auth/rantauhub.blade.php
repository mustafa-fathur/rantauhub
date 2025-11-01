<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
        <title>{{ $title ?? 'Auth' }} - {{ config('app.name', 'RantauHub') }}</title>
        @livewireStyles
    </head>
    <body class="min-h-screen">
        <section class="relative min-h-screen">
            <!-- Background -->
            <div class="absolute inset-0 -z-10">
                <img
                    src="{{ asset('assets/images/auth-background.png') }}"
                    alt="RantauHub Auth Background"
                    class="w-full h-full object-cover"
                >
                <!-- subtle wash to keep text legible -->
                <div class="absolute inset-0 bg-white/30"></div>
            </div>

            <!-- Content (align right on md+) -->
            <div class="container mx-auto px-4 min-h-screen flex items-center justify-center md:justify-end">
                <div class="w-full max-w-md md:mr-6 lg:mr-12">
                    {{ $slot }}
                </div>
            </div>
        </section>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireScripts
        @fluxScripts
    </body>
</html>

