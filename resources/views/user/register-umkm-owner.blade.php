@extends('components.layouts.user.dashboard', ['title' => $title ?? 'Daftar sebagai UMKM Owner'])

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex gap-6">
        <!-- Sidebar Card -->
        <x-user.sidebar :user="$user" />

        <!-- Main Content Area -->
        <main class="flex-1 min-w-0">
            <!-- Page Header -->
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-primary mb-2">Daftar sebagai UMKM Owner</h1>
                <p class="text-zinc-600">Lengkapi data diri Anda untuk menjadi UMKM Owner</p>
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

            <!-- Address Check Alert -->
            @if(!$user->address)
                <div class="mb-6 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-yellow-600 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                        <div class="flex-1">
                            <h3 class="font-semibold text-yellow-800 mb-1">Alamat Belum Dilengkapi</h3>
                            <p class="text-sm text-yellow-700 mb-3">
                                Untuk mendaftar sebagai UMKM Owner, Anda harus melengkapi alamat terlebih dahulu.
                            </p>
                            <a href="{{ route('my-profile') }}" class="inline-flex items-center px-4 py-2 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 transition text-sm font-medium">
                                Lengkapi Alamat di Profil
                            </a>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Registration Form -->
            <div class="bg-white rounded-xl shadow-md border border-zinc-200 p-6 md:p-8">
                <form method="POST" action="{{ route('register.umkm-owner.store') }}" class="space-y-6">
                    @csrf

                    <!-- Information Alert -->
                    <div class="p-4 bg-blue-50 border border-blue-200 rounded-lg">
                        <p class="text-sm text-blue-800">
                            <strong>Informasi:</strong> Setelah mendaftar sebagai UMKM Owner, akun Anda akan menunggu verifikasi dari admin sebelum dapat melakukan registrasi UMKM.
                        </p>
                    </div>

                    <!-- NIK -->
                    <div>
                        <label for="nik" class="block text-sm font-medium text-zinc-700 mb-2">
                            NIK (Nomor Induk Kependudukan) <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            name="nik"
                            id="nik"
                            value="{{ old('nik') }}"
                            required
                            placeholder="Contoh: 1371012301010001"
                            class="w-full px-4 py-3 rounded-lg border border-zinc-300 focus:ring-2 focus:ring-primary focus:border-primary transition"
                        >
                        <p class="mt-1 text-xs text-zinc-500">NIK diperlukan untuk verifikasi identitas Anda</p>
                        @error('nik')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- NPWP -->
                    <div>
                        <label for="npwp" class="block text-sm font-medium text-zinc-700 mb-2">
                            NPWP (Nomor Pokok Wajib Pajak) <span class="text-zinc-500">(Opsional)</span>
                        </label>
                        <input
                            type="text"
                            name="npwp"
                            id="npwp"
                            value="{{ old('npwp') }}"
                            placeholder="Contoh: 12.345.678.9-012.345"
                            class="w-full px-4 py-3 rounded-lg border border-zinc-300 focus:ring-2 focus:ring-primary focus:border-primary transition"
                        >
                        <p class="mt-1 text-xs text-zinc-500">NPWP dapat ditambahkan kemudian jika belum tersedia</p>
                        @error('npwp')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- User Address Display (Read-only) -->
                    <div>
                        <label class="block text-sm font-medium text-zinc-700 mb-2">
                            Alamat (dari profil)
                        </label>
                        <div class="px-4 py-3 bg-zinc-50 rounded-lg border border-zinc-200">
                            @if($user->address)
                                <span class="text-zinc-900">{{ $user->address }}</span>
                            @else
                                <span class="text-red-600">Alamat belum diisi. Silakan lengkapi di halaman profil.</span>
                            @endif
                        </div>
                        @if(!$user->address)
                            <a href="{{ route('my-profile') }}" class="mt-2 inline-block text-sm text-primary hover:text-primary-600">
                                Lengkapi Alamat →
                            </a>
                        @endif
                    </div>

                    <!-- Submit Button -->
                    <div class="flex items-center justify-end space-x-4 pt-6 border-t border-zinc-200">
                        <a href="{{ route('dashboard') }}" class="px-6 py-3 border border-zinc-300 text-zinc-700 rounded-lg hover:bg-zinc-50 transition font-medium">
                            Batal
                        </a>
                        <button
                            type="submit"
                            class="px-6 py-3 bg-primary text-white rounded-lg hover:bg-primary-600 transition font-medium"
                            {{ !$user->address ? 'disabled' : '' }}
                        >
                            Daftar sebagai UMKM Owner
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</div>
@endsection

