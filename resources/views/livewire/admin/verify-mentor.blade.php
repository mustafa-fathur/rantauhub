<?php

use function Livewire\Volt\layout;
use Livewire\Volt\Component;
use App\Models\Mentor;
use Illuminate\Support\Facades\Auth;

layout('components.layouts.app.sidebar');

new class extends Component {
    public $selectedMentor = null;
    public $showDetailModal = false;

    public function with(): array
    {
        // Ambil semua Mentor dengan relasi user dan skills
        $mentors = Mentor::with(['user', 'skills'])
            ->latest()
            ->get();

        // Hitung statistik
        $totalMentors = $mentors->count();
        $pendingMentors = $mentors->where('verified', false)->count();
        $verifiedMentors = $mentors->where('verified', true)->count();

        return [
            'title' => 'Verifikasi Mentor',
            'mentors' => $mentors,
            'totalMentors' => $totalMentors,
            'pendingMentors' => $pendingMentors,
            'verifiedMentors' => $verifiedMentors,
        ];
    }

    public function verifyMentor($id): void
    {
        $mentor = Mentor::findOrFail($id);
        $mentor->update(['verified' => true]);

        // Optionally create verification log
        // You can add this if you have a VerificationLog model

        session()->flash('success', "Mentor '{$mentor->user->name}' telah disetujui dan diverifikasi.");
        
        // Close detail modal if open
        if ($this->selectedMentor && $this->selectedMentor->id === $id) {
            $this->closeDetail();
        }
    }

    public function rejectMentor($id): void
    {
        $mentor = Mentor::with('user')->findOrFail($id);
        $mentorName = $mentor->user->name;
        
        // Optionally: You can add a rejection reason field or create a log
        // For now, we'll keep the record but mark as unverified
        $mentor->update(['verified' => false]);
        
        session()->flash('info', "Mentor '{$mentorName}' telah ditolak.");
        
        // Close detail modal if open
        if ($this->selectedMentor && $this->selectedMentor->id === $id) {
            $this->closeDetail();
        }
    }

    public function showDetail($id): void
    {
        $this->selectedMentor = Mentor::with(['user', 'skills'])
            ->findOrFail($id);
        $this->showDetailModal = true;
    }

    public function closeDetail(): void
    {
        $this->showDetailModal = false;
        $this->selectedMentor = null;
    }
}; ?>

<div class="space-y-6">
    <!-- Page Header -->
    <div>
        <h1 class="text-3xl font-bold text-primary">Verifikasi Mentor</h1>
        <p class="text-zinc-600 mt-1">Kelola dan verifikasi mentor yang terdaftar</p>
    </div>

    <!-- Statistics -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-white rounded-lg p-6 shadow-sm border border-zinc-200">
            <h3 class="text-sm font-medium text-zinc-600 mb-1">Total Mentor</h3>
            <p class="text-2xl font-bold text-zinc-900">{{ $totalMentors }}</p>
        </div>
        <div class="bg-white rounded-lg p-6 shadow-sm border border-zinc-200">
            <h3 class="text-sm font-medium text-zinc-600 mb-1">Menunggu Verifikasi</h3>
            <p class="text-2xl font-bold text-yellow-600">{{ $pendingMentors }}</p>
        </div>
        <div class="bg-white rounded-lg p-6 shadow-sm border border-zinc-200">
            <h3 class="text-sm font-medium text-zinc-600 mb-1">Terverifikasi</h3>
            <p class="text-2xl font-bold text-green-600">{{ $verifiedMentors }}</p>
        </div>
    </div>

    <!-- Mentor List -->
    <div class="bg-white rounded-lg shadow-sm border border-zinc-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-zinc-200">
            <h2 class="text-lg font-semibold text-primary">Daftar Mentor</h2>
        </div>
        
        <div class="p-6 space-y-4">
            @forelse($mentors as $mentor)
            <div class="border border-zinc-200 rounded-lg p-6 hover:shadow-md transition">
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <div class="flex items-center space-x-4 mb-4">
                            <div class="w-16 h-16 rounded-full bg-primary text-white flex items-center justify-center">
                                @if($mentor->user->profile_photo)
                                    <img src="{{ asset('storage/' . $mentor->user->profile_photo) }}" alt="{{ $mentor->user->name }}" class="w-16 h-16 rounded-full object-cover">
                                @else
                                    <span class="text-xl font-semibold">{{ $mentor->user->initials() }}</span>
                                @endif
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center space-x-2 mb-1">
                                    <h3 class="text-lg font-semibold text-zinc-900">{{ $mentor->user->name }}</h3>
                                    @if($mentor->verified)
                                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">
                                            Terverifikasi
                                        </span>
                                    @else
                                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800">
                                            Pending
                                        </span>
                                    @endif
                                </div>
                                <p class="text-sm text-zinc-600">{{ $mentor->user->email }}</p>
                                @if($mentor->current_job)
                                    <p class="text-sm font-medium text-primary mt-1">{{ $mentor->current_job }}</p>
                                @endif
                            </div>
                            @if($mentor->reputation_score > 0)
                                <div class="text-right">
                                    <div class="flex items-center space-x-1 mb-1">
                                        <svg class="w-5 h-5 text-secondary" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                        </svg>
                                        <span class="font-semibold text-zinc-900">{{ number_format($mentor->reputation_score, 1) }}</span>
                                    </div>
                                </div>
                            @endif
                        </div>
                        
                        <div class="mb-4">
                            @if($mentor->experience)
                                <p class="text-sm text-zinc-700 mb-2">
                                    <span class="font-medium">Pengalaman:</span> 
                                    {{ Str::limit($mentor->experience, 150) }}
                                </p>
                            @endif
                            @if($mentor->about)
                                <p class="text-sm text-zinc-700">
                                    <span class="font-medium">Tentang:</span> 
                                    {{ Str::limit($mentor->about, 150) }}
                                </p>
                            @endif
                        </div>
                        
                        @if($mentor->skills->count() > 0)
                            <div class="flex flex-wrap gap-2">
                                @foreach($mentor->skills as $skill)
                                <span class="px-3 py-1 text-xs font-medium rounded-full bg-primary/10 text-primary">
                                    {{ $skill->skill }}
                                </span>
                                @endforeach
                            </div>
                        @endif
                    </div>
                    
                    <div class="ml-6 flex flex-col space-y-2">
                        @if(!$mentor->verified)
                            <button 
                                wire:click="verifyMentor({{ $mentor->id }})"
                                wire:confirm="Apakah Anda yakin ingin menyetujui mentor ini?"
                                class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition text-sm whitespace-nowrap"
                            >
                                Setujui
                            </button>
                            <button 
                                wire:click="rejectMentor({{ $mentor->id }})"
                                wire:confirm="Apakah Anda yakin ingin menolak mentor ini?"
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
                            wire:click="showDetail({{ $mentor->id }})"
                            class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-600 transition text-sm whitespace-nowrap"
                        >
                            Detail
                        </button>
                    </div>
                </div>
            </div>
            @empty
            <div class="text-center py-12 text-zinc-500">
                Tidak ada mentor yang terdaftar
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
    @if($showDetailModal && $selectedMentor)
        <div class="fixed inset-0 z-50 overflow-y-auto" x-data="{ show: @entangle('showDetailModal') }" x-show="show" x-transition>
            <div class="flex items-center justify-center min-h-screen px-4">
                <!-- Backdrop -->
                <div class="fixed inset-0 bg-black/50" wire:click="closeDetail"></div>
                
                <!-- Modal -->
                <div class="relative bg-white rounded-xl shadow-xl max-w-2xl w-full p-6 max-h-[90vh] overflow-y-auto">
                    <!-- Header -->
                    <div class="flex items-center justify-between mb-6 pb-4 border-b border-zinc-200">
                        <h2 class="text-2xl font-bold text-primary">Detail Mentor</h2>
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
                            <div class="w-20 h-20 rounded-full bg-primary text-white flex items-center justify-center flex-shrink-0">
                                @if($selectedMentor->user->profile_photo)
                                    <img src="{{ asset('storage/' . $selectedMentor->user->profile_photo) }}" alt="{{ $selectedMentor->user->name }}" class="w-20 h-20 rounded-full object-cover">
                                @else
                                    <span class="text-2xl font-semibold">{{ $selectedMentor->user->initials() }}</span>
                                @endif
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center space-x-2 mb-2">
                                    <h3 class="text-xl font-bold text-zinc-900">{{ $selectedMentor->user->name }}</h3>
                                    @if($selectedMentor->verified)
                                        <span class="px-3 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">
                                            Terverifikasi
                                        </span>
                                    @else
                                        <span class="px-3 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800">
                                            Menunggu Verifikasi
                                        </span>
                                    @endif
                                </div>
                                <p class="text-sm text-zinc-600">{{ $selectedMentor->user->email }}</p>
                                @if($selectedMentor->user->phone)
                                    <p class="text-sm text-zinc-600">{{ $selectedMentor->user->phone }}</p>
                                @endif
                            </div>
                            @if($selectedMentor->reputation_score > 0)
                                <div class="text-right">
                                    <div class="flex items-center space-x-1">
                                        <svg class="w-6 h-6 text-secondary" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                        </svg>
                                        <span class="text-xl font-bold text-zinc-900">{{ number_format($selectedMentor->reputation_score, 1) }}</span>
                                    </div>
                                    <p class="text-xs text-zinc-500 mt-1">Reputasi</p>
                                </div>
                            @endif
                        </div>

                        <!-- User Info -->
                        <div class="bg-zinc-50 rounded-lg p-4">
                            <h4 class="font-semibold text-zinc-900 mb-3">Informasi User</h4>
                            <div class="space-y-1 text-sm">
                                <p><span class="font-medium">Nama:</span> {{ $selectedMentor->user->name }}</p>
                                <p><span class="font-medium">Email:</span> {{ $selectedMentor->user->email }}</p>
                                @if($selectedMentor->user->phone)
                                    <p><span class="font-medium">Telepon:</span> {{ $selectedMentor->user->phone }}</p>
                                @endif
                                @if($selectedMentor->user->address)
                                    <p><span class="font-medium">Alamat:</span> {{ $selectedMentor->user->address }}</p>
                                @endif
                                @if($selectedMentor->user->bio)
                                    <p><span class="font-medium">Bio:</span> {{ $selectedMentor->user->bio }}</p>
                                @endif
                            </div>
                        </div>

                        <!-- Current Job -->
                        @if($selectedMentor->current_job)
                            <div>
                                <h4 class="font-semibold text-zinc-900 mb-2">Pekerjaan Saat Ini</h4>
                                <p class="text-zinc-600">{{ $selectedMentor->current_job }}</p>
                            </div>
                        @endif

                        <!-- Experience -->
                        @if($selectedMentor->experience)
                            <div>
                                <h4 class="font-semibold text-zinc-900 mb-2">Pengalaman</h4>
                                <p class="text-zinc-600 whitespace-pre-wrap">{{ $selectedMentor->experience }}</p>
                            </div>
                        @endif

                        <!-- About -->
                        @if($selectedMentor->about)
                            <div>
                                <h4 class="font-semibold text-zinc-900 mb-2">Tentang Mentor</h4>
                                <p class="text-zinc-600 whitespace-pre-wrap">{{ $selectedMentor->about }}</p>
                            </div>
                        @endif

                        <!-- Skills -->
                        @if($selectedMentor->skills->count() > 0)
                            <div>
                                <h4 class="font-semibold text-zinc-900 mb-3">Keahlian/Skills</h4>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($selectedMentor->skills as $skill)
                                        <span class="px-3 py-1 text-sm font-medium rounded-full bg-primary/10 text-primary">
                                            {{ $skill->skill }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Additional Info -->
                        <div class="grid grid-cols-2 gap-4 pt-4 border-t border-zinc-200">
                            <div>
                                <h4 class="font-semibold text-zinc-900 mb-2">Tanggal Pendaftaran</h4>
                                <p class="text-sm text-zinc-600">{{ $selectedMentor->created_at->format('d M Y H:i') }}</p>
                            </div>
                            <div>
                                <h4 class="font-semibold text-zinc-900 mb-2">Total Sesi Mentoring</h4>
                                <p class="text-sm text-zinc-600">{{ $selectedMentor->sessions()->count() }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="flex items-center justify-end space-x-3 mt-6 pt-6 border-t border-zinc-200">
                        <button wire:click="closeDetail" class="px-4 py-2 border border-zinc-300 text-zinc-700 rounded-lg hover:bg-zinc-50 transition">
                            Tutup
                        </button>
                        @if(!$selectedMentor->verified)
                            <button 
                                wire:click="verifyMentor({{ $selectedMentor->id }})"
                                wire:confirm="Apakah Anda yakin ingin menyetujui mentor ini?"
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
