@extends('components.layouts.user.dashboard', ['title' => $title ?? 'Buat Request Pendanaan'])

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex gap-6">
        <!-- Sidebar Card -->
        <x-user.sidebar :user="$user" />

        <!-- Main Content Area -->
        <main class="flex-1 min-w-0">
            <!-- Page Header -->
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-primary mb-2">Buat Request Pendanaan</h1>
                <p class="text-zinc-600">Ajukan request pendanaan untuk UMKM Anda yang sudah terverifikasi</p>
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

            <!-- Request Form -->
            <div class="bg-white rounded-xl shadow-md border border-zinc-200 p-6 md:p-8">
                <form method="POST" action="{{ route('funding-requests.store') }}" class="space-y-6">
                    @csrf

                    <!-- Information Alert -->
                    <div class="p-4 bg-blue-50 border border-blue-200 rounded-lg">
                        <p class="text-sm text-blue-800">
                            <strong>Informasi:</strong> Request pendanaan akan dipublikasikan dan terbuka untuk semua funder. Funder yang tertarik akan secara sukarela memberikan pendanaan kepada UMKM Anda. Pastikan UMKM Anda sudah terverifikasi sebelum membuat request.
                        </p>
                    </div>

                    <!-- Business Selection -->
                    <div>
                        <label for="business_id" class="block text-sm font-medium text-zinc-700 mb-2">
                            Pilih UMKM <span class="text-red-500">*</span>
                        </label>
                        <select
                            name="business_id"
                            id="business_id"
                            required
                            class="w-full px-4 py-3 rounded-lg border border-zinc-300 focus:ring-2 focus:ring-primary focus:border-primary transition"
                        >
                            <option value="">Pilih UMKM</option>
                            @foreach($businesses as $business)
                                <option value="{{ $business->id }}" {{ old('business_id') == $business->id ? 'selected' : '' }}>
                                    {{ $business->name }} - {{ $business->location }}
                                </option>
                            @endforeach
                        </select>
                        <p class="mt-1 text-xs text-zinc-500">Hanya UMKM yang sudah terverifikasi yang dapat menerima pendanaan</p>
                        @error('business_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Amount -->
                    <div>
                        <label for="amount" class="block text-sm font-medium text-zinc-700 mb-2">
                            Jumlah Pendanaan (Rupiah) <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="number"
                            name="amount"
                            id="amount"
                            value="{{ old('amount') }}"
                            required
                            min="1000000"
                            max="1000000000"
                            step="100000"
                            placeholder="Contoh: 50000000"
                            class="w-full px-4 py-3 rounded-lg border border-zinc-300 focus:ring-2 focus:ring-primary focus:border-primary transition"
                        >
                        <p class="mt-1 text-xs text-zinc-500">Minimum: Rp 1.000.000 | Maksimum: Rp 100.000.000</p>
                        <div id="amount-display" class="mt-2 text-sm font-semibold text-primary"></div>
                        @error('amount')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-zinc-700 mb-2">
                            Deskripsi/Permohonan <span class="text-zinc-500">(Opsional)</span>
                        </label>
                        <textarea
                            name="description"
                            id="description"
                            rows="5"
                            placeholder="Jelaskan alasan permohonan pendanaan, rencana penggunaan dana, dll..."
                            class="w-full px-4 py-3 rounded-lg border border-zinc-300 focus:ring-2 focus:ring-primary focus:border-primary transition resize-none"
                        >{{ old('description') }}</textarea>
                        <p class="mt-1 text-xs text-zinc-500">Maksimal 1000 karakter</p>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="flex items-center justify-end space-x-4 pt-6 border-t border-zinc-200">
                        <a href="{{ route('funding-requests.index') }}" class="px-6 py-3 border border-zinc-300 text-zinc-700 rounded-lg hover:bg-zinc-50 transition font-medium">
                            Batal
                        </a>
                        <button type="submit" class="px-6 py-3 bg-primary text-white rounded-lg hover:bg-primary-600 transition font-medium">
                            Buat Request
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</div>

<script>
    // Format amount display
    document.getElementById('amount')?.addEventListener('input', function() {
        const amount = parseInt(this.value) || 0;
        const formatted = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0,
        }).format(amount);
        document.getElementById('amount-display').textContent = formatted || '';
    });
</script>
@endsection

