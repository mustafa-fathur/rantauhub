@extends('components.layouts.user.dashboard', ['title' => $title ?? 'Dashboard'])

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex gap-6">
        <!-- Sidebar Card -->
        <x-user.sidebar :user="auth()->user()" />

        <!-- Main Content Area -->
        <main class="flex-1 min-w-0">
            <!-- Success/Info Messages -->
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

            @if(session('error'))
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg text-red-800">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Welcome Banner -->
            <div class="bg-primary rounded-xl p-8 mb-6 text-white relative overflow-hidden">
                <div class="relative z-10">
                    <h1 class="text-3xl font-bold mb-2">Selamat Datang, {{ auth()->user()->name }}!</h1>
                    <p class="text-primary-100 mb-2">RANTAU - RANGKAK ANAK NAGARI TUJUH ANDALAS UNGGUL</p>
                    <p class="text-primary-100 text-sm max-w-2xl">
                        Menghubungkan diaspora Minangkabau dengan UMKM lokal Sumatera Barat melalui investasi, mentorship, dan kolaborasi untuk ekonomi berkelanjutan.
                    </p>
                </div>
                <div class="absolute right-0 top-0 opacity-20">
                    <svg class="w-64 h-64 text-secondary" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                    </svg>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                <div class="bg-white rounded-lg p-6 shadow-sm border border-zinc-200">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-secondary/10 rounded-lg">
                            <svg class="w-6 h-6 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-sm font-medium text-zinc-600 mb-1">UMKM Terdaftar</h3>
                    <p class="text-2xl font-bold text-zinc-900">{{ $totalUmkm ?? 0 }}</p>
                </div>
                
                <div class="bg-white rounded-lg p-6 shadow-sm border border-zinc-200">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-secondary/10 rounded-lg">
                            <svg class="w-6 h-6 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-sm font-medium text-zinc-600 mb-1">Total Mentees</h3>
                    <p class="text-2xl font-bold text-zinc-900">N/A</p>
                </div>
                
                <div class="bg-white rounded-lg p-6 shadow-sm border border-zinc-200">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-secondary/10 rounded-lg">
                            <svg class="w-6 h-6 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-1-1.732l-4-2.309a2 2 0 00-1.732 0l-4 2.309A2 2 0 001 11.269V19a2 2 0 002 2h14a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-sm font-medium text-zinc-600 mb-1">Total Investasi</h3>
                    <p class="text-2xl font-bold text-zinc-900">N/A</p>
                </div>
                
                <div class="bg-white rounded-lg p-6 shadow-sm border border-zinc-200">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-secondary/10 rounded-lg">
                            <svg class="w-6 h-6 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-sm font-medium text-zinc-600 mb-1">Total Posts</h3>
                    <p class="text-2xl font-bold text-zinc-900">0</p>
                </div>
            </div>

            <!-- UMKM Registration Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @if(!auth()->user()->umkmOwner)
                    <!-- Register as UMKM Owner -->
                    <div class="bg-gradient-to-br from-primary/5 to-primary/10 rounded-lg p-6 shadow-sm border-2 border-primary/20">
                        <div class="flex flex-col items-center text-center">
                            <div class="p-4 bg-primary/10 rounded-lg mb-4">
                                <svg class="w-12 h-12 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-primary mb-2">Daftar sebagai UMKM Owner</h3>
                            <p class="text-sm text-zinc-600 mb-4">Lengkapi data diri untuk menjadi UMKM Owner</p>
                            <a href="{{ route('register.umkm-owner') }}" class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-primary-600 transition font-medium shadow-md">
                                Mulai
                            </a>
                        </div>
                    </div>
                @else
                    @php
                        $userUmkmCount = auth()->user()->umkmOwner->businesses()->count();
                    @endphp
                    @if($userUmkmCount > 0)
                        <!-- Manage UMKM -->
                        <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-lg p-6 shadow-sm border-2 border-green-200">
                            <div class="flex flex-col items-center text-center">
                                <div class="p-4 bg-green-100 rounded-lg mb-4">
                                    <svg class="w-12 h-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-green-800 mb-2">Kelola UMKM Anda</h3>
                                <p class="text-sm text-green-700 mb-2">Anda memiliki <span class="font-bold">{{ $userUmkmCount }}</span> UMKM terdaftar</p>
                                <a href="{{ route('my-umkm.index') }}" class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition font-medium shadow-md mt-2">
                                    Lihat UMKM Saya
                                </a>
                            </div>
                        </div>
                        <!-- Register New UMKM Business -->
                        <div class="bg-white rounded-lg p-6 shadow-sm border border-zinc-200">
                            <div class="flex flex-col items-center text-center">
                                <div class="p-4 bg-secondary/10 rounded-lg mb-4">
                                    <svg class="w-12 h-12 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-zinc-900 mb-2">Tambah UMKM Baru</h3>
                                <p class="text-sm text-zinc-600 mb-4">Daftarkan UMKM tambahan</p>
                                <a href="{{ route('register.umkm-business') }}" class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-primary-600 transition font-medium">
                                    Tambah
                                </a>
                            </div>
                        </div>
                    @else
                        <!-- Register First UMKM Business -->
                        <div class="bg-gradient-to-br from-primary/5 to-primary/10 rounded-lg p-6 shadow-sm border-2 border-primary/20">
                            <div class="flex flex-col items-center text-center">
                                <div class="p-4 bg-primary/10 rounded-lg mb-4">
                                    <svg class="w-12 h-12 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-primary mb-2">Daftarkan UMKM Pertama</h3>
                                <p class="text-sm text-zinc-600 mb-4">Registrasi UMKM untuk mendapat mentoring & funding</p>
                                <a href="{{ route('register.umkm-business') }}" class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-primary-600 transition font-medium shadow-md">
                                    Mulai
                                </a>
                            </div>
                        </div>
                    @endif
                @endif
                <div class="bg-white rounded-lg p-6 shadow-sm border border-zinc-200">
                    <div class="flex flex-col items-center text-center">
                        <div class="p-4 bg-secondary/10 rounded-lg mb-4">
                            <svg class="w-12 h-12 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-zinc-900 mb-2">Jadi Mentor</h3>
                        <p class="text-sm text-zinc-600 mb-4">Berbagi Keahlian Anda dengan UMKM Lokal</p>
                        <button class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-primary-600 transition font-medium">
                            Mulai
                        </button>
                    </div>
                </div>
                <div class="bg-white rounded-lg p-6 shadow-sm border border-zinc-200">
                    <div class="flex flex-col items-center text-center">
                        <div class="p-4 bg-secondary/10 rounded-lg mb-4">
                            <svg class="w-12 h-12 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-zinc-900 mb-2">Beri Pendanaan</h3>
                        <p class="text-sm text-zinc-600 mb-4">Dukung UMKM Lokal dengan Pendanaan</p>
                        <button class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-primary-600 transition font-medium">
                            Mulai
                        </button>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection
