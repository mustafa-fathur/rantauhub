@extends('components.layouts.user.dashboard', ['title' => $title ?? 'Daftar sebagai Funder'])

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex gap-6">
        <!-- Sidebar Card -->
        <x-user.sidebar :user="$user" />

        <!-- Main Content Area -->
        <main class="flex-1 min-w-0">
            <!-- Page Header -->
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-primary mb-2">Daftar sebagai Funder</h1>
                <p class="text-zinc-600">Lengkapi informasi untuk menjadi penggalang dana bagi UMKM lokal</p>
            </div>

            @if(session('success'))
                <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('info'))
                <div class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded-lg text-blue-800">
                    {{ session('info') }}
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
                <form method="POST" action="{{ route('register.funder.store') }}" class="space-y-6">
                    @csrf

                    <!-- Information Alert -->
                    <div class="p-4 bg-blue-50 border border-blue-200 rounded-lg">
                        <p class="text-sm text-blue-800">
                            <strong>Informasi:</strong> Setelah mendaftar sebagai Funder, akun Anda akan menunggu verifikasi dari admin sebelum dapat memberikan pendanaan kepada UMKM.
                        </p>
                    </div>

                    <!-- Organization Name (Optional) -->
                    <div>
                        <label for="organization_name" class="block text-sm font-medium text-zinc-700 mb-2">
                            Nama Organisasi/Lembaga <span class="text-zinc-500">(Opsional)</span>
                        </label>
                        <input
                            type="text"
                            name="organization_name"
                            id="organization_name"
                            value="{{ old('organization_name') }}"
                            placeholder="Contoh: PT Investasi Nusantara, Yayasan Dana Umat, dll (kosongkan jika pendanaan individu)"
                            class="w-full px-4 py-3 rounded-lg border border-zinc-300 focus:ring-2 focus:ring-primary focus:border-primary transition"
                        >
                        <p class="mt-1 text-xs text-zinc-500">
                            Jika Anda mendaftar sebagai individu (bukan organisasi), kosongkan field ini. Nama Anda dari profil akan digunakan sebagai identitas.
                        </p>
                        @error('organization_name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- User Info Preview -->
                    <div class="bg-zinc-50 rounded-lg p-4 border border-zinc-200">
                        <h4 class="font-semibold text-zinc-900 mb-3">Informasi Anda</h4>
                        <div class="space-y-2 text-sm">
                            <p><span class="font-medium">Nama:</span> {{ $user->name }}</p>
                            <p><span class="font-medium">Email:</span> {{ $user->email }}</p>
                            @if($user->phone)
                                <p><span class="font-medium">Telepon:</span> {{ $user->phone }}</p>
                            @endif
                            @if($user->address)
                                <p><span class="font-medium">Alamat:</span> {{ $user->address }}</p>
                            @endif
                        </div>
                        <p class="text-xs text-zinc-600 mt-3">
                            Informasi di atas akan digunakan sebagai identitas Funder Anda.
                        </p>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex items-center justify-end space-x-4 pt-6 border-t border-zinc-200">
                        <a href="{{ route('dashboard') }}" class="px-6 py-3 border border-zinc-300 text-zinc-700 rounded-lg hover:bg-zinc-50 transition font-medium">
                            Batal
                        </a>
                        <button type="submit" class="px-6 py-3 bg-primary text-white rounded-lg hover:bg-primary-600 transition font-medium">
                            Daftar sebagai Funder
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</div>
@endsection

