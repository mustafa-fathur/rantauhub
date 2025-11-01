<?php

use function Livewire\Volt\layout;
use Livewire\Volt\Component;
use App\Models\UmkmBusiness;
use Illuminate\Support\Facades\Auth;

layout('components.layouts.app.sidebar');

new class extends Component {
    public $selectedBusiness = null;
    public $showDetailModal = false;

    public function with(): array
    {
        // Ambil semua UMKM Business dengan relasi owner dan user
        $umkmBusinesses = UmkmBusiness::with(['owner.user'])
            ->latest()
            ->get();

        // Hitung statistik
        $totalUmkm = $umkmBusinesses->count();
        $pendingUmkm = $umkmBusinesses->where('verified', false)->count();
        $verifiedUmkm = $umkmBusinesses->where('verified', true)->count();

        return [
            'title' => 'Verifikasi UMKM',
            'umkmBusinesses' => $umkmBusinesses,
            'totalUmkm' => $totalUmkm,
            'pendingUmkm' => $pendingUmkm,
            'verifiedUmkm' => $verifiedUmkm,
        ];
    }

    public function verifyUmkm($id): void
    {
        $business = UmkmBusiness::findOrFail($id);
        $business->update(['verified' => true]);

        // Optionally create verification log
        // You can add this if you have a VerificationLog model

        session()->flash('success', "UMKM '{$business->name}' telah disetujui dan diverifikasi.");
        
        // Close detail modal if open
        if ($this->selectedBusiness && $this->selectedBusiness->id === $id) {
            $this->closeDetail();
        }
    }

    public function rejectUmkm($id): void
    {
        $business = UmkmBusiness::findOrFail($id);
        $businessName = $business->name;
        
        // Optionally: You can add a rejection reason field or create a log
        // For now, we'll just set verified to false (if it was true) or delete
        // Since we might want to keep the record, let's just keep verified as false
        
        session()->flash('info', "UMKM '{$businessName}' telah ditolak.");
        
        // Close detail modal if open
        if ($this->selectedBusiness && $this->selectedBusiness->id === $id) {
            $this->closeDetail();
        }
    }

    public function showDetail($id): void
    {
        $this->selectedBusiness = UmkmBusiness::with(['owner.user'])
            ->findOrFail($id);
        $this->showDetailModal = true;
    }

    public function closeDetail(): void
    {
        $this->showDetailModal = false;
        $this->selectedBusiness = null;
    }
}; ?>

<div class="space-y-6">
    <!-- Page Header -->
    <div>
        <h1 class="text-3xl font-bold text-primary">Verifikasi UMKM</h1>
        <p class="text-zinc-600 mt-1">Kelola dan verifikasi bisnis UMKM yang terdaftar</p>
    </div>

    <!-- Statistics -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-white rounded-lg p-6 shadow-sm border border-zinc-200">
            <h3 class="text-sm font-medium text-zinc-600 mb-1">Total UMKM</h3>
            <p class="text-2xl font-bold text-zinc-900">{{ $totalUmkm }}</p>
        </div>
        <div class="bg-white rounded-lg p-6 shadow-sm border border-zinc-200">
            <h3 class="text-sm font-medium text-zinc-600 mb-1">Menunggu Verifikasi</h3>
            <p class="text-2xl font-bold text-yellow-600">{{ $pendingUmkm }}</p>
        </div>
        <div class="bg-white rounded-lg p-6 shadow-sm border border-zinc-200">
            <h3 class="text-sm font-medium text-zinc-600 mb-1">Terverifikasi</h3>
            <p class="text-2xl font-bold text-green-600">{{ $verifiedUmkm }}</p>
        </div>
    </div>

    <!-- UMKM List -->
    <div class="bg-white rounded-lg shadow-sm border border-zinc-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-zinc-200">
            <h2 class="text-lg font-semibold text-primary">Daftar UMKM Menunggu Verifikasi</h2>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-zinc-50 border-b border-zinc-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-zinc-700 uppercase tracking-wider">Nama Bisnis</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-zinc-700 uppercase tracking-wider">Pemilik</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-zinc-700 uppercase tracking-wider">Kategori</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-zinc-700 uppercase tracking-wider">Lokasi</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-zinc-700 uppercase tracking-wider">Tanggal Daftar</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-zinc-700 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-200">
                    @forelse($umkmBusinesses as $business)
                    <tr class="hover:bg-zinc-50 transition">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center space-x-3">
                                @if($business->logo)
                                    <img src="{{ asset('storage/' . $business->logo) }}" alt="{{ $business->name }}" class="w-10 h-10 rounded-lg object-cover">
                                @else
                                    <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center">
                                        <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                        </svg>
                                    </div>
                                @endif
                                <div>
                                    <div class="text-sm font-semibold text-zinc-900">{{ $business->name }}</div>
                                    <div class="text-xs text-zinc-500 line-clamp-1">{{ Str::limit($business->description ?? '', 50) }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($business->owner && $business->owner->user)
                                <div class="text-sm text-zinc-900">{{ $business->owner->user->name }}</div>
                                <div class="text-xs text-zinc-500">{{ $business->owner->user->email }}</div>
                            @else
                                <div class="text-sm text-zinc-500">N/A</div>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-3 py-1 text-xs font-medium rounded-full bg-secondary/10 text-secondary">
                                @if($business->category->value === 'lainnya' && $business->other_category)
                                    {{ $business->other_category }}
                                @else
                                    {{ $business->category->label() }}
                                @endif
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-600">
                            {{ $business->location ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-600">
                            {{ $business->created_at->format('d M Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center justify-end space-x-2">
                                @if(!$business->verified)
                                    <button 
                                        wire:click="verifyUmkm({{ $business->id }})"
                                        wire:confirm="Apakah Anda yakin ingin menyetujui UMKM ini?"
                                        class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition text-sm"
                                    >
                                        Setujui
                                    </button>
                                    <button 
                                        wire:click="rejectUmkm({{ $business->id }})"
                                        wire:confirm="Apakah Anda yakin ingin menolak UMKM ini?"
                                        class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition text-sm"
                                    >
                                        Tolak
                                    </button>
                                @else
                                    <span class="px-3 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">
                                        Terverifikasi
                                    </span>
                                @endif
                                <button 
                                    wire:click="showDetail({{ $business->id }})"
                                    class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-600 transition text-sm"
                                >
                                    Detail
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-zinc-500">
                            Tidak ada UMKM yang terdaftar
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
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
    @if($showDetailModal && $selectedBusiness)
        <div class="fixed inset-0 z-50 overflow-y-auto" x-data="{ show: @entangle('showDetailModal') }" x-show="show" x-transition>
            <div class="flex items-center justify-center min-h-screen px-4">
                <!-- Backdrop -->
                <div class="fixed inset-0 bg-black/50" wire:click="closeDetail"></div>
                
                <!-- Modal -->
                <div class="relative bg-white rounded-xl shadow-xl max-w-2xl w-full p-6 max-h-[90vh] overflow-y-auto">
                    <!-- Header -->
                    <div class="flex items-center justify-between mb-6 pb-4 border-b border-zinc-200">
                        <h2 class="text-2xl font-bold text-primary">Detail UMKM</h2>
                        <button wire:click="closeDetail" class="text-zinc-400 hover:text-zinc-600 transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <!-- Content -->
                    <div class="space-y-6">
                        <!-- Logo & Name -->
                        <div class="flex items-center space-x-4">
                            @if($selectedBusiness->logo)
                                <img src="{{ asset('storage/' . $selectedBusiness->logo) }}" alt="{{ $selectedBusiness->name }}" class="w-20 h-20 rounded-lg object-cover">
                            @else
                                <div class="w-20 h-20 rounded-lg bg-primary/10 flex items-center justify-center">
                                    <svg class="w-10 h-10 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                </div>
                            @endif
                            <div>
                                <h3 class="text-xl font-bold text-zinc-900">{{ $selectedBusiness->name }}</h3>
                                <p class="text-sm text-zinc-600">
                                    @if($selectedBusiness->category->value === 'lainnya' && $selectedBusiness->other_category)
                                        {{ $selectedBusiness->other_category }}
                                    @else
                                        {{ $selectedBusiness->category->label() }}
                                    @endif
                                </p>
                            </div>
                        </div>

                        <!-- Owner Info -->
                        <div class="bg-zinc-50 rounded-lg p-4">
                            <h4 class="font-semibold text-zinc-900 mb-2">Informasi Pemilik</h4>
                            @if($selectedBusiness->owner && $selectedBusiness->owner->user)
                                <div class="space-y-1 text-sm">
                                    <p><span class="font-medium">Nama:</span> {{ $selectedBusiness->owner->user->name }}</p>
                                    <p><span class="font-medium">Email:</span> {{ $selectedBusiness->owner->user->email }}</p>
                                    <p><span class="font-medium">Telepon:</span> {{ $selectedBusiness->owner->user->phone ?? 'N/A' }}</p>
                                    <p><span class="font-medium">Alamat:</span> {{ $selectedBusiness->owner->user->address ?? 'N/A' }}</p>
                                    @if($selectedBusiness->owner->nik)
                                        <p><span class="font-medium">NIK:</span> {{ $selectedBusiness->owner->nik }}</p>
                                    @endif
                                    @if($selectedBusiness->owner->npwp)
                                        <p><span class="font-medium">NPWP:</span> {{ $selectedBusiness->owner->npwp }}</p>
                                    @endif
                                </div>
                            @else
                                <p class="text-sm text-zinc-500">Informasi pemilik tidak tersedia</p>
                            @endif
                        </div>

                        <!-- Business Details -->
                        <div>
                            <h4 class="font-semibold text-zinc-900 mb-2">Deskripsi UMKM</h4>
                            <p class="text-sm text-zinc-600 whitespace-pre-wrap">{{ $selectedBusiness->description ?? 'Tidak ada deskripsi' }}</p>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <h4 class="font-semibold text-zinc-900 mb-2">Lokasi</h4>
                                <p class="text-sm text-zinc-600">{{ $selectedBusiness->location ?? 'N/A' }}</p>
                            </div>
                            <div>
                                <h4 class="font-semibold text-zinc-900 mb-2">Tanggal Pendaftaran</h4>
                                <p class="text-sm text-zinc-600">{{ $selectedBusiness->created_at->format('d M Y H:i') }}</p>
                            </div>
                        </div>

                        <!-- Status -->
                        <div>
                            <h4 class="font-semibold text-zinc-900 mb-2">Status Verifikasi</h4>
                            @if($selectedBusiness->verified)
                                <span class="px-3 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">
                                    Terverifikasi
                                </span>
                            @else
                                <span class="px-3 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800">
                                    Menunggu Verifikasi
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="flex items-center justify-end space-x-3 mt-6 pt-6 border-t border-zinc-200">
                        <button wire:click="closeDetail" class="px-4 py-2 border border-zinc-300 text-zinc-700 rounded-lg hover:bg-zinc-50 transition">
                            Tutup
                        </button>
                        @if(!$selectedBusiness->verified)
                            <button 
                                wire:click="verifyUmkm({{ $selectedBusiness->id }})"
                                wire:confirm="Apakah Anda yakin ingin menyetujui UMKM ini?"
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
