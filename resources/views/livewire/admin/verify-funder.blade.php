<?php

use function Livewire\Volt\layout;
use Livewire\Volt\Component;

layout('components.layouts.app.sidebar');

new class extends Component {
    public function with(): array
    {
        // Data dummy untuk Funder yang perlu diverifikasi
        $funders = [
            [
                'id' => 1,
                'name' => 'Diaspora Minang Foundation',
                'email' => 'contact@diasporaminang.org',
                'organization_name' => 'Diaspora Minang Foundation',
                'verified' => false,
                'total_fundings' => 5,
                'total_amount' => 500000000,
                'created_at' => '2025-11-01 08:00:00',
            ],
            [
                'id' => 2,
                'name' => 'Investasi Nusantara PT',
                'email' => 'info@investasinusantara.co.id',
                'organization_name' => 'PT Investasi Nusantara',
                'verified' => false,
                'total_fundings' => 3,
                'total_amount' => 300000000,
                'created_at' => '2025-11-01 09:30:00',
            ],
            [
                'id' => 3,
                'name' => 'Budi Santoso',
                'email' => 'budi.santoso@example.com',
                'organization_name' => null,
                'verified' => false,
                'total_fundings' => 2,
                'total_amount' => 150000000,
                'created_at' => '2025-11-01 10:00:00',
            ],
        ];

        return [
            'title' => 'Verifikasi Funder',
            'funders' => $funders,
        ];
    }
}; ?>

<div class="space-y-6">
    <!-- Page Header -->
    <div>
        <h1 class="text-3xl font-bold text-primary">Verifikasi Funder</h1>
        <p class="text-zinc-600 mt-1">Kelola dan verifikasi funder yang terdaftar</p>
    </div>

    <!-- Statistics -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-white rounded-lg p-6 shadow-sm border border-zinc-200">
            <h3 class="text-sm font-medium text-zinc-600 mb-1">Total Funder</h3>
            <p class="text-2xl font-bold text-zinc-900">{{ count($funders) }}</p>
        </div>
        <div class="bg-white rounded-lg p-6 shadow-sm border border-zinc-200">
            <h3 class="text-sm font-medium text-zinc-600 mb-1">Menunggu Verifikasi</h3>
            <p class="text-2xl font-bold text-yellow-600">{{ count($funders) }}</p>
        </div>
        <div class="bg-white rounded-lg p-6 shadow-sm border border-zinc-200">
            <h3 class="text-sm font-medium text-zinc-600 mb-1">Terverifikasi</h3>
            <p class="text-2xl font-bold text-green-600">0</p>
        </div>
    </div>

    <!-- Funder List -->
    <div class="bg-white rounded-lg shadow-sm border border-zinc-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-zinc-200">
            <h2 class="text-lg font-semibold text-primary">Daftar Funder Menunggu Verifikasi</h2>
        </div>
        
        <div class="p-6 space-y-4">
            @forelse($funders as $funder)
            <div class="border border-zinc-200 rounded-lg p-6 hover:shadow-md transition">
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <div class="flex items-center space-x-4 mb-4">
                            <div class="w-16 h-16 rounded-full bg-secondary text-white flex items-center justify-center">
                                <span class="text-xl font-semibold">{{ Str::substr($funder['name'], 0, 2) }}</span>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold text-zinc-900">{{ $funder['name'] }}</h3>
                                <p class="text-sm text-zinc-600">{{ $funder['email'] }}</p>
                                @if($funder['organization_name'])
                                <p class="text-sm font-medium text-secondary mt-1">{{ $funder['organization_name'] }}</p>
                                @endif
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-xs text-zinc-500 mb-1">Total Pendanaan</p>
                                <p class="text-lg font-bold text-zinc-900">{{ $funder['total_fundings'] }} funding</p>
                            </div>
                            <div>
                                <p class="text-xs text-zinc-500 mb-1">Total Nilai</p>
                                <p class="text-lg font-bold text-primary">Rp {{ number_format($funder['total_amount'], 0, ',', '.') }}</p>
                            </div>
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
                Tidak ada funder yang menunggu verifikasi
            </div>
            @endforelse
        </div>
    </div>
</div>
