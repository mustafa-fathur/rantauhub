@extends('components.layouts.user.dashboard', ['title' => $title ?? 'Detail Mentoring'])

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
                <a href="{{ route('mentoring.index') }}" class="px-4 py-2 border border-zinc-300 text-zinc-700 rounded-lg hover:bg-zinc-50 transition font-medium">
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
                            Menunggu Konfirmasi Mentor
                        </span>
                    @elseif($session->status === \App\Enums\MentoringStatus::CONFIRMED)
                        <span class="px-4 py-2 text-sm font-medium rounded-full bg-blue-100 text-blue-800">
                            Terkonfirmasi
                        </span>
                    @elseif($session->status === \App\Enums\MentoringStatus::COMPLETED)
                        <span class="px-4 py-2 text-sm font-medium rounded-full bg-green-100 text-green-800">
                            Selesai
                        </span>
                    @elseif($session->status === \App\Enums\MentoringStatus::CANCELLED)
                        <span class="px-4 py-2 text-sm font-medium rounded-full bg-red-100 text-red-800">
                            Dibatalkan
                        </span>
                    @endif
                </div>

                <!-- Mentor Info -->
                <div class="bg-zinc-50 rounded-lg p-4">
                    <h3 class="font-semibold text-zinc-900 mb-3">Informasi Mentor</h3>
                    <div class="space-y-2 text-sm">
                        <p><span class="font-medium">Nama:</span> {{ $session->mentor->user->name }}</p>
                        <p><span class="font-medium">Email:</span> {{ $session->mentor->user->email }}</p>
                        @if($session->mentor->current_job)
                            <p><span class="font-medium">Pekerjaan:</span> {{ $session->mentor->current_job }}</p>
                        @endif
                        @if($session->mentor->reputation_score > 0)
                            <p><span class="font-medium">Reputasi:</span> ⭐ {{ number_format($session->mentor->reputation_score, 1) }}/5.0</p>
                        @endif
                        @if($session->mentor->skills->count() > 0)
                            <div class="mt-2">
                                <p class="font-medium mb-1">Keahlian:</p>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($session->mentor->skills as $skill)
                                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-primary/10 text-primary">
                                            {{ $skill->skill }}
                                        </span>
                                    @endforeach
                                </div>
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
                                <p class="text-sm font-medium text-zinc-700 mb-1">Catatan:</p>
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
                        </div>
                    </div>
                @endif

                <!-- Rating Form (if completed and not rated yet) -->
                @if($session->status === \App\Enums\MentoringStatus::COMPLETED && !$session->rating)
                    <div class="border-t border-zinc-200 pt-6">
                        <h3 class="font-semibold text-zinc-900 mb-4">Berikan Rating</h3>
                        <form method="POST" action="{{ route('mentoring.rate', $session->id) }}" class="space-y-4">
                            @csrf
                            <div>
                                <label for="rating" class="block text-sm font-medium text-zinc-700 mb-2">
                                    Rating <span class="text-red-500">*</span>
                                </label>
                                <select
                                    name="rating"
                                    id="rating"
                                    required
                                    class="w-full px-4 py-3 rounded-lg border border-zinc-300 focus:ring-2 focus:ring-primary focus:border-primary transition"
                                >
                                    <option value="">Pilih Rating</option>
                                    <option value="1">⭐ 1 - Sangat Tidak Puas</option>
                                    <option value="2">⭐⭐ 2 - Tidak Puas</option>
                                    <option value="3">⭐⭐⭐ 3 - Cukup</option>
                                    <option value="4">⭐⭐⭐⭐ 4 - Puas</option>
                                    <option value="5">⭐⭐⭐⭐⭐ 5 - Sangat Puas</option>
                                </select>
                                @error('rating')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="feedback" class="block text-sm font-medium text-zinc-700 mb-2">
                                    Feedback <span class="text-zinc-500">(Opsional)</span>
                                </label>
                                <textarea
                                    name="feedback"
                                    id="feedback"
                                    rows="3"
                                    placeholder="Bagikan pengalaman Anda dengan mentor ini..."
                                    class="w-full px-4 py-3 rounded-lg border border-zinc-300 focus:ring-2 focus:ring-primary focus:border-primary transition resize-none"
                                >{{ old('feedback') }}</textarea>
                                @error('feedback')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <button type="submit" class="px-6 py-3 bg-primary text-white rounded-lg hover:bg-primary-600 transition font-medium">
                                Submit Rating
                            </button>
                        </form>
                    </div>
                @endif

                <!-- Rating Display (if already rated) -->
                @if($session->rating)
                    <div class="border-t border-zinc-200 pt-6">
                        <h3 class="font-semibold text-zinc-900 mb-3">Rating Anda</h3>
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
                @if(in_array($session->status, [\App\Enums\MentoringStatus::PENDING, \App\Enums\MentoringStatus::CONFIRMED]))
                    <div class="pt-6 border-t border-zinc-200">
                        <form action="{{ route('mentoring.cancel', $session->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan session ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition font-medium">
                                Batalkan Session
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        </main>
    </div>
</div>
@endsection

