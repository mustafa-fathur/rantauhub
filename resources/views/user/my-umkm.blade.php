@extends('components.layouts.user.dashboard', ['title' => $title ?? 'UMKM Saya'])

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
                    <h1 class="text-3xl font-bold text-primary mb-2">UMKM Saya</h1>
                    <p class="text-zinc-600">Kelola UMKM yang telah Anda daftarkan</p>
                </div>
                <a href="{{ route('register.umkm-business') }}" class="px-6 py-3 bg-primary text-white rounded-lg hover:bg-primary-600 transition font-medium shadow-md">
                    <div class="flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        <span>Tambah UMKM</span>
                    </div>
                </a>
            </div>

            @if(session('success'))
                <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg text-red-800">
                    {{ session('error') }}
                </div>
            @endif

            <!-- UMKM List -->
            @if($businesses->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($businesses as $business)
                        <div class="bg-white rounded-xl shadow-md border border-zinc-200 overflow-hidden hover:shadow-lg transition">
                            <!-- Logo/Image Section -->
                            <div class="h-48 bg-zinc-100 relative overflow-hidden">
                                @if($business->logo)
                                    <img src="{{ asset('storage/' . $business->logo) }}" alt="{{ $business->name }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-primary/10 to-secondary/10">
                                        <svg class="w-20 h-20 text-primary/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                        </svg>
                                    </div>
                                @endif
                                
                                <!-- Status Badge -->
                                <div class="absolute top-4 right-4">
                                    @if($business->verified)
                                        <span class="px-3 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800 shadow">
                                            Terverifikasi
                                        </span>
                                    @else
                                        <span class="px-3 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800 shadow">
                                            Menunggu Verifikasi
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Content Section -->
                            <div class="p-6">
                                <div class="flex items-start justify-between mb-3">
                                    <div class="flex-1">
                                        <h3 class="text-xl font-bold text-zinc-900 mb-1">{{ $business->name }}</h3>
                                        <span class="inline-block px-2 py-1 text-xs font-medium rounded-full bg-secondary/10 text-secondary mb-2">
                                            @if($business->category->value === 'lainnya' && $business->other_category)
                                                {{ $business->other_category }}
                                            @else
                                                {{ $business->category->label() }}
                                            @endif
                                        </span>
                                    </div>
                                </div>

                                <p class="text-sm text-zinc-600 mb-4 line-clamp-2">{{ $business->description ?? 'Tidak ada deskripsi' }}</p>

                                <div class="flex items-center text-xs text-zinc-500 mb-4">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <span>{{ $business->location ?? 'N/A' }}</span>
                                </div>

                                <!-- Actions -->
                                <div class="flex items-center justify-between pt-4 border-t border-zinc-200">
                                    <div class="flex items-center space-x-2">
                                        <a href="{{ route('my-umkm.edit', $business->id) }}" class="px-4 py-2 text-sm bg-zinc-100 text-zinc-700 rounded-lg hover:bg-zinc-200 transition font-medium">
                                            Edit
                                        </a>
                                        <form action="{{ route('my-umkm.destroy', $business->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus UMKM ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-4 py-2 text-sm bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition font-medium">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Empty State -->
                <div class="bg-white rounded-xl shadow-md border border-zinc-200 p-12 text-center">
                    <div class="flex flex-col items-center">
                        <div class="w-24 h-24 rounded-full bg-primary/10 flex items-center justify-center mb-6">
                            <svg class="w-12 h-12 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-zinc-900 mb-2">Belum Ada UMKM Terdaftar</h3>
                        <p class="text-zinc-600 mb-6 max-w-md">Mulai daftarkan UMKM Anda untuk mendapat mentoring dan pendanaan</p>
                        <a href="{{ route('register.umkm-business') }}" class="px-6 py-3 bg-primary text-white rounded-lg hover:bg-primary-600 transition font-medium shadow-md">
                            Daftarkan UMKM Pertama
                        </a>
                    </div>
                </div>
            @endif
        </main>
    </div>
</div>
@endsection

