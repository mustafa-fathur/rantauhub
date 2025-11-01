<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
        <title>{{ $title ?? config('app.name', 'RantauHub') }} - Smart Solution for West Sumatra Sustainability</title>
        @livewireStyles
    </head>
    <body class="bg-white min-h-screen flex flex-col">
        <!-- Navbar -->
        <x-layouts.main.navbar />
        
        <!-- Dashboard Content Area -->
        <div class="flex-1 bg-zinc-50">
            @yield('content')
        </div>

        <!-- Footer -->
        <x-layouts.main.footer />

        <!-- Mobile Menu Drawer -->
        <div id="mobile-menu" class="fixed inset-0 z-50 hidden md:hidden">
            <div class="fixed inset-0 bg-black/50" id="mobile-menu-overlay"></div>
            <div class="fixed top-0 right-0 h-full w-80 bg-white shadow-xl transform translate-x-full transition-transform duration-300" id="mobile-menu-drawer">
                <div class="p-4">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-semibold text-primary">Menu</h2>
                        <button type="button" id="mobile-menu-close" class="text-zinc-600 hover:text-primary">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    <nav class="space-y-2">
                        <a href="{{ route('dashboard') }}" class="block px-4 py-2 rounded-lg {{ request()->routeIs('dashboard') ? 'bg-primary text-white' : 'text-zinc-700 hover:bg-zinc-100' }}">Dashboard</a>
                        <a href="{{ route('my-forum') }}" class="block px-4 py-2 rounded-lg {{ request()->routeIs('my-forum') ? 'bg-primary text-white' : 'text-zinc-700 hover:bg-zinc-100' }}">Forum Saya</a>
                        <!-- Note: Settings/Profile is admin-only -->
                        <div class="border-t border-zinc-200 my-2"></div>
                        <a href="{{ route('home') }}" class="block px-4 py-2 rounded-lg text-zinc-700 hover:bg-zinc-100">Home</a>
                    </nav>
                </div>
            </div>
        </div>

        <script>
            // Mobile menu toggle
            document.getElementById('mobile-menu-button')?.addEventListener('click', function() {
                const menu = document.getElementById('mobile-menu');
                const drawer = document.getElementById('mobile-menu-drawer');
                menu?.classList.remove('hidden');
                setTimeout(() => {
                    drawer?.classList.remove('translate-x-full');
                }, 10);
            });

            document.getElementById('mobile-menu-close')?.addEventListener('click', function() {
                const menu = document.getElementById('mobile-menu');
                const drawer = document.getElementById('mobile-menu-drawer');
                drawer?.classList.add('translate-x-full');
                setTimeout(() => {
                    menu?.classList.add('hidden');
                }, 300);
            });

            document.getElementById('mobile-menu-overlay')?.addEventListener('click', function() {
                const menu = document.getElementById('mobile-menu');
                const drawer = document.getElementById('mobile-menu-drawer');
                drawer?.classList.add('translate-x-full');
                setTimeout(() => {
                    menu?.classList.add('hidden');
                }, 300);
            });
        </script>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireScripts
    </body>
</html>
