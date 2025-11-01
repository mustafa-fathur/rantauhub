<x-layouts.main>
    <div class="min-h-screen bg-white py-12">
        <div class="container mx-auto px-4 max-w-7xl">
            <!-- Back Button -->
            <a href="{{ route('mentor') }}" class="inline-flex items-center text-primary font-medium mb-6 hover:text-primary-700 transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Kembali ke Direktori Mentor
            </a>

            <!-- Mentor Profile Header -->
            <div class="bg-white rounded-2xl shadow-lg border border-zinc-200 p-8 mb-8">
                <div class="flex flex-col md:flex-row items-start md:items-center space-y-6 md:space-y-0 md:space-x-6">
                    <!-- Profile Photo -->
                    <div class="flex-shrink-0">
                        @if($mentor->user->profile_photo)
                            <img src="{{ asset('storage/' . $mentor->user->profile_photo) }}" alt="{{ $mentor->user->name }}" class="w-32 h-32 rounded-full object-cover ring-4 ring-white shadow-xl">
                        @else
                            <div class="w-32 h-32 rounded-full bg-primary text-white flex items-center justify-center font-bold text-4xl ring-4 ring-white shadow-xl">
                                {{ substr($mentor->user->name, 0, 1) }}
                            </div>
                        @endif
                    </div>

                    <!-- Profile Info -->
                    <div class="flex-1">
                        <h1 class="text-3xl font-bold text-primary mb-2">{{ $mentor->user->name }}</h1>
                        @if($mentor->current_job)
                            <p class="text-lg text-zinc-600 mb-2">{{ $mentor->current_job }}</p>
                        @endif
                        @if($mentor->stats['reputation_score'] > 0)
                            <div class="flex items-center space-x-2 mb-4">
                                <svg class="w-6 h-6 text-secondary" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                                <span class="text-xl font-bold text-primary">{{ number_format($mentor->stats['reputation_score'], 1) }}/5.0</span>
                                <span class="text-sm text-zinc-600">({{ $completedSessions }} sessions)</span>
                            </div>
                        @endif
                        <div class="flex flex-wrap gap-3 mt-4">
                            @if($mentor->stats['skills'] && count($mentor->stats['skills']) > 0)
                                @foreach($mentor->stats['skills'] as $skill)
                                    <span class="px-4 py-2 bg-secondary/10 text-secondary rounded-full text-sm font-medium">
                                        {{ $skill }}
                                    </span>
                                @endforeach
                            @endif
                        </div>
                    </div>

                    <!-- Action Button -->
                    <div class="w-full md:w-auto">
                        @auth
                            @if(auth()->user()->umkmOwner)
                                <a href="{{ route('mentoring.create') }}?mentor_id={{ $mentor->id }}" class="block w-full md:w-auto bg-primary text-white px-8 py-3 rounded-full font-semibold text-center hover:bg-primary-700 transition shadow-lg">
                                    Ajukan Mentoring
                                </a>
                            @else
                                <button onclick="showLoginModal('{{ route('mentor.detail', $mentor->id) }}')" class="block w-full md:w-auto bg-primary text-white px-8 py-3 rounded-full font-semibold text-center hover:bg-primary-700 transition shadow-lg">
                                    Ajukan Mentoring
                                </button>
                            @endif
                        @else
                            <button onclick="showLoginModal('{{ route('mentor.detail', $mentor->id) }}')" class="block w-full md:w-auto bg-primary text-white px-8 py-3 rounded-full font-semibold text-center hover:bg-primary-700 transition shadow-lg">
                                Ajukan Mentoring
                            </button>
                        @endauth
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Left: About & Details -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- Tentang Mentor -->
                    @if($mentor->about)
                        <div class="bg-white p-8 rounded-2xl shadow-sm border border-zinc-200">
                            <h3 class="text-2xl font-bold text-primary mb-4">Tentang Mentor</h3>
                            <p class="text-zinc-700 leading-relaxed whitespace-pre-wrap">{{ $mentor->about }}</p>
                        </div>
                    @endif

                    <!-- Pengalaman -->
                    @if($mentor->experience)
                        <div class="bg-white p-8 rounded-2xl shadow-sm border border-zinc-200">
                            <h3 class="text-2xl font-bold text-primary mb-4">Pengalaman</h3>
                            <p class="text-zinc-700 leading-relaxed whitespace-pre-wrap">{{ $mentor->experience }}</p>
                        </div>
                    @endif
                </div>

                <!-- Right Sidebar: Stats -->
                <div class="space-y-6">
                    <!-- Statistics -->
                    <div class="bg-gradient-to-br from-primary to-primary-800 text-white p-6 rounded-2xl shadow-xl">
                        <h3 class="text-xl font-bold mb-4">Statistik</h3>
                        <div class="space-y-4">
                            <div>
                                <p class="text-sm opacity-90">Reputasi</p>
                                <p class="text-3xl font-bold">
                                    @if($mentor->stats['reputation_score'] > 0)
                                        ⭐ {{ number_format($mentor->stats['reputation_score'], 1) }}
                                    @else
                                        Belum Ada Rating
                                    @endif
                                </p>
                            </div>
                            <div>
                                <p class="text-sm opacity-90">Sessions Selesai</p>
                                <p class="text-2xl font-bold">{{ $completedSessions }}</p>
                            </div>
                            @if($totalHours > 0)
                                <div>
                                    <p class="text-sm opacity-90">Total Hours</p>
                                    <p class="text-2xl font-bold">{{ $totalHours }} jam</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Contact -->
                    @if($mentor->user->email || $mentor->user->phone)
                        <div class="bg-white p-6 rounded-2xl shadow-sm border border-zinc-200">
                            <h3 class="text-xl font-bold text-primary mb-4">Kontak</h3>
                            <div class="space-y-3">
                                @if($mentor->user->email)
                                    <a href="mailto:{{ $mentor->user->email }}" class="flex items-center space-x-3 text-primary hover:text-primary-700">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                        <span class="text-sm">{{ $mentor->user->email }}</span>
                                    </a>
                                @endif
                                @if($mentor->user->phone)
                                    <a href="https://wa.me/{{ str_replace(['+', ' ', '-'], '', $mentor->user->phone) }}" target="_blank" class="flex items-center space-x-3 text-green-600 hover:text-green-700">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                                        </svg>
                                        <span class="text-sm">{{ $mentor->user->phone }}</span>
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Login Modal -->
    @include('components.modals.login')
</x-layouts.main>
