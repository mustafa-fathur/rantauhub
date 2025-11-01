@extends('components.layouts.user.dashboard', ['title' => $title ?? 'Daftar sebagai Mentor'])

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex gap-6">
        <!-- Sidebar Card -->
        <x-user.sidebar :user="$user" />

        <!-- Main Content Area -->
        <main class="flex-1 min-w-0">
            <!-- Page Header -->
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-primary mb-2">Daftar sebagai Mentor</h1>
                <p class="text-zinc-600">Lengkapi informasi Anda untuk menjadi mentor bagi UMKM lokal</p>
            </div>

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

            @if($errors->any())
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                    <ul class="list-disc list-inside text-red-800">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Registration Form -->
            <div class="bg-white rounded-xl shadow-md border border-zinc-200 p-6 md:p-8">
                <form method="POST" action="{{ route('register.mentor.store') }}" class="space-y-6" id="mentor-form">
                    @csrf

                    <!-- Information Alert -->
                    <div class="p-4 bg-blue-50 border border-blue-200 rounded-lg">
                        <p class="text-sm text-blue-800">
                            <strong>Informasi:</strong> Setelah mendaftar sebagai Mentor, akun Anda akan menunggu verifikasi dari admin sebelum dapat aktif sebagai mentor.
                        </p>
                    </div>

                    <!-- Current Job -->
                    <div>
                        <label for="current_job" class="block text-sm font-medium text-zinc-700 mb-2">
                            Pekerjaan Saat Ini <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            name="current_job"
                            id="current_job"
                            value="{{ old('current_job') }}"
                            required
                            placeholder="Contoh: Dosen Kewirausahaan, Konsultan Pemasaran, dll"
                            class="w-full px-4 py-3 rounded-lg border border-zinc-300 focus:ring-2 focus:ring-primary focus:border-primary transition"
                        >
                        @error('current_job')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Experience -->
                    <div>
                        <label for="experience" class="block text-sm font-medium text-zinc-700 mb-2">
                            Pengalaman <span class="text-red-500">*</span>
                        </label>
                        <textarea
                            name="experience"
                            id="experience"
                            rows="5"
                            required
                            placeholder="Ceritakan pengalaman Anda dalam bidang kewirausahaan, bisnis, atau bidang terkait (minimal 50 karakter)"
                            class="w-full px-4 py-3 rounded-lg border border-zinc-300 focus:ring-2 focus:ring-primary focus:border-primary transition resize-none"
                        >{{ old('experience') }}</textarea>
                        <p class="mt-1 text-xs text-zinc-500">Maksimal 2000 karakter</p>
                        @error('experience')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- About -->
                    <div>
                        <label for="about" class="block text-sm font-medium text-zinc-700 mb-2">
                            Tentang Saya <span class="text-zinc-500">(Opsional)</span>
                        </label>
                        <textarea
                            name="about"
                            id="about"
                            rows="4"
                            placeholder="Ceritakan tentang diri Anda, keahlian khusus, atau motivasi menjadi mentor"
                            class="w-full px-4 py-3 rounded-lg border border-zinc-300 focus:ring-2 focus:ring-primary focus:border-primary transition resize-none"
                        >{{ old('about') }}</textarea>
                        <p class="mt-1 text-xs text-zinc-500">Maksimal 1000 karakter</p>
                        @error('about')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Skills -->
                    <div>
                        <label for="skills" class="block text-sm font-medium text-zinc-700 mb-2">
                            Keahlian/Skills <span class="text-red-500">*</span>
                        </label>
                        <p class="text-xs text-zinc-500 mb-3">Masukkan minimal 1 dan maksimal 10 keahlian (contoh: Pemasaran Digital, Manajemen Keuangan, Branding, dll)</p>
                        
                        <div id="skills-container" class="space-y-3">
                            <div class="flex items-center space-x-2 skill-input">
                                <input
                                    type="text"
                                    name="skills[]"
                                    value="{{ old('skills.0') }}"
                                    required
                                    placeholder="Contoh: Pemasaran Digital"
                                    class="flex-1 px-4 py-3 rounded-lg border border-zinc-300 focus:ring-2 focus:ring-primary focus:border-primary transition"
                                >
                                <button type="button" onclick="addSkill()" class="px-4 py-3 bg-secondary text-white rounded-lg hover:bg-secondary-600 transition font-medium">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        
                        @if(old('skills'))
                            @foreach(old('skills') as $index => $skill)
                                @if($index > 0)
                                    <div class="flex items-center space-x-2 skill-input mt-3">
                                        <input
                                            type="text"
                                            name="skills[]"
                                            value="{{ $skill }}"
                                            placeholder="Keahlian {{ $index + 1 }}"
                                            class="flex-1 px-4 py-3 rounded-lg border border-zinc-300 focus:ring-2 focus:ring-primary focus:border-primary transition"
                                        >
                                        <button type="button" onclick="removeSkill(this)" class="px-4 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition font-medium">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        </button>
                                    </div>
                                @endif
                            @endforeach
                        @endif
                        
                        @error('skills')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        @error('skills.*')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="flex items-center justify-end space-x-4 pt-6 border-t border-zinc-200">
                        <a href="{{ route('dashboard') }}" class="px-6 py-3 border border-zinc-300 text-zinc-700 rounded-lg hover:bg-zinc-50 transition font-medium">
                            Batal
                        </a>
                        <button type="submit" class="px-6 py-3 bg-primary text-white rounded-lg hover:bg-primary-600 transition font-medium">
                            Daftar sebagai Mentor
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</div>

<script>
    let skillCount = document.querySelectorAll('.skill-input').length;

    function addSkill() {
        if (skillCount >= 10) {
            alert('Maksimal 10 keahlian');
            return;
        }

        const container = document.getElementById('skills-container');
        const newSkill = document.createElement('div');
        newSkill.className = 'flex items-center space-x-2 skill-input mt-3';
        newSkill.innerHTML = `
            <input
                type="text"
                name="skills[]"
                required
                placeholder="Keahlian ${skillCount + 1}"
                class="flex-1 px-4 py-3 rounded-lg border border-zinc-300 focus:ring-2 focus:ring-primary focus:border-primary transition"
            >
            <button type="button" onclick="removeSkill(this)" class="px-4 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition font-medium">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        `;
        container.appendChild(newSkill);
        skillCount++;
        
        // Update add button visibility
        updateAddButton();
    }

    function removeSkill(button) {
        if (skillCount <= 1) {
            alert('Minimal 1 keahlian diperlukan');
            return;
        }

        button.closest('.skill-input').remove();
        skillCount--;
        updateAddButton();
    }

    function updateAddButton() {
        const addButtons = document.querySelectorAll('button[onclick="addSkill()"]');
        addButtons.forEach(btn => {
            if (skillCount >= 10) {
                btn.disabled = true;
                btn.classList.add('opacity-50', 'cursor-not-allowed');
            } else {
                btn.disabled = false;
                btn.classList.remove('opacity-50', 'cursor-not-allowed');
            }
        });
    }

    // Initialize
    document.addEventListener('DOMContentLoaded', function() {
        updateAddButton();
        
        // Validate form before submit
        document.getElementById('mentor-form').addEventListener('submit', function(e) {
            const skillInputs = document.querySelectorAll('input[name="skills[]"]');
            const filledSkills = Array.from(skillInputs).filter(input => input.value.trim() !== '');
            
            if (filledSkills.length === 0) {
                e.preventDefault();
                alert('Minimal 1 keahlian harus diisi');
                return false;
            }
        });
    });
</script>
@endsection

