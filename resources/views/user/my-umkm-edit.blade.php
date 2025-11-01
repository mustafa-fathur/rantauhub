@extends('components.layouts.user.dashboard', ['title' => $title ?? 'Edit UMKM'])

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex gap-6">
        <!-- Sidebar Card -->
        <x-user.sidebar :user="$user" />

        <!-- Main Content Area -->
        <main class="flex-1 min-w-0">
            <!-- Page Header -->
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-primary mb-2">Edit UMKM</h1>
                <p class="text-zinc-600">Perbarui informasi UMKM Anda</p>
            </div>

            @if($errors->any())
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                    <ul class="list-disc list-inside text-red-800">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Edit Form -->
            <div class="bg-white rounded-xl shadow-md border border-zinc-200 p-6 md:p-8">
                <form method="POST" action="{{ route('my-umkm.update', $business->id) }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Current Logo Preview -->
                    <div>
                        <label class="block text-sm font-medium text-zinc-700 mb-2">Logo UMKM Saat Ini</label>
                        <div class="flex items-center space-x-4">
                            @if($business->logo)
                                <img src="{{ asset('storage/' . $business->logo) }}" alt="{{ $business->name }}" class="w-20 h-20 rounded-lg object-cover border border-zinc-200">
                            @else
                                <div class="w-20 h-20 rounded-lg bg-zinc-100 flex items-center justify-center border border-zinc-200">
                                    <svg class="w-10 h-10 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Logo Upload -->
                    <div>
                        <label for="logo" class="block text-sm font-medium text-zinc-700 mb-2">
                            Ganti Logo UMKM <span class="text-zinc-500">(Opsional)</span>
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

                    <!-- Business Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-zinc-700 mb-2">
                            Nama UMKM <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            name="name"
                            id="name"
                            value="{{ old('name', $business->name) }}"
                            required
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
                            <option value="kuliner" {{ old('category', $business->category->value) === 'kuliner' ? 'selected' : '' }}>Kuliner</option>
                            <option value="kerajinan" {{ old('category', $business->category->value) === 'kerajinan' ? 'selected' : '' }}>Kerajinan</option>
                            <option value="pertanian" {{ old('category', $business->category->value) === 'pertanian' ? 'selected' : '' }}>Pertanian</option>
                            <option value="fashion" {{ old('category', $business->category->value) === 'fashion' ? 'selected' : '' }}>Fashion</option>
                            <option value="lainnya" {{ old('category', $business->category->value) === 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                        @error('category')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Other Category -->
                    <div id="other-category-field" class="{{ old('category', $business->category->value) === 'lainnya' ? '' : 'hidden' }}">
                        <label for="other_category" class="block text-sm font-medium text-zinc-700 mb-2">
                            Kategori Lainnya <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            name="other_category"
                            id="other_category"
                            value="{{ old('other_category', $business->other_category) }}"
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
                            class="w-full px-4 py-3 rounded-lg border border-zinc-300 focus:ring-2 focus:ring-primary focus:border-primary transition resize-none"
                        >{{ old('description', $business->description) }}</textarea>
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
                            value="{{ old('location', $business->location) }}"
                            required
                            class="w-full px-4 py-3 rounded-lg border border-zinc-300 focus:ring-2 focus:ring-primary focus:border-primary transition"
                        >
                        @error('location')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status Info (Read-only) -->
                    <div class="bg-zinc-50 rounded-lg p-4 border border-zinc-200">
                        <label class="block text-sm font-medium text-zinc-700 mb-2">Status Verifikasi</label>
                        @if($business->verified)
                            <span class="px-3 py-1 text-sm font-medium rounded-full bg-green-100 text-green-800">
                                Terverifikasi
                            </span>
                        @else
                            <span class="px-3 py-1 text-sm font-medium rounded-full bg-yellow-100 text-yellow-800">
                                Menunggu Verifikasi
                            </span>
                        @endif
                        <p class="mt-2 text-xs text-zinc-600">Status verifikasi hanya dapat diubah oleh admin</p>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex items-center justify-end space-x-4 pt-6 border-t border-zinc-200">
                        <a href="{{ route('my-umkm.index') }}" class="px-6 py-3 border border-zinc-300 text-zinc-700 rounded-lg hover:bg-zinc-50 transition font-medium">
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
</script>
@endsection

