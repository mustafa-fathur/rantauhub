<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
        <title>{{ $title ?? config('app.name', 'RantauHub') }}</title>
        @livewireStyles
    </head>
    <body class="min-h-screen bg-white">
        <div class="min-h-screen flex">
            <!-- Left Section - Logo & Background -->
            <div class="hidden lg:flex lg:w-1/2 relative items-center justify-center bg-white overflow-hidden">
                <!-- Decorative Curved Shapes -->
                <div class="absolute top-0 left-0 w-full h-full">
                    <!-- Top Left Curve -->
                    <svg class="absolute top-0 left-0" width="400" height="400" viewBox="0 0 400 400" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0,0 Q200,100 400,0 L400,400 Q200,300 0,400 Z" fill="#1a1a1a" opacity="0.1"/>
                    </svg>
                    <!-- Bottom Left Curve -->
                    <svg class="absolute bottom-0 left-0" width="500" height="500" viewBox="0 0 500 500" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0,500 Q250,400 500,500 L500,0 Q250,100 0,0 Z" fill="#925E25" opacity="0.15"/>
                    </svg>
                </div>
                
                <!-- Logo Container -->
                <div class="relative z-10 flex flex-col items-center">
                    <div class="w-48 h-48 rounded-full bg-primary flex items-center justify-center shadow-2xl">
                        <div class="flex flex-col items-center">
                            <!-- Logo Image -->
                            <img src="{{ asset('assets/images/logo.png') }}" alt="RantauHub Logo" class="w-32 h-32 object-contain">
                            <!-- RANTAU Text -->
                            <span class="text-3xl font-bold text-secondary mt-3 tracking-wide">RANTAU</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Section - Form -->
            <div class="flex-1 lg:w-1/2 flex items-center justify-center bg-[#F5F1E8] p-6 md:p-12">
                <div class="w-full max-w-md">
                    {{ $slot }}
                </div>
            </div>
        </div>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireScripts
        @fluxScripts
    </body>
</html>

