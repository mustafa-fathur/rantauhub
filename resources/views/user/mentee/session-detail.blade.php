@extends('components.layouts.user.dashboard', ['title' => $title ?? 'Detail Mentoring Session'])

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
                    <h1 class="text-3xl font-bold text-primary mb-2">Detail Mentoring Session</h1>
                    <p class="text-zinc-600">Informasi lengkap tentang session mentoring</p>
                </div>
                <a href="{{ route('mentee.index') }}" class="px-4 py-2 border border-zinc-300 text-zinc-700 rounded-lg hover:bg-zinc-50 transition font-medium">
                    Kembali
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

            <!-- Detail Card -->
            <div class="bg-white rounded-xl shadow-md border border-zinc-200 p-6 md:p-8 space-y-6">
                <!-- Status Badge -->
                <div class="flex items-center justify-between pb-6 border-b border-zinc-200">
                    <h2 class="text-xl font-bold text-zinc-900">Status Session</h2>
                    @if($session->status === \App\Enums\MentoringStatus::PENDING)
                        <span class="px-4 py-2 text-sm font-medium rounded-full bg-yellow-100 text-yellow-800">
                            Pending
                        </span>
                    @elseif($session->status === \App\Enums\MentoringStatus::CONFIRMED)
                        <span class="px-4 py-2 text-sm font-medium rounded-full bg-blue-100 text-blue-800">
                            Confirmed
                        </span>
                    @elseif($session->status === \App\Enums\MentoringStatus::COMPLETED)
                        <span class="px-4 py-2 text-sm font-medium rounded-full bg-green-100 text-green-800">
                            Completed
                        </span>
                    @elseif($session->status === \App\Enums\MentoringStatus::CANCELLED)
                        <span class="px-4 py-2 text-sm font-medium rounded-full bg-red-100 text-red-800">
                            Cancelled
                        </span>
                    @endif
                </div>

                <!-- UMKM Owner Info -->
                <div class="bg-zinc-50 rounded-lg p-4">
                    <h3 class="font-semibold text-zinc-900 mb-3">Informasi UMKM Owner</h3>
                    <div class="space-y-2 text-sm">
                        <p><span class="font-medium">Nama:</span> {{ $session->umkmOwner->user->name }}</p>
                        <p><span class="font-medium">Email:</span> {{ $session->umkmOwner->user->email }}</p>
                        @if($session->umkmOwner->user->phone)
                            <p><span class="font-medium">Telepon:</span> {{ $session->umkmOwner->user->phone }}</p>
                        @endif
                        @if($session->umkmOwner->businesses->count() > 0)
                            <div class="mt-2">
                                <p class="font-medium mb-1">UMKM:</p>
                                @foreach($session->umkmOwner->businesses as $business)
                                    <p class="text-zinc-600">• {{ $business->name }} - {{ $business->location }}</p>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Session Details -->
                <div>
                    <h3 class="font-semibold text-zinc-900 mb-3">Detail Session</h3>
                    <div class="bg-primary/5 rounded-lg p-4 border border-primary/20 space-y-2">
                        <div class="flex justify-between">
                            <span class="text-zinc-600">Topik:</span>
                            <span class="font-semibold text-zinc-900">{{ $session->topic }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-zinc-600">Jadwal:</span>
                            <span class="font-semibold text-zinc-900">{{ $session->scheduled_at->format('d M Y H:i') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-zinc-600">Durasi:</span>
                            <span class="font-semibold text-zinc-900">{{ $session->duration_minutes }} menit</span>
                        </div>
                        @if($session->notes)
                            <div class="pt-2 border-t border-primary/20">
                                <p class="text-sm font-medium text-zinc-700 mb-1">Catatan dari UMKM Owner:</p>
                                <p class="text-zinc-600 whitespace-pre-wrap">{{ $session->notes }}</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Hours Log (if completed) -->
                @if($session->status === \App\Enums\MentoringStatus::COMPLETED && $session->hoursLog)
                    <div>
                        <h3 class="font-semibold text-zinc-900 mb-3">Hours Log</h3>
                        <div class="bg-secondary/5 rounded-lg p-4 border border-secondary/20 space-y-2 text-sm">
                            <div class="flex justify-between">
                                <span class="text-zinc-600">Hours Contributed:</span>
                                <span class="font-semibold text-zinc-900">{{ $session->hoursLog->hours_contributed }} jam</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-zinc-600">Earned Points:</span>
                                <span class="font-semibold text-secondary">{{ $session->hoursLog->earned_points }} points</span>
                            </div>
                            @if($session->hoursLog->star)
                                <div class="flex justify-between">
                                    <span class="text-zinc-600">Rating:</span>
                                    <span class="font-semibold text-zinc-900">⭐ {{ $session->hoursLog->star }}/5</span>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

                <!-- Rating (if exists) -->
                @if($session->rating)
                    <div>
                        <h3 class="font-semibold text-zinc-900 mb-3">Rating dari UMKM Owner</h3>
                        <div class="bg-green-50 rounded-lg p-4 border border-green-200">
                            <div class="flex items-center space-x-2 mb-2">
                                <span class="text-2xl">⭐</span>
                                <span class="text-xl font-bold text-zinc-900">{{ $session->rating }}/5</span>
                            </div>
                            @if($session->feedback)
                                <p class="text-sm text-zinc-700 whitespace-pre-wrap">{{ $session->feedback }}</p>
                            @endif
                        </div>
                    </div>
                @endif

                <!-- Actions -->
                @if($session->status === \App\Enums\MentoringStatus::PENDING)
                    <div class="pt-6 border-t border-zinc-200">
                        <div class="flex items-center space-x-3">
                            <form action="{{ route('mentee.approve', $session->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition font-medium">
                                    Setujui Request
                                </button>
                            </form>
                            <button 
                                onclick="showRejectModal({{ $session->id }})"
                                class="px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition font-medium"
                            >
                                Tolak Request
                            </button>
                        </div>
                    </div>
                @elseif($session->status === \App\Enums\MentoringStatus::CONFIRMED && !$session->hoursLog)
                    <div class="pt-6 border-t border-zinc-200">
                        <h3 class="font-semibold text-zinc-900 mb-4">Tandai sebagai Selesai</h3>
                        <form method="POST" action="{{ route('mentee.complete', $session->id) }}" class="space-y-4">
                            @csrf
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label for="hours_contributed" class="block text-sm font-medium text-zinc-700 mb-2">
                                        Hours Contributed <span class="text-red-500">*</span>
                                    </label>
                                    <input
                                        type="number"
                                        name="hours_contributed"
                                        id="hours_contributed"
                                        value="{{ old('hours_contributed', round($session->duration_minutes / 60, 1)) }}"
                                        required
                                        min="1"
                                        max="8"
                                        step="0.5"
                                        class="w-full px-4 py-3 rounded-lg border border-zinc-300 focus:ring-2 focus:ring-primary focus:border-primary transition"
                                    >
                                    @error('hours_contributed')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="earned_points" class="block text-sm font-medium text-zinc-700 mb-2">
                                        Earned Points <span class="text-red-500">*</span>
                                    </label>
                                    <input
                                        type="number"
                                        name="earned_points"
                                        id="earned_points"
                                        value="{{ old('earned_points', round($session->duration_minutes / 60) * 10) }}"
                                        required
                                        min="1"
                                        class="w-full px-4 py-3 rounded-lg border border-zinc-300 focus:ring-2 focus:ring-primary focus:border-primary transition"
                                    >
                                    @error('earned_points')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="px-6 py-3 bg-primary text-white rounded-lg hover:bg-primary-600 transition font-medium">
                                Mark as Completed
                            </button>
                        </form>
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

