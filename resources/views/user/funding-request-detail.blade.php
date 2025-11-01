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
                    <p class="text-zinc-600">Informasi lengkap tentang request pendanaan Anda</p>
                </div>
                <a href="{{ route('funding-requests.index') }}" class="px-4 py-2 border border-zinc-300 text-zinc-700 rounded-lg hover:bg-zinc-50 transition font-medium">
                    Kembali
                </a>
            </div>

            <!-- Detail Card -->
            <div class="bg-white rounded-xl shadow-md border border-zinc-200 p-6 md:p-8 space-y-6">
                <!-- Status Badge -->
                <div class="flex items-center justify-between pb-6 border-b border-zinc-200">
                    <h2 class="text-xl font-bold text-zinc-900">Status Request</h2>
                    @if($funding->status === \App\Enums\FundingStatus::PENDING)
                        <span class="px-4 py-2 text-sm font-medium rounded-full bg-yellow-100 text-yellow-800">
                            Pending
                        </span>
                    @elseif($funding->status === \App\Enums\FundingStatus::APPROVED)
                        <span class="px-4 py-2 text-sm font-medium rounded-full bg-green-100 text-green-800">
                            Disetujui
                        </span>
                    @elseif($funding->status === \App\Enums\FundingStatus::REJECTED)
                        <span class="px-4 py-2 text-sm font-medium rounded-full bg-red-100 text-red-800">
                            Ditolak
                        </span>
                    @elseif($funding->status === \App\Enums\FundingStatus::DISBURSED)
                        <span class="px-4 py-2 text-sm font-medium rounded-full bg-blue-100 text-blue-800">
                            Dicairkan
                        </span>
                    @endif
                </div>

                <!-- UMKM Info -->
                <div class="bg-zinc-50 rounded-lg p-4">
                    <h3 class="font-semibold text-zinc-900 mb-3">Informasi UMKM</h3>
                    <div class="space-y-2 text-sm">
                        <p><span class="font-medium">Nama UMKM:</span> {{ $funding->business->name }}</p>
                        <p><span class="font-medium">Kategori:</span> 
                            @if($funding->business->category->value === 'lainnya' && $funding->business->other_category)
                                {{ $funding->business->other_category }}
                            @else
                                {{ $funding->business->category->label() }}
                            @endif
                        </p>
                        <p><span class="font-medium">Lokasi:</span> {{ $funding->business->location }}</p>
                        @if($funding->business->description)
                            <p><span class="font-medium">Deskripsi:</span> {{ $funding->business->description }}</p>
                        @endif
                    </div>
                </div>

                <!-- Funder Info -->
                <div class="bg-zinc-50 rounded-lg p-4">
                    <h3 class="font-semibold text-zinc-900 mb-3">Informasi Funder</h3>
                    <div class="space-y-2 text-sm">
                        <p><span class="font-medium">Nama:</span> {{ $funding->funder->user->name }}</p>
                        <p><span class="font-medium">Email:</span> {{ $funding->funder->user->email }}</p>
                        @if($funding->funder->organization_name)
                            <p><span class="font-medium">Organisasi:</span> {{ $funding->funder->organization_name }}</p>
                        @else
                            <p><span class="font-medium">Tipe:</span> Individu</p>
                        @endif
                    </div>
                </div>

                <!-- Funding Details -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="font-semibold text-zinc-900 mb-2">Jumlah Pendanaan</h3>
                        <p class="text-2xl font-bold text-primary">Rp {{ number_format($funding->amount, 0, ',', '.') }}</p>
                    </div>
                    <div>
                        <h3 class="font-semibold text-zinc-900 mb-2">Tanggal Request</h3>
                        <p class="text-zinc-600">{{ $funding->created_at->format('d M Y H:i') }}</p>
                    </div>
                </div>

                @if($funding->description)
                    <div>
                        <h3 class="font-semibold text-zinc-900 mb-2">Deskripsi Permohonan</h3>
                        <p class="text-zinc-600 whitespace-pre-wrap">{{ $funding->description }}</p>
                    </div>
                @endif

                @if($funding->proof_of_transfer)
                    <div>
                        <h3 class="font-semibold text-zinc-900 mb-2">Bukti Transfer</h3>
                        <a href="{{ asset('storage/' . $funding->proof_of_transfer) }}" target="_blank" class="text-primary hover:text-primary-600 underline">
                            Lihat Bukti Transfer
                        </a>
                    </div>
                @endif

                <!-- Actions -->
                @if($funding->status === \App\Enums\FundingStatus::PENDING)
                    <div class="pt-6 border-t border-zinc-200">
                        <form action="{{ route('funding-requests.cancel', $funding->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan request ini?');">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition font-medium">
                                Batalkan Request
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        </main>
    </div>
</div>
@endsection

