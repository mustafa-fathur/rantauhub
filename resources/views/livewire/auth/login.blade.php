<x-layouts.auth.rantauhub>
    <div class="bg-white rounded-xl shadow-lg p-8 md:p-10">
        <!-- Title -->
        <h1 class="text-2xl md:text-3xl font-bold text-[#925E25] mb-2 text-center">Masuk Akun RantauHub</h1>

        <!-- Session Status -->
        <x-auth-session-status class="text-center mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login.store') }}" class="mt-8 space-y-6">
            @csrf

            <!-- Email Address -->
            <div>
                <input
                    type="email"
                    name="email"
                    id="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    autocomplete="email"
                    placeholder="Email"
                    class="w-full px-4 py-3 rounded-lg border border-secondary/30 bg-white text-zinc-900 placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-secondary/20 focus:border-secondary transition"
                />
                @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div class="relative">
                <input
                    type="password"
                    name="password"
                    id="password"
                    required
                    autocomplete="current-password"
                    placeholder="Kata Sandi"
                    class="w-full px-4 py-3 rounded-lg border border-secondary/30 bg-white text-zinc-900 placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-secondary/20 focus:border-secondary transition"
                />
                @error('password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="absolute top-0 right-0 text-sm text-primary hover:text-primary-600 transition mt-3 mr-4">
                        Lupa kata sandi
                    </a>
                @endif
            </div>

            <!-- Submit Button -->
            <button
                type="submit"
                class="w-full px-6 py-3 bg-primary text-white rounded-lg hover:bg-primary-600 transition font-semibold uppercase text-sm"
                data-test="login-button"
            >
                Masuk
            </button>
        </form>

        <!-- Register Link -->
        @if (Route::has('register'))
            <div class="mt-6 text-center text-sm">
                <span class="text-zinc-700">Belum punya akun? </span>
                <a href="{{ route('register') }}" class="text-primary hover:text-primary-600 font-medium transition">
                    Daftar
                </a>
            </div>
        @endif

        <!-- Back to Home Button -->
        <div class="mt-6 text-center">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 px-4 py-2 border border-primary text-primary rounded-lg hover:bg-primary hover:text-white transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali ke Beranda
            </a>
        </div>
    </div>
</x-layouts.auth.rantauhub>