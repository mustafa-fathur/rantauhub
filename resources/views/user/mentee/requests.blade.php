@extends('components.layouts.user.dashboard', ['title' => $title ?? 'Mentee & Mentoring'])

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex gap-6">
        <!-- Sidebar Card -->
        <x-user.sidebar :user="$user" />

        <!-- Main Content Area -->
        <main class="flex-1 min-w-0">
            <!-- Page Header -->
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-primary mb-2">Mentee & Mentoring</h1>
                <p class="text-zinc-600">Kelola request dan riwayat mentoring dari UMKM Owner</p>
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

            @if(session('info'))
                <div class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded-lg text-blue-800">
                    {{ session('info') }}
                </div>
            @endif

            <!-- Statistics -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                <div class="bg-white rounded-lg p-4 shadow-sm border border-zinc-200">
                    <h3 class="text-sm font-medium text-zinc-600 mb-1">Total Session</h3>
                    <p class="text-2xl font-bold text-zinc-900">{{ $totalSessions }}</p>
                </div>
                <div class="bg-white rounded-lg p-4 shadow-sm border border-zinc-200">
                    <h3 class="text-sm font-medium text-zinc-600 mb-1">Pending</h3>
                    <p class="text-2xl font-bold text-yellow-600">{{ $pendingRequests->count() }}</p>
                </div>
                <div class="bg-white rounded-lg p-4 shadow-sm border border-zinc-200">
                    <h3 class="text-sm font-medium text-zinc-600 mb-1">Completed</h3>
                    <p class="text-2xl font-bold text-green-600">{{ $completedSessions }}</p>
                </div>
                <div class="bg-white rounded-lg p-4 shadow-sm border border-zinc-200">
                    <h3 class="text-sm font-medium text-zinc-600 mb-1">Total Hours</h3>
                    <p class="text-2xl font-bold text-primary">{{ $totalHours }} jam</p>
                </div>
            </div>

            <!-- Pending Requests -->
            @if($pendingRequests->count() > 0)
                <div class="mb-8">
                    <h2 class="text-xl font-bold text-primary mb-4">Request Menunggu Verifikasi</h2>
                    <div class="space-y-4">
                        @foreach($pendingRequests as $request)
                            <div class="bg-white rounded-xl shadow-md border border-zinc-200 p-6 hover:shadow-lg transition">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1">
                                        <div class="flex items-center space-x-3 mb-4">
                                            <div class="w-12 h-12 rounded-full bg-primary text-white flex items-center justify-center">
                                                <span class="text-lg font-semibold">{{ substr($request->umkmOwner->user->name, 0, 1) }}</span>
                                            </div>
                                            <div>
                                                <h3 class="text-lg font-bold text-zinc-900">{{ $request->umkmOwner->user->name }}</h3>
                                                <p class="text-sm text-zinc-600">{{ $request->umkmOwner->user->email }}</p>
                                            </div>
                                        </div>
                                        <div class="grid grid-cols-2 gap-4 mb-4">
                                            <div>
                                                <p class="text-xs text-zinc-500 mb-1">Topik</p>
                                                <p class="text-sm font-semibold text-zinc-900">{{ $request->topic }}</p>
                                            </div>
                                            <div>
                                                <p class="text-xs text-zinc-500 mb-1">Jadwal</p>
                                                <p class="text-sm font-semibold text-zinc-900">{{ $request->scheduled_at->format('d M Y H:i') }}</p>
                                            </div>
                                            <div>
                                                <p class="text-xs text-zinc-500 mb-1">Durasi</p>
                                                <p class="text-sm font-semibold text-zinc-900">{{ $request->duration_minutes }} menit</p>
                                            </div>
                                            <div>
                                                <p class="text-xs text-zinc-500 mb-1">UMKM</p>
                                                <p class="text-sm font-semibold text-zinc-900">
                                                    {{ $request->umkmOwner->businesses->first()->name ?? 'N/A' }}
                                                </p>
                                            </div>
                                        </div>
                                        @if($request->notes)
                                            <div class="mt-4 pt-4 border-t border-zinc-200">
                                                <p class="text-xs text-zinc-500 mb-1">Catatan</p>
                                                <p class="text-sm text-zinc-700 whitespace-pre-wrap">{{ $request->notes }}</p>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="ml-6 flex flex-col space-y-2">
                                        <form action="{{ route('mentee.approve', $request->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="w-full px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition text-sm whitespace-nowrap">
                                                Setujui
                                            </button>
                                        </form>
                                        <button 
                                            onclick="showRejectModal({{ $request->id }})"
                                            class="w-full px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition text-sm whitespace-nowrap"
                                        >
                                            Tolak
                                        </button>
                                        <a href="{{ route('mentee.show', $request->id) }}" class="w-full px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-600 transition text-sm text-center whitespace-nowrap">
                                            Detail
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- All Sessions History -->
            <div>
                <h2 class="text-xl font-bold text-primary mb-4">Riwayat Mentoring</h2>
                @if($allSessions->count() > 0)
                    <div class="bg-white rounded-xl shadow-md border border-zinc-200 overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="bg-zinc-50 border-b border-zinc-200">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-zinc-700 uppercase tracking-wider">UMKM Owner</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-zinc-700 uppercase tracking-wider">Topik</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-zinc-700 uppercase tracking-wider">Jadwal</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-zinc-700 uppercase tracking-wider">Status</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-zinc-700 uppercase tracking-wider">Rating</th>
                                        <th class="px-6 py-3 text-right text-xs font-medium text-zinc-700 uppercase tracking-wider">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-zinc-200">
                                    @foreach($allSessions as $session)
                                        <tr class="hover:bg-zinc-50 transition">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-semibold text-zinc-900">{{ $session->umkmOwner->user->name }}</div>
                                                <div class="text-xs text-zinc-500">{{ $session->umkmOwner->businesses->first()->name ?? 'N/A' }}</div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="text-sm text-zinc-900">{{ $session->topic }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-zinc-900">{{ $session->scheduled_at->format('d M Y') }}</div>
                                                <div class="text-xs text-zinc-500">{{ $session->scheduled_at->format('H:i') }}</div>
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
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if($session->rating)
                                                    <div class="flex items-center space-x-1">
                                                        <span>⭐</span>
                                                        <span class="text-sm font-semibold text-zinc-900">{{ $session->rating }}/5</span>
                                                    </div>
                                                @else
                                                    <span class="text-sm text-zinc-400">-</span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <a href="{{ route('mentee.show', $session->id) }}" class="px-3 py-1 bg-primary text-white rounded-lg hover:bg-primary-600 transition text-sm">
                                                    Detail
                                                </a>
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
                            <p class="text-zinc-600">Belum ada request mentoring dari UMKM Owner</p>
                        </div>
                    </div>
                @endif
            </div>
        </main>
    </div>
</div>

<!-- Reject Modal -->
<div id="rejectModal" class="hidden fixed inset-0 z-50 overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="fixed inset-0 bg-black/50" onclick="closeRejectModal()"></div>
        <div class="relative bg-white rounded-xl shadow-xl max-w-md w-full p-6">
            <h3 class="text-xl font-bold text-zinc-900 mb-4">Tolak Request Mentoring</h3>
            <form id="rejectForm" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="reject_notes" class="block text-sm font-medium text-zinc-700 mb-2">
                        Alasan (Opsional)
                    </label>
                    <textarea
                        name="notes"
                        id="reject_notes"
                        rows="3"
                        class="w-full px-4 py-3 rounded-lg border border-zinc-300 focus:ring-2 focus:ring-primary focus:border-primary transition resize-none"
                    ></textarea>
                </div>
                <div class="flex items-center justify-end space-x-3">
                    <button type="button" onclick="closeRejectModal()" class="px-4 py-2 border border-zinc-300 text-zinc-700 rounded-lg hover:bg-zinc-50 transition">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                        Tolak
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function showRejectModal(sessionId) {
        const modal = document.getElementById('rejectModal');
        const form = document.getElementById('rejectForm');
        form.action = `/mentee/sessions/${sessionId}/reject`;
        modal.classList.remove('hidden');
    }

    function closeRejectModal() {
        const modal = document.getElementById('rejectModal');
        modal.classList.add('hidden');
    }
</script>
@endsection

