<!-- Login Modal -->
<div id="loginModal" class="hidden fixed inset-0 z-50 overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4">
        <!-- Backdrop -->
        <div class="fixed inset-0 bg-black/60 backdrop-blur-sm" onclick="closeLoginModal()"></div>
        
        <!-- Modal -->
        <div class="relative bg-white rounded-2xl shadow-2xl max-w-md w-full p-8 transform transition-all animate-modal-in">
            <!-- Close Button -->
            <button onclick="closeLoginModal()" class="absolute top-4 right-4 text-zinc-400 hover:text-zinc-600 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>

            <!-- Header -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-primary/10 rounded-full mb-4">
                    <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-primary mb-2">Masuk ke Akun Anda</h2>
                <p class="text-sm text-zinc-600">Silakan masuk untuk melanjutkan aksi ini</p>
            </div>

            <!-- Login Form -->
            <form method="POST" action="{{ route('login.store') }}" class="space-y-4">
                @csrf
                
                <!-- Redirect after login -->
                <input type="hidden" name="redirect" id="loginRedirect" value="{{ url()->current() }}">

                <!-- Email -->
                <div>
                    <input
                        type="email"
                        name="email"
                        id="modalEmail"
                        required
                        autofocus
                        autocomplete="email"
                        placeholder="Email"
                        class="w-full px-4 py-3 rounded-lg border border-zinc-300 bg-white text-zinc-900 placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition"
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
                        id="modalPassword"
                        required
                        autocomplete="current-password"
                        placeholder="Kata Sandi"
                        class="w-full px-4 py-3 rounded-lg border border-zinc-300 bg-white text-zinc-900 placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition"
                    />
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between">
                    <label class="flex items-center">
                        <input type="checkbox" name="remember" class="rounded border-zinc-300 text-primary focus:ring-primary">
                        <span class="ml-2 text-sm text-zinc-600">Ingat saya</span>
                    </label>
                    <a href="{{ route('password.request') }}" class="text-sm text-primary hover:text-primary-700 font-medium">
                        Lupa password?
                    </a>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full bg-primary text-white px-6 py-3 rounded-lg font-semibold hover:bg-primary-600 transition shadow-lg">
                    Masuk
                </button>
            </form>

            <!-- Divider -->
            <div class="relative my-6">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-zinc-300"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-4 bg-white text-zinc-500">Belum punya akun?</span>
                </div>
            </div>

            <!-- Register Link -->
            <div class="text-center">
                <a href="{{ route('register') }}" class="inline-flex items-center text-primary hover:text-primary-700 font-medium text-sm">
                    Daftar sekarang
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</div>

<style>
    @keyframes modal-in {
        from {
            opacity: 0;
            transform: translateY(-20px) scale(0.95);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }
    .animate-modal-in {
        animation: modal-in 0.3s ease-out;
    }
</style>

<script>
    function showLoginModal(redirectUrl = null) {
        const modal = document.getElementById('loginModal');
        if (redirectUrl) {
            const redirectInput = document.getElementById('loginRedirect');
            if (redirectInput) {
                redirectInput.value = redirectUrl;
            }
        }
        modal.classList.remove('hidden');
        // Focus on email input
        setTimeout(() => {
            document.getElementById('modalEmail')?.focus();
        }, 100);
    }

    function closeLoginModal() {
        const modal = document.getElementById('loginModal');
        modal.classList.add('hidden');
    }

    // Close on ESC key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            const modal = document.getElementById('loginModal');
            if (!modal.classList.contains('hidden')) {
                closeLoginModal();
            }
        }
    });
</script>
