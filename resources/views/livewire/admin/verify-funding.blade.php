<?php

use function Livewire\Volt\layout;
use Livewire\Volt\Component;
use App\Models\Funding;
use App\Enums\FundingStatus;
use Illuminate\Support\Facades\Auth;

layout('components.layouts.app.sidebar');

new class extends Component {
    public $selectedFunding = null;
    public $showDetailModal = false;

    public function with(): array
    {
        // Get funding requests waiting for admin approval (OPEN_REQUEST status)
        $pendingRequests = Funding::with(['business.owner.user'])
            ->where('status', FundingStatus::OPEN_REQUEST)
            ->latest()
            ->get();

        // Get funding requests that already have funder but waiting for admin approval (PENDING status)
        $pendingTransfers = Funding::with(['business.owner.user', 'funder.user'])
            ->where('status', FundingStatus::PENDING)
            ->latest()
            ->get();

        // Calculate statistics
        $totalPendingRequests = $pendingRequests->count();
        $totalPendingTransfers = $pendingTransfers->count();
        $totalApproved = Funding::where('status', FundingStatus::APPROVED)->count();
        $totalAmount = Funding::whereIn('status', [FundingStatus::APPROVED, FundingStatus::DISBURSED])->sum('amount');

        return [
            'title' => 'Verifikasi Pendanaan',
            'pendingRequests' => $pendingRequests,
            'pendingTransfers' => $pendingTransfers,
            'totalPendingRequests' => $totalPendingRequests,
            'totalPendingTransfers' => $totalPendingTransfers,
            'totalApproved' => $totalApproved,
            'totalAmount' => $totalAmount,
        ];
    }

    public function approveRequest($id): void
    {
        $funding = Funding::findOrFail($id);
        
        if ($funding->status !== FundingStatus::OPEN_REQUEST) {
            session()->flash('error', 'Hanya request dengan status menunggu verifikasi yang dapat disetujui.');
            return;
        }

        // Approve request - change status to OPEN so funders can see it
        $funding->update(['status' => FundingStatus::OPEN]);

        session()->flash('success', "Request pendanaan dari '{$funding->business->name}' telah disetujui dan sekarang terbuka untuk funder.");
        
        if ($this->selectedFunding && $this->selectedFunding->id === $id) {
            $this->closeDetail();
        }
    }

    public function rejectRequest($id): void
    {
        $funding = Funding::with('business')->findOrFail($id);
        
        if ($funding->status !== FundingStatus::OPEN_REQUEST) {
            session()->flash('error', 'Hanya request dengan status menunggu verifikasi yang dapat ditolak.');
            return;
        }

        $businessName = $funding->business->name;
        $funding->update(['status' => FundingStatus::REJECTED]);
        
        session()->flash('info', "Request pendanaan dari '{$businessName}' telah ditolak.");
        
        if ($this->selectedFunding && $this->selectedFunding->id === $id) {
            $this->closeDetail();
        }
    }

    public function approveTransfer($id): void
    {
        $funding = Funding::with('business')->findOrFail($id);
        
        if ($funding->status !== FundingStatus::PENDING) {
            session()->flash('error', 'Hanya transfer dengan status pending yang dapat disetujui.');
            return;
        }

        $funding->update(['status' => FundingStatus::APPROVED]);

        session()->flash('success', "Transfer pendanaan untuk '{$funding->business->name}' telah disetujui.");
    }

    public function rejectTransfer($id): void
    {
        $funding = Funding::with('business')->findOrFail($id);
        
        if ($funding->status !== FundingStatus::PENDING) {
            session()->flash('error', 'Hanya transfer dengan status pending yang dapat ditolak.');
            return;
        }

        // Reject transfer - remove funder and set back to OPEN
        $businessName = $funding->business->name;
        $funding->update([
            'status' => FundingStatus::OPEN,
            'funder_id' => null,
            'proof_of_transfer' => null,
        ]);
        
        session()->flash('info', "Transfer pendanaan untuk '{$businessName}' telah ditolak dan request kembali terbuka.");
    }

    public function showDetail($id, $type = 'request'): void
    {
        if ($type === 'request') {
            $this->selectedFunding = Funding::with(['business.owner.user'])
                ->where('status', FundingStatus::OPEN_REQUEST)
                ->findOrFail($id);
        } else {
            $this->selectedFunding = Funding::with(['business.owner.user', 'funder.user'])
                ->where('status', FundingStatus::PENDING)
                ->findOrFail($id);
        }
        $this->showDetailModal = true;
    }

    public function closeDetail(): void
    {
        $this->showDetailModal = false;
        $this->selectedFunding = null;
    }
}; ?>

<div class="space-y-6">
    <!-- Page Header -->
    <div>
        <h1 class="text-3xl font-bold text-primary">Verifikasi Pendanaan</h1>
        <p class="text-zinc-600 mt-1">Kelola dan verifikasi request pendanaan dari UMKM</p>
    </div>

    <!-- Statistics -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-white rounded-lg p-6 shadow-sm border border-zinc-200">
            <h3 class="text-sm font-medium text-zinc-600 mb-1">Menunggu Verifikasi</h3>
            <p class="text-2xl font-bold text-yellow-600">{{ $totalPendingRequests }}</p>
        </div>
        <div class="bg-white rounded-lg p-6 shadow-sm border border-zinc-200">
            <h3 class="text-sm font-medium text-zinc-600 mb-1">Menunggu Approval Transfer</h3>
            <p class="text-2xl font-bold text-orange-600">{{ $totalPendingTransfers }}</p>
        </div>
        <div class="bg-white rounded-lg p-6 shadow-sm border border-zinc-200">
            <h3 class="text-sm font-medium text-zinc-600 mb-1">Disetujui</h3>
            <p class="text-2xl font-bold text-green-600">{{ $totalApproved }}</p>
        </div>
        <div class="bg-white rounded-lg p-6 shadow-sm border border-zinc-200">
            <h3 class="text-sm font-medium text-zinc-600 mb-1">Total Nilai</h3>
            <p class="text-2xl font-bold text-primary">Rp {{ number_format($totalAmount, 0, ',', '.') }}</p>
        </div>
    </div>

    <!-- Request Pendanaan Menunggu Verifikasi -->
    <div class="bg-white rounded-lg shadow-sm border border-zinc-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-zinc-200">
            <h2 class="text-lg font-semibold text-primary">Request Pendanaan Menunggu Verifikasi</h2>
            <p class="text-sm text-zinc-600 mt-1">Verifikasi request pendanaan dari UMKM sebelum dibuka untuk funder</p>
        </div>
        
        <div class="p-6 space-y-4">
            @forelse($pendingRequests as $funding)
            <div class="border border-zinc-200 rounded-lg p-6 hover:shadow-md transition">
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <div class="grid grid-cols-2 gap-6 mb-4">
                            <div>
                                <p class="text-xs text-zinc-500 mb-1">UMKM Business</p>
                                <p class="text-sm font-semibold text-zinc-900">{{ $funding->business->name }}</p>
                                <p class="text-xs text-zinc-600 mt-1">{{ $funding->business->location }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-zinc-500 mb-1">Pemilik</p>
                                <p class="text-sm font-semibold text-zinc-900">{{ $funding->business->owner->user->name }}</p>
                                <p class="text-xs text-zinc-600 mt-1">{{ $funding->business->owner->user->email }}</p>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <p class="text-xs text-zinc-500 mb-1">Jumlah Pendanaan</p>
                                <p class="text-lg font-bold text-primary">Rp {{ number_format($funding->amount, 0, ',', '.') }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-zinc-500 mb-1">Tanggal Request</p>
                                <p class="text-sm text-zinc-900">{{ $funding->created_at->format('d M Y H:i') }}</p>
                            </div>
                        </div>
                        
                        @if($funding->description)
                            <div class="mt-4 pt-4 border-t border-zinc-200">
                                <p class="text-xs text-zinc-500 mb-1">Deskripsi Permohonan</p>
                                <p class="text-sm text-zinc-700 whitespace-pre-wrap">{{ $funding->description }}</p>
                            </div>
                        @endif
                    </div>
                    
                    <div class="ml-6 flex flex-col space-y-2">
                        <button 
                            wire:click="approveRequest({{ $funding->id }})"
                            wire:confirm="Apakah Anda yakin ingin menyetujui request pendanaan ini? Request akan terbuka untuk funder."
                            class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition text-sm whitespace-nowrap"
                        >
                            Setujui
                        </button>
                        <button 
                            wire:click="rejectRequest({{ $funding->id }})"
                            wire:confirm="Apakah Anda yakin ingin menolak request pendanaan ini?"
                            class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition text-sm whitespace-nowrap"
                        >
                            Tolak
                        </button>
                        <button 
                            wire:click="showDetail({{ $funding->id }}, 'request')"
                            class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-600 transition text-sm whitespace-nowrap"
                        >
                            Detail
                        </button>
                    </div>
                </div>
            </div>
            @empty
            <div class="text-center py-12 text-zinc-500">
                Tidak ada request pendanaan yang menunggu verifikasi
            </div>
            @endforelse
        </div>
    </div>

    <!-- Transfer Pendanaan Menunggu Approval -->
    @if($pendingTransfers->count() > 0)
        <div class="bg-white rounded-lg shadow-sm border border-zinc-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-zinc-200">
                <h2 class="text-lg font-semibold text-primary">Transfer Pendanaan Menunggu Approval</h2>
                <p class="text-sm text-zinc-600 mt-1">Verifikasi bukti transfer dari funder</p>
            </div>
            
            <div class="p-6 space-y-4">
                @foreach($pendingTransfers as $funding)
                <div class="border border-zinc-200 rounded-lg p-6 hover:shadow-md transition">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <div class="grid grid-cols-2 gap-6 mb-4">
                                <div>
                                    <p class="text-xs text-zinc-500 mb-1">Funder</p>
                                    <p class="text-sm font-semibold text-zinc-900">{{ $funding->funder->user->name }}</p>
                                    @if($funding->funder->organization_name)
                                        <p class="text-xs text-zinc-600 mt-1">{{ $funding->funder->organization_name }}</p>
                                    @endif
                                </div>
                                <div>
                                    <p class="text-xs text-zinc-500 mb-1">UMKM Business</p>
                                    <p class="text-sm font-semibold text-zinc-900">{{ $funding->business->name }}</p>
                                    <p class="text-xs text-zinc-600 mt-1">{{ $funding->business->location }}</p>
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-3 gap-6">
                                <div>
                                    <p class="text-xs text-zinc-500 mb-1">Jumlah Pendanaan</p>
                                    <p class="text-lg font-bold text-primary">Rp {{ number_format($funding->amount, 0, ',', '.') }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-zinc-500 mb-1">Status</p>
                                    <span class="inline-flex px-3 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800">
                                        Pending Approval
                                    </span>
                                </div>
                                <div>
                                    <p class="text-xs text-zinc-500 mb-1">Tanggal</p>
                                    <p class="text-sm text-zinc-900">{{ $funding->created_at->format('d M Y H:i') }}</p>
                                </div>
                            </div>
                            
                            @if($funding->proof_of_transfer)
                                <div class="mt-4 pt-4 border-t border-zinc-200">
                                    <p class="text-xs text-zinc-500 mb-2">Bukti Transfer</p>
                                    <a href="{{ asset('storage/' . $funding->proof_of_transfer) }}" target="_blank" class="inline-flex items-center space-x-2 text-sm text-primary hover:text-primary-600">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                                        </svg>
                                        <span>Lihat Bukti Transfer</span>
                                    </a>
                                </div>
                            @endif
                        </div>
                        
                        <div class="ml-6 flex flex-col space-y-2">
                            <button 
                                wire:click="approveTransfer({{ $funding->id }})"
                                wire:confirm="Apakah Anda yakin ingin menyetujui transfer pendanaan ini?"
                                class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition text-sm whitespace-nowrap"
                            >
                                Setujui
                            </button>
                            <button 
                                wire:click="rejectTransfer({{ $funding->id }})"
                                wire:confirm="Apakah Anda yakin ingin menolak transfer pendanaan ini? Request akan kembali terbuka untuk funder lain."
                                class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition text-sm whitespace-nowrap"
                            >
                                Tolak
                            </button>
                            <button 
                                wire:click="showDetail({{ $funding->id }}, 'transfer')"
                                class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-600 transition text-sm whitespace-nowrap"
                            >
                                Detail
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    @endif

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

    @if(session()->has('error'))
        <div class="fixed top-4 right-4 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg shadow-lg z-50" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)">
            <div class="flex items-center space-x-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
                <span>{{ session('error') }}</span>
            </div>
        </div>
    @endif

    <!-- Detail Modal -->
    @if($showDetailModal && $selectedFunding)
        <div class="fixed inset-0 z-50 overflow-y-auto" x-data="{ show: @entangle('showDetailModal') }" x-show="show" x-transition>
            <div class="flex items-center justify-center min-h-screen px-4">
                <!-- Backdrop -->
                <div class="fixed inset-0 bg-black/50" wire:click="closeDetail"></div>
                
                <!-- Modal -->
                <div class="relative bg-white rounded-xl shadow-xl max-w-2xl w-full p-6 max-h-[90vh] overflow-y-auto">
                    <!-- Header -->
                    <div class="flex items-center justify-between mb-6 pb-4 border-b border-zinc-200">
                        <h2 class="text-2xl font-bold text-primary">Detail Request Pendanaan</h2>
                        <button wire:click="closeDetail" class="text-zinc-400 hover:text-zinc-600 transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <!-- Content -->
                    <div class="space-y-6">
                        <!-- Business Info -->
                        <div>
                            <h3 class="font-semibold text-zinc-900 mb-3">Informasi UMKM</h3>
                            <div class="bg-zinc-50 rounded-lg p-4 space-y-2 text-sm">
                                <p><span class="font-medium">Nama:</span> {{ $selectedFunding->business->name }}</p>
                                <p><span class="font-medium">Lokasi:</span> {{ $selectedFunding->business->location }}</p>
                                <p><span class="font-medium">Kategori:</span> 
                                    @if($selectedFunding->business->category->value === 'lainnya' && $selectedFunding->business->other_category)
                                        {{ $selectedFunding->business->other_category }}
                                    @else
                                        {{ $selectedFunding->business->category->label() }}
                                    @endif
                                </p>
                                @if($selectedFunding->business->description)
                                    <p><span class="font-medium">Deskripsi:</span> {{ $selectedFunding->business->description }}</p>
                                @endif
                            </div>
                        </div>

                        <!-- Owner Info -->
                        <div>
                            <h3 class="font-semibold text-zinc-900 mb-3">Informasi Pemilik</h3>
                            <div class="bg-zinc-50 rounded-lg p-4 space-y-2 text-sm">
                                <p><span class="font-medium">Nama:</span> {{ $selectedFunding->business->owner->user->name }}</p>
                                <p><span class="font-medium">Email:</span> {{ $selectedFunding->business->owner->user->email }}</p>
                                @if($selectedFunding->business->owner->user->phone)
                                    <p><span class="font-medium">Telepon:</span> {{ $selectedFunding->business->owner->user->phone }}</p>
                                @endif
                            </div>
                        </div>

                        <!-- Funding Details -->
                        <div>
                            <h3 class="font-semibold text-zinc-900 mb-3">Detail Request</h3>
                            <div class="bg-primary/5 rounded-lg p-4 border border-primary/20 space-y-2">
                                <div class="flex justify-between">
                                    <span class="text-zinc-600">Jumlah Pendanaan:</span>
                                    <span class="text-lg font-bold text-primary">Rp {{ number_format($selectedFunding->amount, 0, ',', '.') }}</span>
                                </div>
                                @if($selectedFunding->description)
                                    <div class="pt-2 border-t border-primary/20">
                                        <p class="text-sm font-medium text-zinc-700 mb-1">Alasan Permohonan:</p>
                                        <p class="text-zinc-600 whitespace-pre-wrap">{{ $selectedFunding->description }}</p>
                                    </div>
                                @endif
                                <div class="pt-2 border-t border-primary/20">
                                    <p class="text-sm text-zinc-600">Tanggal Request: {{ $selectedFunding->created_at->format('d M Y H:i') }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Funder Info (if exists) -->
                        @if($selectedFunding->funder)
                            <div>
                                <h3 class="font-semibold text-zinc-900 mb-3">Informasi Funder</h3>
                                <div class="bg-zinc-50 rounded-lg p-4 space-y-2 text-sm">
                                    <p><span class="font-medium">Nama:</span> {{ $selectedFunding->funder->user->name }}</p>
                                    <p><span class="font-medium">Email:</span> {{ $selectedFunding->funder->user->email }}</p>
                                    @if($selectedFunding->funder->organization_name)
                                        <p><span class="font-medium">Organisasi:</span> {{ $selectedFunding->funder->organization_name }}</p>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Footer -->
                    <div class="flex items-center justify-end space-x-3 mt-6 pt-6 border-t border-zinc-200">
                        <button wire:click="closeDetail" class="px-4 py-2 border border-zinc-300 text-zinc-700 rounded-lg hover:bg-zinc-50 transition">
                            Tutup
                        </button>
                        @if($selectedFunding->status === FundingStatus::OPEN_REQUEST)
                            <button 
                                wire:click="approveRequest({{ $selectedFunding->id }})"
                                wire:confirm="Apakah Anda yakin ingin menyetujui request pendanaan ini?"
                                class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition"
                            >
                                Setujui Request
                            </button>
                        @elseif($selectedFunding->status === FundingStatus::PENDING)
                            <button 
                                wire:click="approveTransfer({{ $selectedFunding->id }})"
                                wire:confirm="Apakah Anda yakin ingin menyetujui transfer pendanaan ini?"
                                class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition"
                            >
                                Setujui Transfer
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
