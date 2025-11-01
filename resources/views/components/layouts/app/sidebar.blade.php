    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
        <title>{{ $title ?? config('app.name', 'RantauHub') }} - Admin Dashboard</title>
        @livewireStyles
    </head>
    <body class="min-h-screen bg-zinc-50">
        <div class="flex min-h-screen">
            <!-- Sidebar -->
            <aside class="hidden lg:block w-64 bg-white border-r border-zinc-200 shadow-sm flex flex-col fixed top-0 left-0 h-screen overflow-y-auto">
                <!-- Logo Section -->
                <div class="p-6 border-b border-zinc-200">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-2 hover:opacity-80 transition">
                        <img src="{{ asset('assets/images/logo.png') }}" alt="RantauHub" class="h-10 w-10">
                        <span class="text-xl font-bold text-primary">RantauHub</span>
                    </a>
                </div>

                <!-- User Profile Section -->
                <div class="p-6 border-b border-zinc-200">
                    <div class="flex flex-col items-center">
                        <img src="{{ asset('assets/images/admin.png') }}" alt="{{ auth()->user()->name }}" class="w-16 h-16 rounded-full object-cover mb-3 border-2 border-zinc-200">
                        <h3 class="text-base font-semibold text-zinc-900 text-center">{{ auth()->user()->name }}</h3>
                        <p class="text-xs text-zinc-600 mt-1 text-center">{{ auth()->user()->email }}</p>
                    </div>
                </div>

                <!-- Navigation Menu -->
                <nav class="flex-1 p-4 space-y-4 overflow-y-auto">
                    <!-- Platform Section -->
                    <div>
                        <h4 class="text-xs font-semibold text-zinc-500 uppercase tracking-wider mb-2 px-4">{{ __('Platform') }}</h4>
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-primary text-white' : 'text-zinc-700 hover:bg-zinc-100' }} transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                            </svg>
                            <span class="font-medium">{{ __('Dashboard') }}</span>
                        </a>
                    </div>

                    <!-- Verifikasi Section -->
                    <div>
                        <h4 class="text-xs font-semibold text-zinc-500 uppercase tracking-wider mb-2 px-4">Verifikasi</h4>
                        <div class="space-y-1">
                            <a href="{{ route('admin.verify-umkm') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.verify-umkm') ? 'bg-primary text-white' : 'text-zinc-700 hover:bg-zinc-100' }} transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                                <span class="font-medium">Verifikasi UMKM</span>
                            </a>
                            <a href="{{ route('admin.verify-mentor') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.verify-mentor') ? 'bg-primary text-white' : 'text-zinc-700 hover:bg-zinc-100' }} transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                <span class="font-medium">Verifikasi Mentor</span>
                            </a>
                            <a href="{{ route('admin.verify-funder') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.verify-funder') ? 'bg-primary text-white' : 'text-zinc-700 hover:bg-zinc-100' }} transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-1-1.732l-4-2.309a2 2 0 00-1.732 0l-4 2.309A2 2 0 001 11.269V19a2 2 0 002 2h14a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                                <span class="font-medium">Verifikasi Funder</span>
                            </a>
                            <a href="{{ route('admin.verify-funding') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.verify-funding') ? 'bg-primary text-white' : 'text-zinc-700 hover:bg-zinc-100' }} transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="font-medium">Verifikasi Pendanaan</span>
                            </a>
                        </div>
                    </div>

                    <!-- Manajemen Section -->
                    <div>
                        <h4 class="text-xs font-semibold text-zinc-500 uppercase tracking-wider mb-2 px-4">Manajemen</h4>
                        <a href="{{ route('admin.forum-category') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.forum-category') ? 'bg-primary text-white' : 'text-zinc-700 hover:bg-zinc-100' }} transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                            <span class="font-medium">Kategori Forum</span>
                        </a>
                    </div>
                </nav>

                <!-- Bottom Section -->
                <div class="p-4 border-t border-zinc-200 bg-white">
                    <div class="relative group">
                        <button type="button" class="flex items-center justify-between w-full px-4 py-3 rounded-lg text-zinc-700 hover:bg-zinc-100 transition">
                            <div class="flex items-center space-x-3">
                                <img src="{{ asset('assets/images/admin.png') }}" alt="{{ auth()->user()->name }}" class="w-8 h-8 rounded-full object-cover">
                                <div class="text-left">
                                    <p class="text-sm font-semibold text-zinc-900">{{ auth()->user()->name }}</p>
                                    <p class="text-xs text-zinc-600">Admin</p>
                                </div>
                            </div>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        
                        <!-- Dropdown Menu -->
                        <div class="absolute bottom-full left-0 mb-2 w-full bg-white rounded-lg shadow-lg border border-zinc-200 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                            <div class="p-2">
                                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-zinc-700 hover:bg-zinc-100 rounded-lg transition">{{ __('Settings') }}</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 rounded-lg transition">
                                        {{ __('Log Out') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </aside>

            <!-- Main Content Area -->
            <div class="flex-1 flex flex-col min-h-screen lg:ml-64">
                <!-- Mobile Header -->
                <header class="lg:hidden bg-white border-b border-zinc-200 shadow-sm sticky top-0 z-50">
                    <div class="flex items-center justify-between px-4 h-16">
                        <div class="flex items-center space-x-2">
                            <img src="{{ asset('assets/images/logo.png') }}" alt="RantauHub" class="h-8 w-8">
                            <span class="text-lg font-bold text-primary">RantauHub</span>
                        </div>
                        <button type="button" id="mobile-sidebar-toggle" class="p-2 text-zinc-700 hover:text-primary">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>
                    </div>
                </header>

                <!-- Main Content -->
                <main class="flex-1 bg-zinc-50">
                    <div class="container mx-auto px-4 py-8">
                        {{ $slot }}
                    </div>
                </main>
            </div>
        </div>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireScripts
        @fluxScripts
    </body>
</html>
