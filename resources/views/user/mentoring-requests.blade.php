@extends('components.layouts.user.dashboard', ['title' => $title ?? 'Mentoring Saya'])

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
                    <h1 class="text-3xl font-bold text-primary mb-2">Mentoring Saya</h1>
                    <p class="text-zinc-600">Kelola request dan riwayat mentoring Anda</p>
                </div>
                <a href="{{ route('mentoring.create') }}" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-600 transition font-medium">
                    + Request Mentoring
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

            <!-- Statistics -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                <div class="bg-white rounded-lg p-4 shadow-sm border border-zinc-200">
                    <h3 class="text-sm font-medium text-zinc-600 mb-1">Total Session</h3>
                    <p class="text-2xl font-bold text-zinc-900">{{ $sessions->count() }}</p>
                </div>
                <div class="bg-white rounded-lg p-4 shadow-sm border border-zinc-200">
                    <h3 class="text-sm font-medium text-zinc-600 mb-1">Pending</h3>
                    <p class="text-2xl font-bold text-yellow-600">{{ $sessions->where('status', \App\Enums\MentoringStatus::PENDING)->count() }}</p>
                </div>
                <div class="bg-white rounded-lg p-4 shadow-sm border border-zinc-200">
                    <h3 class="text-sm font-medium text-zinc-600 mb-1">Confirmed</h3>
                    <p class="text-2xl font-bold text-blue-600">{{ $sessions->where('status', \App\Enums\MentoringStatus::CONFIRMED)->count() }}</p>
                </div>
                <div class="bg-white rounded-lg p-4 shadow-sm border border-zinc-200">
                    <h3 class="text-sm font-medium text-zinc-600 mb-1">Completed</h3>
                    <p class="text-2xl font-bold text-green-600">{{ $sessions->where('status', \App\Enums\MentoringStatus::COMPLETED)->count() }}</p>
                </div>
            </div>

            <!-- Sessions List -->
            @if($sessions->count() > 0)
                <div class="bg-white rounded-xl shadow-md border border-zinc-200 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-zinc-50 border-b border-zinc-200">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-zinc-700 uppercase tracking-wider">Mentor</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-zinc-700 uppercase tracking-wider">Topik</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-zinc-700 uppercase tracking-wider">Jadwal</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-zinc-700 uppercase tracking-wider">Durasi</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-zinc-700 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-zinc-700 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-zinc-200">
                                @foreach($sessions as $session)
                                    <tr class="hover:bg-zinc-50 transition">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-semibold text-zinc-900">{{ $session->mentor->user->name }}</div>
                                            <div class="text-xs text-zinc-500">{{ $session->mentor->current_job ?? 'Mentor' }}</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-zinc-900">{{ $session->topic }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-zinc-900">{{ $session->scheduled_at->format('d M Y') }}</div>
                                            <div class="text-xs text-zinc-500">{{ $session->scheduled_at->format('H:i') }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-zinc-900">{{ $session->duration_minutes }} menit</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($session->status === \App\Enums\MentoringStatus::PENDING)
                                                <span class="px-3 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800">
                                                    Pending
                                                </span>
                                            @elseif($session->status === \App\Enums\MentoringStatus::CONFIRMED)
                                                <span class="px-3 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">
                                                    Confirmed
                                                </span>
                                            @elseif($session->status === \App\Enums\MentoringStatus::COMPLETED)
                                                <span class="px-3 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">
                                                    Completed
                                                </span>
                                            @elseif($session->status === \App\Enums\MentoringStatus::CANCELLED)
                                                <span class="px-3 py-1 text-xs font-medium rounded-full bg-red-100 text-red-800">
                                                    Cancelled
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <div class="flex items-center justify-end space-x-2">
                                                <a href="{{ route('mentoring.show', $session->id) }}" class="px-3 py-1 bg-primary text-white rounded-lg hover:bg-primary-600 transition text-sm">
                                                    Detail
                                                </a>
                                                @if(in_array($session->status, [\App\Enums\MentoringStatus::PENDING, \App\Enums\MentoringStatus::CONFIRMED]))
                                                    <form action="{{ route('mentoring.cancel', $session->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan session ini?');" class="inline">
                                                        @csrf
                                                        @method('DELETE')
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
                <div class="bg-white rounded-xl shadow-md border border-zinc-200 p-12 text-center">
                    <div class="flex flex-col items-center">
                        <div class="w-24 h-24 rounded-full bg-zinc-100 flex items-center justify-center mb-6">
                            <svg class="w-12 h-12 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-zinc-900 mb-2">Belum Ada Mentoring Session</h3>
                        <p class="text-zinc-600 mb-6">Mulai request mentoring untuk mendapatkan bimbingan dari mentor</p>
                        <a href="{{ route('mentoring.create') }}" class="px-6 py-3 bg-primary text-white rounded-lg hover:bg-primary-600 transition font-medium">
                            Request Mentoring
                        </a>
                    </div>
                </div>
            @endif
        </main>
    </div>
</div>
@endsection

