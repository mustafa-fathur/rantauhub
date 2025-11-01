<?php

use function Livewire\Volt\layout;
use Livewire\Volt\Component;
use App\Models\Funder;
use Illuminate\Support\Facades\Auth;

layout('components.layouts.app.sidebar');

new class extends Component {
    public $selectedFunder = null;
    public $showDetailModal = false;

    public function with(): array
    {
        // Ambil semua Funder dengan relasi user dan fundings
        $funders = Funder::with(['user', 'fundings'])
            ->latest()
            ->get();

        // Hitung statistik
        $totalFunders = $funders->count();
        $pendingFunders = $funders->where('verified', false)->count();
        $verifiedFunders = $funders->where('verified', true)->count();

        return [
            'title' => 'Verifikasi Funder',
            'funders' => $funders,
            'totalFunders' => $totalFunders,
            'pendingFunders' => $pendingFunders,
            'verifiedFunders' => $verifiedFunders,
        ];
    }

    public function verifyFunder($id): void
    {
        $funder = Funder::findOrFail($id);
        $funder->update(['verified' => true]);

        session()->flash('success', "Funder '{$funder->user->name}' telah disetujui dan diverifikasi.");
        
        // Close detail modal if open
        if ($this->selectedFunder && $this->selectedFunder->id === $id) {
            $this->closeDetail();
        }
    }

    public function rejectFunder($id): void
    {
        $funder = Funder::with('user')->findOrFail($id);
        $funderName = $funder->user->name;
        
        // Keep the record but mark as unverified
        $funder->update(['verified' => false]);
        
        session()->flash('info', "Funder '{$funderName}' telah ditolak.");
        
        // Close detail modal if open
        if ($this->selectedFunder && $this->selectedFunder->id === $id) {
            $this->closeDetail();
        }
    }

    public function showDetail($id): void
    {
        $this->selectedFunder = Funder::with(['user', 'fundings.business'])
            ->findOrFail($id);
        $this->showDetailModal = true;
    }

    public function closeDetail(): void
    {
        $this->showDetailModal = false;
        $this->selectedFunder = null;
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
            <p class="text-2xl font-bold text-zinc-900">{{ $totalFunders }}</p>
        </div>
        <div class="bg-white rounded-lg p-6 shadow-sm border border-zinc-200">
            <h3 class="text-sm font-medium text-zinc-600 mb-1">Menunggu Verifikasi</h3>
            <p class="text-2xl font-bold text-yellow-600">{{ $pendingFunders }}</p>
        </div>
        <div class="bg-white rounded-lg p-6 shadow-sm border border-zinc-200">
            <h3 class="text-sm font-medium text-zinc-600 mb-1">Terverifikasi</h3>
            <p class="text-2xl font-bold text-green-600">{{ $verifiedFunders }}</p>
        </div>
    </div>

    <!-- Funder List -->
    <div class="bg-white rounded-lg shadow-sm border border-zinc-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-zinc-200">
            <h2 class="text-lg font-semibold text-primary">Daftar Funder</h2>
        </div>
        
        <div class="p-6 space-y-4">
            @forelse($funders as $funder)
            <div class="border border-zinc-200 rounded-lg p-6 hover:shadow-md transition">
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <div class="flex items-center space-x-4 mb-4">
                            <div class="w-16 h-16 rounded-full bg-secondary text-white flex items-center justify-center">
                                @if($funder->user->profile_photo)
                                    <img src="{{ asset('storage/' . $funder->user->profile_photo) }}" alt="{{ $funder->user->name }}" class="w-16 h-16 rounded-full object-cover">
                                @else
                                    <span class="text-xl font-semibold">{{ $funder->user->initials() }}</span>
                                @endif
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center space-x-2 mb-1">
                                    <h3 class="text-lg font-semibold text-zinc-900">{{ $funder->user->name }}</h3>
                                    @if($funder->verified)
                                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">
                                            Terverifikasi
                                        </span>
                                    @else
                                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800">
                                            Pending
                                        </span>
                                    @endif
                                </div>
                                <p class="text-sm text-zinc-600">{{ $funder->user->email }}</p>
                                @if($funder->organization_name)
                                    <p class="text-sm font-medium text-secondary mt-1">{{ $funder->organization_name }}</p>
                                @else
                                    <p class="text-sm text-zinc-500 mt-1">Individu</p>
                                @endif
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-xs text-zinc-500 mb-1">Total Pendanaan</p>
                                <p class="text-lg font-bold text-zinc-900">{{ $funder->fundings()->count() }} funding</p>
                            </div>
                            <div>
                                <p class="text-xs text-zinc-500 mb-1">Total Nilai</p>
                                <p class="text-lg font-bold text-primary">Rp {{ number_format($funder->fundings()->sum('amount'), 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="ml-6 flex flex-col space-y-2">
                        @if(!$funder->verified)
                            <button 
                                wire:click="verifyFunder({{ $funder->id }})"
                                wire:confirm="Apakah Anda yakin ingin menyetujui funder ini?"
                                class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition text-sm whitespace-nowrap"
                            >
                                Setujui
                            </button>
                            <button 
                                wire:click="rejectFunder({{ $funder->id }})"
                                wire:confirm="Apakah Anda yakin ingin menolak funder ini?"
                                class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition text-sm whitespace-nowrap"
                            >
                                Tolak
                            </button>
                        @else
                            <span class="px-4 py-2 text-xs font-medium rounded-full bg-green-100 text-green-800 text-center whitespace-nowrap">
                                Terverifikasi
                            </span>
                        @endif
                        <button 
                            wire:click="showDetail({{ $funder->id }})"
                            class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-600 transition text-sm whitespace-nowrap"
                        >
                            Detail
                        </button>
                    </div>
                </div>
            </div>
            @empty
            <div class="text-center py-12 text-zinc-500">
                Tidak ada funder yang terdaftar
            </div>
            @endforelse
        </div>
    </div>

    <!-- Flash Messages -->
    @if(session()->has('success'))
        <div class="fixed top-4 right-4 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg shadow-lg z-50" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)">
            <div class="flex items-center space-x-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif

    @if(session()->has('info'))
        <div class="fixed top-4 right-4 bg-blue-50 border border-blue-200 text-blue-800 px-4 py-3 rounded-lg shadow-lg z-50" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)">
            <div class="flex items-center space-x-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>{{ session('info') }}</span>
            </div>
        </div>
    @endif

    <!-- Detail Modal -->
    @if($showDetailModal && $selectedFunder)
        <div class="fixed inset-0 z-50 overflow-y-auto" x-data="{ show: @entangle('showDetailModal') }" x-show="show" x-transition>
            <div class="flex items-center justify-center min-h-screen px-4">
                <!-- Backdrop -->
                <div class="fixed inset-0 bg-black/50" wire:click="closeDetail"></div>
                
                <!-- Modal -->
                <div class="relative bg-white rounded-xl shadow-xl max-w-2xl w-full p-6 max-h-[90vh] overflow-y-auto">
                    <!-- Header -->
                    <div class="flex items-center justify-between mb-6 pb-4 border-b border-zinc-200">
                        <h2 class="text-2xl font-bold text-primary">Detail Funder</h2>
                        <button wire:click="closeDetail" class="text-zinc-400 hover:text-zinc-600 transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <!-- Content -->
                    <div class="space-y-6">
                        <!-- Profile Section -->
                        <div class="flex items-center space-x-4 pb-6 border-b border-zinc-200">
                            <div class="w-20 h-20 rounded-full bg-secondary text-white flex items-center justify-center flex-shrink-0">
                                @if($selectedFunder->user->profile_photo)
                                    <img src="{{ asset('storage/' . $selectedFunder->user->profile_photo) }}" alt="{{ $selectedFunder->user->name }}" class="w-20 h-20 rounded-full object-cover">
                                @else
                                    <span class="text-2xl font-semibold">{{ $selectedFunder->user->initials() }}</span>
                                @endif
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center space-x-2 mb-2">
                                    <h3 class="text-xl font-bold text-zinc-900">{{ $selectedFunder->user->name }}</h3>
                                    @if($selectedFunder->verified)
                                        <span class="px-3 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">
                                            Terverifikasi
                                        </span>
                                    @else
                                        <span class="px-3 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800">
                                            Menunggu Verifikasi
                                        </span>
                                    @endif
                                </div>
                                <p class="text-sm text-zinc-600">{{ $selectedFunder->user->email }}</p>
                                @if($selectedFunder->user->phone)
                                    <p class="text-sm text-zinc-600">{{ $selectedFunder->user->phone }}</p>
                                @endif
                            </div>
                        </div>

                        <!-- User Info -->
                        <div class="bg-zinc-50 rounded-lg p-4">
                            <h4 class="font-semibold text-zinc-900 mb-3">Informasi User</h4>
                            <div class="space-y-1 text-sm">
                                <p><span class="font-medium">Nama:</span> {{ $selectedFunder->user->name }}</p>
                                <p><span class="font-medium">Email:</span> {{ $selectedFunder->user->email }}</p>
                                @if($selectedFunder->user->phone)
                                    <p><span class="font-medium">Telepon:</span> {{ $selectedFunder->user->phone }}</p>
                                @endif
                                @if($selectedFunder->user->address)
                                    <p><span class="font-medium">Alamat:</span> {{ $selectedFunder->user->address }}</p>
                                @endif
                                @if($selectedFunder->user->bio)
                                    <p><span class="font-medium">Bio:</span> {{ $selectedFunder->user->bio }}</p>
                                @endif
                            </div>
                        </div>

                        <!-- Organization Info -->
                        <div>
                            <h4 class="font-semibold text-zinc-900 mb-2">Tipe Funder</h4>
                            @if($selectedFunder->organization_name)
                                <p class="text-zinc-600">
                                    <span class="font-medium">Organisasi:</span> {{ $selectedFunder->organization_name }}
                                </p>
                            @else
                                <p class="text-zinc-600">
                                    <span class="font-medium">Tipe:</span> Individu
                                </p>
                            @endif
                        </div>

                        <!-- Funding Statistics -->
                        @php
                            $totalFundings = $selectedFunder->fundings()->count();
                            $approvedFundings = $selectedFunder->fundings()->where('status', \App\Enums\FundingStatus::APPROVED)->count();
                            $totalAmount = $selectedFunder->fundings()->where('status', \App\Enums\FundingStatus::APPROVED)->sum('amount');
                        @endphp
                        <div class="bg-secondary/10 rounded-lg p-4">
                            <h4 class="font-semibold text-zinc-900 mb-3">Statistik Pendanaan</h4>
                            <div class="grid grid-cols-3 gap-4 text-sm">
                                <div>
                                    <p class="text-zinc-500 mb-1">Total Request</p>
                                    <p class="text-xl font-bold text-zinc-900">{{ $totalFundings }}</p>
                                </div>
                                <div>
                                    <p class="text-zinc-500 mb-1">Disetujui</p>
                                    <p class="text-xl font-bold text-green-600">{{ $approvedFundings }}</p>
                                </div>
                                <div>
                                    <p class="text-zinc-500 mb-1">Total Nilai</p>
                                    <p class="text-xl font-bold text-secondary">Rp {{ number_format($totalAmount, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Recent Fundings -->
                        @if($selectedFunder->fundings->count() > 0)
                            <div>
                                <h4 class="font-semibold text-zinc-900 mb-3">Pendanaan Terkini</h4>
                                <div class="space-y-2 max-h-60 overflow-y-auto">
                                    @foreach($selectedFunder->fundings()->with('business')->latest()->take(5)->get() as $funding)
                                        <div class="border border-zinc-200 rounded-lg p-3">
                                            <div class="flex justify-between items-start">
                                                <div class="flex-1">
                                                    <p class="font-medium text-sm text-zinc-900">{{ $funding->business->name ?? 'N/A' }}</p>
                                                    <p class="text-xs text-zinc-600">Rp {{ number_format($funding->amount, 0, ',', '.') }}</p>
                                                </div>
                                                <span class="px-2 py-1 text-xs font-medium rounded-full 
                                                    @if($funding->status === \App\Enums\FundingStatus::APPROVED) bg-green-100 text-green-800
                                                    @elseif($funding->status === \App\Enums\FundingStatus::REJECTED) bg-red-100 text-red-800
                                                    @else bg-yellow-100 text-yellow-800
                                                    @endif">
                                                    {{ $funding->status->label() }}
                                                </span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Additional Info -->
                        <div class="pt-4 border-t border-zinc-200">
                            <p class="text-sm text-zinc-600">
                                <span class="font-medium">Tanggal Pendaftaran:</span> {{ $selectedFunder->created_at->format('d M Y H:i') }}
                            </p>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="flex items-center justify-end space-x-3 mt-6 pt-6 border-t border-zinc-200">
                        <button wire:click="closeDetail" class="px-4 py-2 border border-zinc-300 text-zinc-700 rounded-lg hover:bg-zinc-50 transition">
                            Tutup
                        </button>
                        @if(!$selectedFunder->verified)
                            <button 
                                wire:click="verifyFunder({{ $selectedFunder->id }})"
                                wire:confirm="Apakah Anda yakin ingin menyetujui funder ini?"
                                class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition"
                            >
                                Setujui
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
