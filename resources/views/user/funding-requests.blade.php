@extends('components.layouts.user.dashboard', ['title' => $title ?? 'Request Pendanaan'])

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
                    <h1 class="text-3xl font-bold text-primary mb-2">Request Pendanaan</h1>
                    <p class="text-zinc-600">Kelola request pendanaan untuk UMKM Anda</p>
                </div>
                @if($businesses->count() > 0)
                    <a href="{{ route('funding-requests.create') }}" class="px-6 py-3 bg-primary text-white rounded-lg hover:bg-primary-600 transition font-medium shadow-md">
                        <div class="flex items-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            <span>Buat Request</span>
                        </div>
                    </a>
                @endif
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

            @if($businesses->isEmpty())
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6 mb-6">
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-yellow-600 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                        <div>
                            <h3 class="font-semibold text-yellow-800 mb-1">Tidak Ada UMKM Terverifikasi</h3>
                            <p class="text-sm text-yellow-700 mb-3">
                                Anda harus memiliki setidaknya satu UMKM yang sudah terverifikasi untuk membuat request pendanaan.
                            </p>
                            <a href="{{ route('my-umkm.index') }}" class="inline-block px-4 py-2 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 transition text-sm font-medium">
                                Kelola UMKM Saya
                            </a>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-6">
                <div class="bg-white rounded-lg p-4 shadow-sm border border-zinc-200">
                    <h3 class="text-sm font-medium text-zinc-600 mb-1">Total Request</h3>
                    <p class="text-2xl font-bold text-zinc-900">{{ $fundingRequests->count() }}</p>
                </div>
                <div class="bg-white rounded-lg p-4 shadow-sm border border-zinc-200">
                    <h3 class="text-sm font-medium text-zinc-600 mb-1">Menunggu Admin</h3>
                    <p class="text-2xl font-bold text-yellow-600">{{ $fundingRequests->where('status', \App\Enums\FundingStatus::OPEN_REQUEST)->count() }}</p>
                </div>
                <div class="bg-white rounded-lg p-4 shadow-sm border border-zinc-200">
                    <h3 class="text-sm font-medium text-zinc-600 mb-1">Open</h3>
                    <p class="text-2xl font-bold text-blue-600">{{ $fundingRequests->where('status', \App\Enums\FundingStatus::OPEN)->count() }}</p>
                </div>
                <div class="bg-white rounded-lg p-4 shadow-sm border border-zinc-200">
                    <h3 class="text-sm font-medium text-zinc-600 mb-1">Pending</h3>
                    <p class="text-2xl font-bold text-yellow-600">{{ $fundingRequests->where('status', \App\Enums\FundingStatus::PENDING)->count() }}</p>
                </div>
                <div class="bg-white rounded-lg p-4 shadow-sm border border-zinc-200">
                    <h3 class="text-sm font-medium text-zinc-600 mb-1">Disetujui</h3>
                    <p class="text-2xl font-bold text-green-600">{{ $fundingRequests->where('status', \App\Enums\FundingStatus::APPROVED)->count() }}</p>
                </div>
            </div>

            <!-- Funding Requests List -->
            @if($fundingRequests->count() > 0)
                <div class="bg-white rounded-xl shadow-md border border-zinc-200 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-zinc-50 border-b border-zinc-200">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-zinc-700 uppercase tracking-wider">UMKM</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-zinc-700 uppercase tracking-wider">Funder / Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-zinc-700 uppercase tracking-wider">Jumlah</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-zinc-700 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-zinc-700 uppercase tracking-wider">Tanggal</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-zinc-700 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-zinc-200">
                                @foreach($fundingRequests as $funding)
                                    <tr class="hover:bg-zinc-50 transition">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-semibold text-zinc-900">{{ $funding->business->name }}</div>
                                            <div class="text-xs text-zinc-500">{{ $funding->business->location }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($funding->funder)
                                                <div class="text-sm text-zinc-900">{{ $funding->funder->user->name }}</div>
                                                <div class="text-xs text-zinc-500">{{ $funding->funder->organization_name ?? 'Individu' }}</div>
                                            @else
                                                <span class="px-3 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">
                                                    Menunggu Funder
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-semibold text-zinc-900">Rp {{ number_format($funding->amount, 0, ',', '.') }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($funding->status === \App\Enums\FundingStatus::OPEN_REQUEST)
                                                <span class="px-3 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800">
                                                    Menunggu Verifikasi Admin
                                                </span>
                                            @elseif($funding->status === \App\Enums\FundingStatus::OPEN)
                                                <span class="px-3 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">
                                                    Open
                                                </span>
                                            @elseif($funding->status === \App\Enums\FundingStatus::PENDING)
                                                <span class="px-3 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800">
                                                    Pending
                                                </span>
                                            @elseif($funding->status === \App\Enums\FundingStatus::APPROVED)
                                                <span class="px-3 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">
                                                    Disetujui
                                                </span>
                                            @elseif($funding->status === \App\Enums\FundingStatus::REJECTED)
                                                <span class="px-3 py-1 text-xs font-medium rounded-full bg-red-100 text-red-800">
                                                    Ditolak
                                                </span>
                                            @elseif($funding->status === \App\Enums\FundingStatus::DISBURSED)
                                                <span class="px-3 py-1 text-xs font-medium rounded-full bg-purple-100 text-purple-800">
                                                    Dicairkan
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-600">
                                            {{ $funding->created_at->format('d M Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <div class="flex items-center justify-end space-x-2">
                                                <a href="{{ route('funding-requests.show', $funding->id) }}" class="px-3 py-1 bg-primary text-white rounded-lg hover:bg-primary-600 transition text-sm">
                                                    Detail
                                                </a>
                                                @if(in_array($funding->status, [\App\Enums\FundingStatus::OPEN_REQUEST, \App\Enums\FundingStatus::OPEN, \App\Enums\FundingStatus::PENDING]))
                                                    <form action="{{ route('funding-requests.cancel', $funding->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan request ini?');" class="inline">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded-lg hover:bg-red-700 transition text-sm">
                                                            Batal
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                <!-- Empty State -->
                <div class="bg-white rounded-xl shadow-md border border-zinc-200 p-12 text-center">
                    <div class="flex flex-col items-center">
                        <div class="w-24 h-24 rounded-full bg-primary/10 flex items-center justify-center mb-6">
                            <svg class="w-12 h-12 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-1-1.732l-4-2.309a2 2 0 00-1.732 0l-4 2.309A2 2 0 001 11.269V19a2 2 0 002 2h14a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-zinc-900 mb-2">Belum Ada Request Pendanaan</h3>
                        <p class="text-zinc-600 mb-6 max-w-md">Buat request pendanaan pertama Anda untuk UMKM yang sudah terverifikasi</p>
                        @if($businesses->count() > 0)
                            <a href="{{ route('funding-requests.create') }}" class="px-6 py-3 bg-primary text-white rounded-lg hover:bg-primary-600 transition font-medium shadow-md">
                                Buat Request Pendanaan
                            </a>
                        @endif
                    </div>
                </div>
            @endif
        </main>
    </div>
</div>
@endsection

