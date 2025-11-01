@extends('components.layouts.user.dashboard', ['title' => $title ?? 'Daftar UMKM'])

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex gap-6">
        <!-- Sidebar Card -->
        <x-user.sidebar :user="$user" />

        <!-- Main Content Area -->
        <main class="flex-1 min-w-0">
            <!-- Page Header -->
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-primary mb-2">Daftar UMKM</h1>
                <p class="text-zinc-600">Daftarkan bisnis UMKM Anda untuk mendapat mentoring dan pendanaan</p>
            </div>

            @if(session('success'))
                <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg text-red-800">
                    {{ session('error') }}
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

            <!-- Registration Form -->
            <div class="bg-white rounded-xl shadow-md border border-zinc-200 p-6 md:p-8">
                <form method="POST" action="{{ route('register.umkm-business.store') }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <!-- Information Alert -->
                    <div class="p-4 bg-blue-50 border border-blue-200 rounded-lg">
                        <p class="text-sm text-blue-800">
                            <strong>Informasi:</strong> UMKM yang didaftarkan akan menunggu verifikasi dari admin sebelum dapat aktif di platform.
                        </p>
                    </div>

                    <!-- Business Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-zinc-700 mb-2">
                            Nama UMKM <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            name="name"
                            id="name"
                            value="{{ old('name') }}"
                            required
                            placeholder="Contoh: Rendang Uni Rina"
                            class="w-full px-4 py-3 rounded-lg border border-zinc-300 focus:ring-2 focus:ring-primary focus:border-primary transition"
                        >
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Category -->
                    <div>
                        <label for="category" class="block text-sm font-medium text-zinc-700 mb-2">
                            Kategori UMKM <span class="text-red-500">*</span>
                        </label>
                        <select
                            name="category"
                            id="category"
                            required
                            class="w-full px-4 py-3 rounded-lg border border-zinc-300 focus:ring-2 focus:ring-primary focus:border-primary transition"
                        >
                            <option value="">Pilih Kategori</option>
                            <option value="kuliner" {{ old('category') === 'kuliner' ? 'selected' : '' }}>Kuliner</option>
                            <option value="kerajinan" {{ old('category') === 'kerajinan' ? 'selected' : '' }}>Kerajinan</option>
                            <option value="pertanian" {{ old('category') === 'pertanian' ? 'selected' : '' }}>Pertanian</option>
                            <option value="fashion" {{ old('category') === 'fashion' ? 'selected' : '' }}>Fashion</option>
                            <option value="lainnya" {{ old('category') === 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                        @error('category')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Other Category (shown when "lainnya" is selected) -->
                    <div id="other-category-field" class="hidden">
                        <label for="other_category" class="block text-sm font-medium text-zinc-700 mb-2">
                            Kategori Lainnya <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            name="other_category"
                            id="other_category"
                            value="{{ old('other_category') }}"
                            placeholder="Masukkan kategori UMKM Anda"
                            class="w-full px-4 py-3 rounded-lg border border-zinc-300 focus:ring-2 focus:ring-primary focus:border-primary transition"
                        >
                        @error('other_category')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-zinc-700 mb-2">
                            Deskripsi UMKM <span class="text-red-500">*</span>
                        </label>
                        <textarea
                            name="description"
                            id="description"
                            rows="5"
                            required
                            placeholder="Jelaskan tentang UMKM Anda, produk yang ditawarkan, keunikan, dll..."
                            class="w-full px-4 py-3 rounded-lg border border-zinc-300 focus:ring-2 focus:ring-primary focus:border-primary transition resize-none"
                        >{{ old('description') }}</textarea>
                        <p class="mt-1 text-xs text-zinc-500">Maksimal 1000 karakter</p>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Location -->
                    <div>
                        <label for="location" class="block text-sm font-medium text-zinc-700 mb-2">
                            Lokasi UMKM <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            name="location"
                            id="location"
                            value="{{ old('location') }}"
                            required
                            placeholder="Contoh: Padang, Sumatera Barat"
                            class="w-full px-4 py-3 rounded-lg border border-zinc-300 focus:ring-2 focus:ring-primary focus:border-primary transition"
                        >
                        @error('location')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Logo -->
                    <div>
                        <label for="logo" class="block text-sm font-medium text-zinc-700 mb-2">
                            Logo UMKM <span class="text-zinc-500">(Opsional)</span>
                        </label>
                        <input
                            type="file"
                            name="logo"
                            id="logo"
                            accept="image/*"
                            class="block w-full text-sm text-zinc-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-primary file:text-white hover:file:bg-primary-600 file:cursor-pointer"
                        >
                        <p class="mt-2 text-xs text-zinc-500">Format: JPG, PNG, GIF. Maksimal 2MB</p>
                        @error('logo')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="flex items-center justify-end space-x-4 pt-6 border-t border-zinc-200">
                        <a href="{{ route('dashboard') }}" class="px-6 py-3 border border-zinc-300 text-zinc-700 rounded-lg hover:bg-zinc-50 transition font-medium">
                            Batal
                        </a>
                        <button type="submit" class="px-6 py-3 bg-primary text-white rounded-lg hover:bg-primary-600 transition font-medium">
                            Daftarkan UMKM
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</div>

<script>
    // Show/hide other category field based on selection
    document.getElementById('category')?.addEventListener('change', function() {
        const otherCategoryField = document.getElementById('other-category-field');
        const otherCategoryInput = document.getElementById('other_category');
        
        if (this.value === 'lainnya') {
            otherCategoryField?.classList.remove('hidden');
            otherCategoryInput?.setAttribute('required', 'required');
        } else {
            otherCategoryField?.classList.add('hidden');
            otherCategoryInput?.removeAttribute('required');
            otherCategoryInput.value = '';
        }
    });

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
        const categorySelect = document.getElementById('category');
        if (categorySelect && categorySelect.value === 'lainnya') {
            document.getElementById('other-category-field')?.classList.remove('hidden');
        }
    });
</script>
@endsection

