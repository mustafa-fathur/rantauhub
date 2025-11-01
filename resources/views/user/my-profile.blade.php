@extends('components.layouts.user.dashboard', ['title' => $title ?? 'Profile Saya'])

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex gap-6">
        <!-- Sidebar Card -->
        <x-user.sidebar :user="$user" />

        <!-- Main Content Area -->
        <main class="flex-1 min-w-0">
            <!-- Page Header -->
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-primary mb-2">Profile Saya</h1>
                <p class="text-zinc-600">Kelola informasi profil dan pengaturan akun Anda</p>
            </div>

            @if(session('success'))
                <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                    <ul class="list-disc list-inside text-red-800">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Profile Form -->
            <div class="bg-white rounded-xl shadow-md border border-zinc-200 p-6 md:p-8">
                <form method="POST" action="{{ route('my-profile.update') }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Profile Photo Section -->
                    <div class="border-b border-zinc-200 pb-6">
                        <label class="block text-sm font-medium text-zinc-700 mb-3">Foto Profil</label>
                        <div class="flex items-center space-x-6">
                            <div class="flex-shrink-0">
                                @if($user->profile_photo)
                                    <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="{{ $user->name }}" id="profile-photo-preview" class="w-24 h-24 rounded-full object-cover border-2 border-zinc-200">
                                @else
                                    <div id="profile-photo-preview" class="w-24 h-24 rounded-full bg-primary text-white flex items-center justify-center border-2 border-zinc-200">
                                        <span class="text-3xl font-semibold">{{ $user->initials() }}</span>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1">
                                <input type="file" name="profile_photo" id="profile_photo" accept="image/*" class="block w-full text-sm text-zinc-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-primary file:text-white hover:file:bg-primary-600 file:cursor-pointer">
                                <p class="mt-2 text-xs text-zinc-500">Format: JPG, PNG, GIF. Maksimal 2MB</p>
                                @error('profile_photo')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-zinc-700 mb-2">
                            Nama Lengkap <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            name="name"
                            id="name"
                            value="{{ old('name', $user->name) }}"
                            required
                            class="w-full px-4 py-3 rounded-lg border border-zinc-300 focus:ring-2 focus:ring-primary focus:border-primary transition"
                        >
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-zinc-700 mb-2">
                            Email <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="email"
                            name="email"
                            id="email"
                            value="{{ old('email', $user->email) }}"
                            required
                            class="w-full px-4 py-3 rounded-lg border border-zinc-300 focus:ring-2 focus:ring-primary focus:border-primary transition"
                        >
                        @if($user->email_verified_at)
                            <p class="mt-1 text-xs text-green-600 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Email terverifikasi
                            </p>
                        @else
                            <p class="mt-1 text-xs text-yellow-600">Email belum diverifikasi</p>
                        @endif
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Phone -->
                    <div>
                        <label for="phone" class="block text-sm font-medium text-zinc-700 mb-2">
                            No. Telepon
                        </label>
                        <input
                            type="tel"
                            name="phone"
                            id="phone"
                            value="{{ old('phone', $user->phone) }}"
                            placeholder="+62 812-3456-7890"
                            class="w-full px-4 py-3 rounded-lg border border-zinc-300 focus:ring-2 focus:ring-primary focus:border-primary transition"
                        >
                        @error('phone')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Address -->
                    <div>
                        <label for="address" class="block text-sm font-medium text-zinc-700 mb-2">
                            Alamat
                        </label>
                        <input
                            type="text"
                            name="address"
                            id="address"
                            value="{{ old('address', $user->address) }}"
                            placeholder="Contoh: Padang, Sumatera Barat"
                            class="w-full px-4 py-3 rounded-lg border border-zinc-300 focus:ring-2 focus:ring-primary focus:border-primary transition"
                        >
                        @error('address')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Bio -->
                    <div>
                        <label for="bio" class="block text-sm font-medium text-zinc-700 mb-2">
                            Bio / Tentang Saya
                        </label>
                        <textarea
                            name="bio"
                            id="bio"
                            rows="4"
                            placeholder="Ceritakan tentang diri Anda..."
                            class="w-full px-4 py-3 rounded-lg border border-zinc-300 focus:ring-2 focus:ring-primary focus:border-primary transition resize-none"
                        >{{ old('bio', $user->bio) }}</textarea>
                        <p class="mt-1 text-xs text-zinc-500">Maksimal 1000 karakter</p>
                        @error('bio')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Role & Type Info (Read-only) -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-4 border-t border-zinc-200">
                        <div>
                            <label class="block text-sm font-medium text-zinc-700 mb-2">Role</label>
                            <div class="px-4 py-3 bg-zinc-50 rounded-lg border border-zinc-200">
                                <span class="text-zinc-900 font-medium capitalize">{{ $user->role->value }}</span>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-zinc-700 mb-2">Tipe User</label>
                            <div class="px-4 py-3 bg-zinc-50 rounded-lg border border-zinc-200">
                                @if($user->getUserType())
                                    <span class="text-zinc-900 font-medium">{{ $user->getUserType()->value }}</span>
                                @else
                                    <span class="text-zinc-500">Belum ditentukan</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex items-center justify-end space-x-4 pt-6 border-t border-zinc-200">
                        <a href="{{ route('dashboard') }}" class="px-6 py-3 border border-zinc-300 text-zinc-700 rounded-lg hover:bg-zinc-50 transition font-medium">
                            Batal
                        </a>
                        <button type="submit" class="px-6 py-3 bg-primary text-white rounded-lg hover:bg-primary-600 transition font-medium">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</div>

<script>
    // Preview profile photo
    document.getElementById('profile_photo')?.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('profile-photo-preview');
                if (preview.tagName === 'IMG') {
                    preview.src = e.target.result;
                } else {
                    // Replace div with img
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = 'w-24 h-24 rounded-full object-cover border-2 border-zinc-200';
                    img.id = 'profile-photo-preview';
                    preview.parentNode.replaceChild(img, preview);
                }
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection
