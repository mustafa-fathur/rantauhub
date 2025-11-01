@extends('components.layouts.user.dashboard', ['title' => $title ?? 'Detail Request Pendanaan'])

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex gap-6">
        <!-- Sidebar Card -->
        <x-user.sidebar :user="$user" />

        <!-- Main Content Area -->
        <main class="flex-1 min-w-0">
            <!-- Page Header -->
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h1 class="text-3xl font-bold text-primary mb-2">Detail Request Pendanaan</h1>
                    <p class="text-zinc-600">Informasi lengkap tentang request pendanaan</p>
                </div>
                <a href="{{ route('funder.funding-requests.index') }}" class="px-4 py-2 border border-zinc-300 text-zinc-700 rounded-lg hover:bg-zinc-50 transition font-medium">
                    Kembali
                </a>
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

            <!-- Detail Card -->
            <div class="bg-white rounded-xl shadow-md border border-zinc-200 p-6 md:p-8 space-y-6">
                <!-- UMKM Info -->
                <div class="bg-zinc-50 rounded-lg p-6">
                    <div class="flex items-center space-x-4 mb-4">
                        @if($funding->business->logo)
                            <img src="{{ asset('storage/' . $funding->business->logo) }}" alt="{{ $funding->business->name }}" class="w-20 h-20 rounded-lg object-cover">
                        @else
                            <div class="w-20 h-20 rounded-lg bg-primary/10 flex items-center justify-center text-primary">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                        @endif
                        <div class="flex-1">
                            <h3 class="text-xl font-bold text-zinc-900">{{ $funding->business->name }}</h3>
                            <p class="text-sm text-zinc-600">{{ $funding->business->location }}</p>
                            <p class="text-sm text-zinc-600">
                                @if($funding->business->category->value === 'lainnya' && $funding->business->other_category)
                                    {{ $funding->business->other_category }}
                                @else
                                    {{ $funding->business->category->label() }}
                                @endif
                            </p>
                        </div>
                        <div class="text-right">
                            <span class="px-3 py-1 text-sm font-medium rounded-full bg-blue-100 text-blue-800">
                                Request Terbuka
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Owner Info -->
                <div>
                    <h4 class="font-semibold text-zinc-900 mb-3">Informasi Pemilik UMKM</h4>
                    <div class="bg-zinc-50 rounded-lg p-4 space-y-2 text-sm">
                        <p><span class="font-medium">Nama:</span> {{ $funding->business->owner->user->name }}</p>
                        <p><span class="font-medium">Email:</span> {{ $funding->business->owner->user->email }}</p>
                        @if($funding->business->owner->user->phone)
                            <p><span class="font-medium">Telepon:</span> {{ $funding->business->owner->user->phone }}</p>
                        @endif
                    </div>
                </div>

                <!-- Business Description -->
                <div>
                    <h4 class="font-semibold text-zinc-900 mb-2">Deskripsi UMKM</h4>
                    <p class="text-zinc-600 whitespace-pre-wrap">{{ $funding->business->description ?? 'Tidak ada deskripsi' }}</p>
                </div>

                <!-- Funding Request Details -->
                <div class="bg-primary/5 rounded-lg p-6 border border-primary/20">
                    <h4 class="font-semibold text-zinc-900 mb-4">Detail Request Pendanaan</h4>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center">
                            <span class="text-zinc-600">Jumlah yang Dibutuhkan:</span>
                            <span class="text-2xl font-bold text-primary">Rp {{ number_format($funding->amount, 0, ',', '.') }}</span>
                        </div>
                        @if($funding->description)
                            <div>
                                <p class="text-sm font-medium text-zinc-700 mb-1">Alasan Permohonan:</p>
                                <p class="text-zinc-600 whitespace-pre-wrap">{{ $funding->description }}</p>
                            </div>
                        @endif
                        <div class="flex justify-between items-center pt-3 border-t border-primary/20">
                            <span class="text-zinc-600">Tanggal Request:</span>
                            <span class="text-zinc-700">{{ $funding->created_at->format('d M Y H:i') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Accept Form -->
                <div class="border-t border-zinc-200 pt-6">
                    <form method="POST" action="{{ route('funder.funding-requests.accept', $funding->id) }}" class="space-y-6">
                        @csrf
                        <h4 class="font-semibold text-zinc-900 mb-4">Berikan Pendanaan</h4>
                        <p class="text-sm text-zinc-600 mb-4">Anda dapat memberikan jumlah pendanaan yang berbeda dengan yang diminta. Jumlah akan disesuaikan sesuai kemampuan Anda.</p>

                        <!-- Amount -->
                        <div>
                            <label for="amount" class="block text-sm font-medium text-zinc-700 mb-2">
                                Jumlah Pendanaan (Rupiah) <span class="text-red-500">*</span>
                            </label>
                            <input
                                type="number"
                                name="amount"
                                id="amount"
                                value="{{ old('amount', $funding->amount) }}"
                                required
                                min="1000000"
                                max="1000000000"
                                step="100000"
                                class="w-full px-4 py-3 rounded-lg border border-zinc-300 focus:ring-2 focus:ring-primary focus:border-primary transition"
                            >
                            <p class="mt-1 text-xs text-zinc-500">Minimum: Rp 1.000.000 | Maksimum: Rp 1.000.000.000</p>
                            <div id="amount-display" class="mt-2 text-sm font-semibold text-primary"></div>
                            @error('amount')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Description (Optional) -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-zinc-700 mb-2">
                                Catatan/Pesan <span class="text-zinc-500">(Opsional)</span>
                            </label>
                            <textarea
                                name="description"
                                id="description"
                                rows="3"
                                placeholder="Tambahkan catatan atau pesan untuk pemilik UMKM..."
                                class="w-full px-4 py-3 rounded-lg border border-zinc-300 focus:ring-2 focus:ring-primary focus:border-primary transition resize-none"
                            >{{ old('description') }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="flex items-center justify-end space-x-4 pt-4 border-t border-zinc-200">
                            <a href="{{ route('funder.funding-requests.index') }}" class="px-6 py-3 border border-zinc-300 text-zinc-700 rounded-lg hover:bg-zinc-50 transition font-medium">
                                Batal
                            </a>
                            <button type="submit" class="px-6 py-3 bg-primary text-white rounded-lg hover:bg-primary-600 transition font-medium">
                                Berikan Pendanaan
                            </button>
                        </div>
                    </form>
                </div>
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

