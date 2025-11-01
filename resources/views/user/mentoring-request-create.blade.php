@extends('components.layouts.user.dashboard', ['title' => $title ?? 'Request Mentoring'])

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex gap-6">
        <!-- Sidebar Card -->
        <x-user.sidebar :user="$user" />

        <!-- Main Content Area -->
        <main class="flex-1 min-w-0">
            <!-- Page Header -->
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-primary mb-2">Request Mentoring</h1>
                <p class="text-zinc-600">Ajukan request mentoring kepada mentor yang terverifikasi</p>
            </div>

            @if($errors->any())
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                    <ul class="list-disc list-inside text-red-800">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Request Form -->
            <div class="bg-white rounded-xl shadow-md border border-zinc-200 p-6 md:p-8">
                <form method="POST" action="{{ route('mentoring.store') }}" class="space-y-6">
                    @csrf

                    <!-- Information Alert -->
                    <div class="p-4 bg-blue-50 border border-blue-200 rounded-lg">
                        <p class="text-sm text-blue-800">
                            <strong>Informasi:</strong> Request mentoring akan dikirim kepada mentor untuk konfirmasi. Pastikan jadwal yang Anda pilih sudah sesuai dengan kesiapan Anda.
                        </p>
                    </div>

                    <!-- Mentor Selection -->
                    <div>
                        <label for="mentor_id" class="block text-sm font-medium text-zinc-700 mb-2">
                            Pilih Mentor <span class="text-red-500">*</span>
                        </label>
                        <select
                            name="mentor_id"
                            id="mentor_id"
                            required
                            class="w-full px-4 py-3 rounded-lg border border-zinc-300 focus:ring-2 focus:ring-primary focus:border-primary transition"
                        >
                            <option value="">Pilih Mentor</option>
                            @foreach($mentors as $mentor)
                                <option value="{{ $mentor->id }}" {{ old('mentor_id') == $mentor->id ? 'selected' : '' }}>
                                    {{ $mentor->user->name }}
                                    @if($mentor->current_job)
                                        - {{ $mentor->current_job }}
                                    @endif
                                    @if($mentor->reputation_score > 0)
                                        (⭐ {{ number_format($mentor->reputation_score, 1) }})
                                    @endif
                                </option>
                            @endforeach
                        </select>
                        <p class="mt-1 text-xs text-zinc-500">Hanya mentor yang sudah terverifikasi yang tersedia</p>
                        @error('mentor_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Selected Mentor Info -->
                    <div id="mentor-info" class="hidden p-4 bg-zinc-50 rounded-lg border border-zinc-200">
                        <div id="mentor-details"></div>
                    </div>

                    <!-- Topic -->
                    <div>
                        <label for="topic" class="block text-sm font-medium text-zinc-700 mb-2">
                            Topik Mentoring <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            name="topic"
                            id="topic"
                            value="{{ old('topic') }}"
                            required
                            maxlength="255"
                            placeholder="Contoh: Strategi Pemasaran Digital untuk UMKM"
                            class="w-full px-4 py-3 rounded-lg border border-zinc-300 focus:ring-2 focus:ring-primary focus:border-primary transition"
                        >
                        @error('topic')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Scheduled At -->
                    <div>
                        <label for="scheduled_at" class="block text-sm font-medium text-zinc-700 mb-2">
                            Tanggal & Waktu <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="datetime-local"
                            name="scheduled_at"
                            id="scheduled_at"
                            value="{{ old('scheduled_at') }}"
                            required
                            min="{{ now()->addHour()->format('Y-m-d\TH:i') }}"
                            class="w-full px-4 py-3 rounded-lg border border-zinc-300 focus:ring-2 focus:ring-primary focus:border-primary transition"
                        >
                        <p class="mt-1 text-xs text-zinc-500">Pilih waktu minimal 1 jam dari sekarang</p>
                        @error('scheduled_at')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Duration -->
                    <div>
                        <label for="duration_minutes" class="block text-sm font-medium text-zinc-700 mb-2">
                            Durasi (menit) <span class="text-red-500">*</span>
                        </label>
                        <select
                            name="duration_minutes"
                            id="duration_minutes"
                            required
                            class="w-full px-4 py-3 rounded-lg border border-zinc-300 focus:ring-2 focus:ring-primary focus:border-primary transition"
                        >
                            <option value="30" {{ old('duration_minutes') == 30 ? 'selected' : '' }}>30 menit</option>
                            <option value="60" {{ old('duration_minutes') == 60 ? 'selected' : '' }}>1 jam</option>
                            <option value="90" {{ old('duration_minutes') == 90 ? 'selected' : '' }}>1.5 jam</option>
                            <option value="120" {{ old('duration_minutes') == 120 ? 'selected' : '' }}>2 jam</option>
                            <option value="180" {{ old('duration_minutes') == 180 ? 'selected' : '' }}>3 jam</option>
                            <option value="240" {{ old('duration_minutes') == 240 ? 'selected' : '' }}>4 jam</option>
                        </select>
                        <p class="mt-1 text-xs text-zinc-500">Minimum: 30 menit | Maksimum: 4 jam</p>
                        @error('duration_minutes')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Notes -->
                    <div>
                        <label for="notes" class="block text-sm font-medium text-zinc-700 mb-2">
                            Catatan/Deskripsi <span class="text-zinc-500">(Opsional)</span>
                        </label>
                        <textarea
                            name="notes"
                            id="notes"
                            rows="4"
                            placeholder="Jelaskan detail topik yang ingin didiskusikan, pertanyaan spesifik, atau hal-hal yang perlu diketahui mentor..."
                            class="w-full px-4 py-3 rounded-lg border border-zinc-300 focus:ring-2 focus:ring-primary focus:border-primary transition resize-none"
                        >{{ old('notes') }}</textarea>
                        <p class="mt-1 text-xs text-zinc-500">Maksimal 1000 karakter</p>
                        @error('notes')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="flex items-center justify-end space-x-4 pt-6 border-t border-zinc-200">
                        <a href="{{ route('mentoring.index') }}" class="px-6 py-3 border border-zinc-300 text-zinc-700 rounded-lg hover:bg-zinc-50 transition font-medium">
                            Batal
                        </a>
                        <button type="submit" class="px-6 py-3 bg-primary text-white rounded-lg hover:bg-primary-600 transition font-medium">
                            Submit Request
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</div>

<script>
    // Show mentor info when selected
    document.getElementById('mentor_id')?.addEventListener('change', function() {
        const mentorId = this.value;
        const mentorInfo = document.getElementById('mentor-info');
        const mentorDetails = document.getElementById('mentor-details');
        
        if (mentorId) {
            // Fetch mentor details via AJAX or show from data
            const selectedOption = this.options[this.selectedIndex];
            const mentorText = selectedOption.text;
            
            @foreach($mentors as $mentor)
                if (mentorId == {{ $mentor->id }}) {
                    mentorDetails.innerHTML = `
                        <div class="space-y-2">
                            <h4 class="font-semibold text-zinc-900">{{ $mentor->user->name }}</h4>
                            @if($mentor->current_job)
                                <p class="text-sm text-zinc-600">{{ $mentor->current_job }}</p>
                            @endif
                            @if($mentor->reputation_score > 0)
                                <p class="text-sm text-zinc-600">⭐ Reputasi: {{ number_format($mentor->reputation_score, 1) }}/5.0</p>
                            @endif
                            @if($mentor->about)
                                <p class="text-sm text-zinc-600 mt-2">{{ \Illuminate\Support\Str::limit($mentor->about, 150) }}</p>
                            @endif
                            @if($mentor->skills->count() > 0)
                                <div class="flex flex-wrap gap-2 mt-2">
                                    @foreach($mentor->skills as $skill)
                                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-primary/10 text-primary">
                                            {{ $skill->skill }}
                                        </span>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    `;
                    mentorInfo.classList.remove('hidden');
                }
            @endforeach
        } else {
            mentorInfo.classList.add('hidden');
        }
    });
</script>
@endsection

