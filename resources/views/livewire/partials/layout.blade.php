<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="rantauhub">
    <head>
        @include('partials.head')
        <title>{{ $title ?? config('app.name', 'RantauHub') }} - Smart Solution for West Sumatra Sustainability</title>
        @livewireStyles
    </head>
    <body class="bg-base-100 min-h-screen flex flex-col">
        <!-- Drawer Wrapper for Mobile Menu -->
        <div class="drawer drawer-end">
            <input id="mobile-menu-drawer" type="checkbox" class="drawer-toggle" />
            
            <!-- Main Content Area -->
            <div class="drawer-content flex flex-col min-h-screen">
                <!-- Navbar -->
                @include('livewire.partials.navbar')
                
                <!-- Main Content -->
                <main class="flex-1">
                    {{ $slot ?? '' }}
                </main>

                <!-- Footer -->
                @include('livewire.partials.footer')
            </div>

            <!-- Mobile Navigation Drawer Sidebar -->
            <div class="drawer-side">
                <label for="mobile-menu-drawer" class="drawer-overlay lg:hidden"></label>
                <ul class="menu bg-base-100 w-80 p-4 text-base-content min-h-full lg:hidden">
                    <li class="menu-title">
                        <span>Menu</span>
                    </li>
                    <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
                    <li><a href="#umkm">UMKM</a></li>
                    <li><a href="#mentor">Mentor</a></li>
                    <li><a href="#forum">Forum</a></li>
                    <li><a href="#investasi">Investasi</a></li>
                    <li><a href="#tentang">Tentang</a></li>
                    @auth
                        <li><div class="divider my-2"></div></li>
                        <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li><a href="{{ route('profile.edit') }}">Profile</a></li>
                    @endauth
                </ul>
            </div>
        </div>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireScripts
    </body>
</html>

