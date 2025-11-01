<x-layouts.auth.rantauhub>
    <div class="bg-white rounded-xl shadow-lg p-8 md:p-10">
        <!-- Title -->
        <h1 class="text-2xl md:text-3xl font-bold text-[#925E25] mb-2 text-center">Daftar Akun RantauHub</h1>

        <!-- Session Status -->
        <x-auth-session-status class="text-center mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('register.store') }}" class="mt-8 space-y-6">
            @csrf

            <!-- Name -->
            <div>
                <input
                    type="text"
                    name="name"
                    id="name"
                    value="{{ old('name') }}"
                    required
                    autofocus
                    autocomplete="name"
                    placeholder="Nama Lengkap"
                    class="w-full px-4 py-3 rounded-lg border border-secondary/30 bg-white text-zinc-900 placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-secondary/20 focus:border-secondary transition"
                />
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email Address -->
            <div>
                <input
                    type="email"
                    name="email"
                    id="email"
                    value="{{ old('email') }}"
                    required
                    autocomplete="email"
                    placeholder="Email"
                    class="w-full px-4 py-3 rounded-lg border border-secondary/30 bg-white text-zinc-900 placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-secondary/20 focus:border-secondary transition"
                />
                @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <input
                    type="password"
                    name="password"
                    id="password"
                    required
                    autocomplete="new-password"
                    placeholder="Kata Sandi"
                    class="w-full px-4 py-3 rounded-lg border border-secondary/30 bg-white text-zinc-900 placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-secondary/20 focus:border-secondary transition"
                />
                @error('password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div>
                <input
                    type="password"
                    name="password_confirmation"
                    id="password_confirmation"
                    required
                    autocomplete="new-password"
                    placeholder="Konfirmasi Kata Sandi"
                    class="w-full px-4 py-3 rounded-lg border border-secondary/30 bg-white text-zinc-900 placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-secondary/20 focus:border-secondary transition"
                />
            </div>

            <!-- Phone Number -->
            <div>
                <input
                    type="tel"
                    name="phone"
                    id="phone"
                    value="{{ old('phone') }}"
                    autocomplete="tel"
                    placeholder="No. HP"
                    class="w-full px-4 py-3 rounded-lg border border-secondary/30 bg-white text-zinc-900 placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-secondary/20 focus:border-secondary transition"
                />
                @error('phone')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <button
                type="submit"
                class="w-full px-6 py-3 bg-primary text-white rounded-lg hover:bg-primary-600 transition font-semibold uppercase text-sm"
                data-test="register-user-button"
            >
                Daftar
            </button>
        </form>

        <!-- Login Link -->
        <div class="mt-6 text-center text-sm">
            <span class="text-zinc-700">Sudah punya akun? </span>
            <a href="{{ route('login') }}" class="text-primary hover:text-primary-600 font-medium transition">
                Masuk
            </a>
        </div>
    </div>
</x-layouts.auth.rantauhub>
