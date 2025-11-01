<?php

use function Livewire\Volt\layout;
use Livewire\Volt\Component;

layout('components.layouts.app.sidebar');

new class extends Component {
    public function with(): array
    {
        // Data dummy untuk Mentor yang perlu diverifikasi
        $mentors = [
            [
                'id' => 1,
                'name' => 'Bayu Andrawati, S.E., M.M.',
                'email' => 'bayu.andrawati@example.com',
                'current_job' => 'CEO, PT Kuliner Nusantara',
                'experience' => '15+ tahun di bidang F&B dan ekspor kuliner',
                'about' => 'Pengusaha sukses asal Padang, kini menetap di Jakarta. Berpengalaman 15+ tahun di bidang F&B dan ekspor kuliner.',
                'reputation_score' => 4.9,
                'skills' => ['Marketing', 'F&B Business', 'Social Media'],
                'verified' => false,
                'created_at' => '2025-11-01 09:00:00',
            ],
            [
                'id' => 2,
                'name' => 'Ahmad Hidayat, S.Kom.',
                'email' => 'ahmad.hidayat@example.com',
                'current_job' => 'Tech Entrepreneur',
                'experience' => '12+ tahun di bidang digital marketing dan e-commerce',
                'about' => 'Tech entrepreneur dengan pengalaman 12+ tahun di bidang digital marketing dan e-commerce.',
                'reputation_score' => 4.8,
                'skills' => ['Digital Marketing', 'E-Commerce', 'Technology'],
                'verified' => false,
                'created_at' => '2025-11-01 10:00:00',
            ],
            [
                'id' => 3,
                'name' => 'Rina Sari, S.Pd.',
                'email' => 'rina.sari@example.com',
                'current_job' => 'Fashion Entrepreneur',
                'experience' => '10+ tahun di industri fashion',
                'about' => 'Pengusaha fashion dengan keahlian dalam branding dan retail management. Memiliki jaringan luas di industri mode Indonesia.',
                'reputation_score' => 4.7,
                'skills' => ['Branding', 'Retail', 'Fashion'],
                'verified' => false,
                'created_at' => '2025-11-01 11:00:00',
            ],
        ];

        return [
            'title' => 'Verifikasi Mentor',
            'mentors' => $mentors,
        ];
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
            <p class="text-2xl font-bold text-zinc-900">{{ count($mentors) }}</p>
        </div>
        <div class="bg-white rounded-lg p-6 shadow-sm border border-zinc-200">
            <h3 class="text-sm font-medium text-zinc-600 mb-1">Menunggu Verifikasi</h3>
            <p class="text-2xl font-bold text-yellow-600">{{ count($mentors) }}</p>
        </div>
        <div class="bg-white rounded-lg p-6 shadow-sm border border-zinc-200">
            <h3 class="text-sm font-medium text-zinc-600 mb-1">Terverifikasi</h3>
            <p class="text-2xl font-bold text-green-600">0</p>
        </div>
    </div>

    <!-- Mentor List -->
    <div class="bg-white rounded-lg shadow-sm border border-zinc-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-zinc-200">
            <h2 class="text-lg font-semibold text-primary">Daftar Mentor Menunggu Verifikasi</h2>
        </div>
        
        <div class="p-6 space-y-4">
            @forelse($mentors as $mentor)
            <div class="border border-zinc-200 rounded-lg p-6 hover:shadow-md transition">
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <div class="flex items-center space-x-4 mb-4">
                            <div class="w-16 h-16 rounded-full bg-primary text-white flex items-center justify-center">
                                <span class="text-xl font-semibold">{{ Str::substr($mentor['name'], 0, 2) }}</span>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold text-zinc-900">{{ $mentor['name'] }}</h3>
                                <p class="text-sm text-zinc-600">{{ $mentor['email'] }}</p>
                                <p class="text-sm font-medium text-primary mt-1">{{ $mentor['current_job'] }}</p>
                            </div>
                            <div class="text-right">
                                <div class="flex items-center space-x-1 mb-1">
                                    <svg class="w-5 h-5 text-secondary" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                    <span class="font-semibold text-zinc-900">{{ $mentor['reputation_score'] }}</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <p class="text-sm text-zinc-700 mb-2"><span class="font-medium">Pengalaman:</span> {{ $mentor['experience'] }}</p>
                            <p class="text-sm text-zinc-700"><span class="font-medium">Tentang:</span> {{ $mentor['about'] }}</p>
                        </div>
                        
                        <div class="flex flex-wrap gap-2">
                            @foreach($mentor['skills'] as $skill)
                            <span class="px-3 py-1 text-xs font-medium rounded-full bg-primary/10 text-primary">
                                {{ $skill }}
                            </span>
                            @endforeach
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
                Tidak ada mentor yang menunggu verifikasi
            </div>
            @endforelse
        </div>
    </div>
</div>
