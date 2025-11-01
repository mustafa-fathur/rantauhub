<?php

use function Livewire\Volt\layout;
use Livewire\Volt\Component;

layout('components.layouts.app.sidebar');

new class extends Component {
    public function with(): array
    {
        // Data dummy untuk Funding yang perlu diverifikasi
        $fundings = [
            [
                'id' => 1,
                'funder_name' => 'Diaspora Minang Foundation',
                'business_name' => 'Rendang Uni Rina',
                'amount' => 50000000,
                'status' => 'pending',
                'created_at' => '2025-11-01 14:00:00',
                'proof_of_transfer' => 'proof_001.jpg',
            ],
            [
                'id' => 2,
                'funder_name' => 'PT Investasi Nusantara',
                'business_name' => 'Kerajinan Tenun Minang',
                'amount' => 75000000,
                'status' => 'pending',
                'created_at' => '2025-11-01 15:30:00',
                'proof_of_transfer' => 'proof_002.jpg',
            ],
            [
                'id' => 3,
                'funder_name' => 'Budi Santoso',
                'business_name' => 'Kopi Arabica Minang',
                'amount' => 30000000,
                'status' => 'pending',
                'created_at' => '2025-11-01 16:00:00',
                'proof_of_transfer' => 'proof_003.jpg',
            ],
        ];

        return [
            'title' => 'Verifikasi Pendanaan',
            'fundings' => $fundings,
        ];
    }
}; ?>

<div class="space-y-6">
    <!-- Page Header -->
    <div>
        <h1 class="text-3xl font-bold text-primary">Verifikasi Pendanaan</h1>
        <p class="text-zinc-600 mt-1">Kelola dan verifikasi pendanaan UMKM</p>
    </div>

    <!-- Statistics -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-white rounded-lg p-6 shadow-sm border border-zinc-200">
            <h3 class="text-sm font-medium text-zinc-600 mb-1">Total Pendanaan</h3>
            <p class="text-2xl font-bold text-zinc-900">{{ count($fundings) }}</p>
        </div>
        <div class="bg-white rounded-lg p-6 shadow-sm border border-zinc-200">
            <h3 class="text-sm font-medium text-zinc-600 mb-1">Menunggu</h3>
            <p class="text-2xl font-bold text-yellow-600">{{ count($fundings) }}</p>
        </div>
        <div class="bg-white rounded-lg p-6 shadow-sm border border-zinc-200">
            <h3 class="text-sm font-medium text-zinc-600 mb-1">Disetujui</h3>
            <p class="text-2xl font-bold text-green-600">0</p>
        </div>
        <div class="bg-white rounded-lg p-6 shadow-sm border border-zinc-200">
            <h3 class="text-sm font-medium text-zinc-600 mb-1">Total Nilai</h3>
            <p class="text-2xl font-bold text-primary">Rp {{ number_format(array_sum(array_column($fundings, 'amount')), 0, ',', '.') }}</p>
        </div>
    </div>

    <!-- Funding List -->
    <div class="bg-white rounded-lg shadow-sm border border-zinc-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-zinc-200">
            <h2 class="text-lg font-semibold text-primary">Daftar Pendanaan Menunggu Verifikasi</h2>
        </div>
        
        <div class="p-6 space-y-4">
            @forelse($fundings as $funding)
            <div class="border border-zinc-200 rounded-lg p-6 hover:shadow-md transition">
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <div class="grid grid-cols-2 gap-6 mb-4">
                            <div>
                                <p class="text-xs text-zinc-500 mb-1">Funder</p>
                                <p class="text-sm font-semibold text-zinc-900">{{ $funding['funder_name'] }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-zinc-500 mb-1">UMKM Business</p>
                                <p class="text-sm font-semibold text-zinc-900">{{ $funding['business_name'] }}</p>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-3 gap-6">
                            <div>
                                <p class="text-xs text-zinc-500 mb-1">Jumlah Pendanaan</p>
                                <p class="text-lg font-bold text-primary">Rp {{ number_format($funding['amount'], 0, ',', '.') }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-zinc-500 mb-1">Status</p>
                                <span class="inline-flex px-3 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800">
                                    {{ ucfirst($funding['status']) }}
                                </span>
                            </div>
                            <div>
                                <p class="text-xs text-zinc-500 mb-1">Tanggal</p>
                                <p class="text-sm text-zinc-900">{{ \Carbon\Carbon::parse($funding['created_at'])->format('d M Y H:i') }}</p>
                            </div>
                        </div>
                        
                        <div class="mt-4 pt-4 border-t border-zinc-200">
                            <p class="text-xs text-zinc-500 mb-1">Bukti Transfer</p>
                            <a href="#" class="text-sm text-primary hover:text-primary-600 flex items-center space-x-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                                </svg>
                                <span>{{ $funding['proof_of_transfer'] }}</span>
                            </a>
                        </div>
                    </div>
                    
                    <div class="ml-6 flex flex-col space-y-2">
                        <button class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition text-sm whitespace-nowrap">
                            Setujui
                        </button>
                        <button class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition text-sm whitespace-nowrap">
                            Tolak
                        </button>
                        <button class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-600 transition text-sm whitespace-nowrap">
                            Detail
                        </button>
                    </div>
                </div>
            </div>
            @empty
            <div class="text-center py-12 text-zinc-500">
                Tidak ada pendanaan yang menunggu verifikasi
            </div>
            @endforelse
        </div>
    </div>
</div>
