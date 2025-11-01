@extends('components.layouts.user.dashboard', ['title' => $title ?? 'Request Pendanaan Tersedia'])

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex gap-6">
        <!-- Sidebar Card -->
        <x-user.sidebar :user="$user" />

        <!-- Main Content Area -->
        <main class="flex-1 min-w-0">
            <!-- Page Header -->
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-primary mb-2">Request Pendanaan Tersedia</h1>
                <p class="text-zinc-600">Lihat dan berikan pendanaan untuk UMKM yang membutuhkan</p>
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

            <!-- Statistics -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div class="bg-white rounded-lg p-4 shadow-sm border border-zinc-200">
                    <h3 class="text-sm font-medium text-zinc-600 mb-1">Request Terbuka</h3>
                    <p class="text-2xl font-bold text-zinc-900">{{ $openRequests->count() }}</p>
                </div>
                <div class="bg-white rounded-lg p-4 shadow-sm border border-zinc-200">
                    <h3 class="text-sm font-medium text-zinc-600 mb-1">Saya Terima</h3>
                    <p class="text-2xl font-bold text-primary">{{ $myFundings->count() }}</p>
                </div>
                <div class="bg-white rounded-lg p-4 shadow-sm border border-zinc-200">
                    <h3 class="text-sm font-medium text-zinc-600 mb-1">Total Nilai</h3>
                    <p class="text-2xl font-bold text-secondary">Rp {{ number_format($myFundings->where('status', \App\Enums\FundingStatus::APPROVED)->sum('amount'), 0, ',', '.') }}</p>
                </div>
            </div>

            <!-- Open Requests -->
            <div class="mb-8">
                <h2 class="text-xl font-bold text-primary mb-4">Request Pendanaan Terbuka</h2>
                @if($openRequests->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($openRequests as $funding)
                            <div class="bg-white rounded-xl shadow-md border border-zinc-200 overflow-hidden hover:shadow-lg transition">
                                @if($funding->business->logo)
                                    <img src="{{ asset('storage/' . $funding->business->logo) }}" alt="{{ $funding->business->name }}" class="w-full h-48 object-cover">
                                @else
                                    <div class="w-full h-48 bg-zinc-100 flex items-center justify-center text-zinc-400">
                                        <svg class="w-20 h-20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                        </svg>
                                    </div>
                                @endif
                                <div class="p-6">
                                    <h3 class="text-lg font-bold text-zinc-900 mb-2">{{ $funding->business->name }}</h3>
                                    <p class="text-sm text-zinc-600 mb-3">{{ $funding->business->location }}</p>
                                    <div class="mb-3">
                                        <p class="text-xs text-zinc-500 mb-1">Dibutuhkan</p>
                                        <p class="text-xl font-bold text-primary">Rp {{ number_format($funding->amount, 0, ',', '.') }}</p>
                                    </div>
                                    @if($funding->description)
                                        <p class="text-sm text-zinc-700 line-clamp-2 mb-4">{{ $funding->description }}</p>
                                    @endif
                                    <a href="{{ route('funder.funding-requests.show', $funding->id) }}" class="block w-full px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-600 transition text-center font-medium">
                                        Lihat Detail
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="bg-white rounded-xl shadow-md border border-zinc-200 p-12 text-center">
                        <div class="flex flex-col items-center">
                            <div class="w-24 h-24 rounded-full bg-zinc-100 flex items-center justify-center mb-6">
                                <svg class="w-12 h-12 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-1-1.732l-4-2.309a2 2 0 00-1.732 0l-4 2.309A2 2 0 001 11.269V19a2 2 0 002 2h14a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-zinc-900 mb-2">Tidak Ada Request Terbuka</h3>
                            <p class="text-zinc-600">Saat ini tidak ada request pendanaan yang tersedia</p>
                        </div>
                    </div>
                @endif
            </div>

            <!-- My Fundings -->
            @if($myFundings->count() > 0)
                <div>
                    <h2 class="text-xl font-bold text-primary mb-4">Pendanaan Saya</h2>
                    <div class="bg-white rounded-xl shadow-md border border-zinc-200 overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="bg-zinc-50 border-b border-zinc-200">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-zinc-700 uppercase tracking-wider">UMKM</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-zinc-700 uppercase tracking-wider">Jumlah</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-zinc-700 uppercase tracking-wider">Status</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-zinc-700 uppercase tracking-wider">Tanggal</th>
                                        <th class="px-6 py-3 text-right text-xs font-medium text-zinc-700 uppercase tracking-wider">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-zinc-200">
                                    @foreach($myFundings as $funding)
                                        <tr class="hover:bg-zinc-50 transition">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-semibold text-zinc-900">{{ $funding->business->name }}</div>
                                                <div class="text-xs text-zinc-500">{{ $funding->business->location }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-semibold text-zinc-900">Rp {{ number_format($funding->amount, 0, ',', '.') }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if($funding->status === \App\Enums\FundingStatus::OPEN)
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
                                                    <span class="px-3 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">
                                                        Dicairkan
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-600">
                                                {{ $funding->created_at->format('d M Y') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <a href="#" class="text-primary hover:text-primary-600">Detail</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
        </main>
    </div>
</div>
@endsection

