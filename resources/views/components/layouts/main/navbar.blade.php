<!-- Header/Navigation -->
<header class="sticky top-0 z-50 bg-white shadow-sm border-b border-zinc-200">
    <nav class="container mx-auto px-4">
        <div class="flex items-center justify-between h-16">
            <!-- Logo -->
            <div class="flex items-center space-x-2">
                <a href="{{ route('home') }}" class="flex items-center space-x-2 hover:opacity-80 transition">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="RantauHub" class="h-10 w-10">
                    <span class="text-xl font-bold text-[#925E25]">RantauHub</span>
                </a>
            </div>
            
            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center space-x-8 flex-1 justify-center">
                <a href="{{ route('home') }}" class="font-medium transition {{ request()->routeIs('home') ? 'text-primary underline' : 'text-[#925E25] hover:text-primary' }}">
                    Home
                </a>
                <a href="{{ route('umkm') }}" class="font-medium transition {{ request()->routeIs('umkm') || request()->routeIs('umkm.*') ? 'text-primary underline' : 'text-[#925E25] hover:text-primary' }}">
                    Pendanaan UMKM
                </a>
                <a href="{{ route('mentor') }}" class="font-medium transition {{ request()->routeIs('mentor') || request()->routeIs('mentor.*') ? 'text-primary underline' : 'text-[#925E25] hover:text-primary' }}">
                    Mentor
                </a>
                <a href="{{ route('forum') }}" class="font-medium transition {{ request()->routeIs('forum') || request()->routeIs('forum.*') || request()->routeIs('my-forum') ? 'text-primary underline' : 'text-[#925E25] hover:text-primary' }}">
                    Forum
                </a>
                <a href="{{ route('about') }}" class="font-medium transition {{ request()->routeIs('about') ? 'text-primary underline' : 'text-[#925E25] hover:text-primary' }}">
                    Tentang
                </a>
            </div>

            <!-- Auth Buttons -->
            <div class="flex items-center space-x-4">
                @auth
                    <div class="relative group">
                        <button type="button" class="flex items-center space-x-2 focus:outline-none">
                            {{-- Avatar: show real profile photo if available, fallback to initials --}}
                            @php($user = auth()->user())
                            @if($user->profile_photo)
                                <img
                                    src="{{ asset('storage/' . $user->profile_photo) }}"
                                    alt="{{ $user->name }}"
                                    class="w-10 h-10 rounded-full object-cover border-2 border-zinc-200"
                                >
                            @else
                                <div class="w-10 h-10 rounded-full bg-primary text-white flex items-center justify-center">
                                    <span class="text-sm font-semibold">{{ $user->initials() }}</span>
                                </div>
                            @endif
                        </button>
                        <!-- Dropdown Menu -->
                        <div class="absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-lg border border-zinc-200 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                            <div class="p-2">
                                <div class="px-3 py-2 border-b border-zinc-200">
                                    <p class="text-sm font-semibold text-zinc-900">{{ auth()->user()->name }}</p>
                                    <p class="text-xs text-zinc-600">{{ auth()->user()->email }}</p>
                                </div>
                                @if(auth()->user()->isAdmin())
                                    <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 text-sm text-zinc-700 hover:bg-zinc-100 rounded">Admin Dashboard</a>
                                    <a href="{{ route('profile.edit') }}" class="block px-3 py-2 text-sm text-zinc-700 hover:bg-zinc-100 rounded">Settings</a>
                                @else
                                    <a href="{{ route('dashboard') }}" class="block px-3 py-2 text-sm text-zinc-700 hover:bg-zinc-100 rounded">Dashboard</a>
                                @endif
                                <div class="border-t border-zinc-200 my-1"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-3 py-2 text-sm text-red-600 hover:bg-red-50 rounded">Logout</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="px-4 py-2 text-[#925E25] hover:text-primary transition font-medium">Masuk</a>
                    <a href="{{ route('register') }}" class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-primary-600 transition font-medium">Daftar</a>
                @endauth
            </div>

            <!-- Mobile Menu Toggle -->
            <button type="button" class="md:hidden p-2 text-[#925E25] hover:text-primary" id="mobile-menu-button">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>
    </nav>
</header>