<x-layouts.main>
    <div class="min-h-screen bg-white py-12">
        <div class="container mx-auto px-4 max-w-7xl">
            <!-- Title -->
            <h1 class="text-4xl md:text-5xl font-bold text-primary mb-10">Direktori Mentor</h1>

            <!-- Search & Filter Row -->
            <form method="GET" action="{{ route('mentor') }}" class="flex flex-col lg:flex-row gap-6 mb-10">
                <!-- Search -->
                <div class="flex-1">
                    <div class="relative">
                        <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Cari mentor..."
                               class="w-full pl-12 pr-4 py-3 border border-zinc-300 rounded-xl text-base focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition">
                        <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </div>

                <!-- Filter Dropdown -->
                <div class="lg:w-64">
                    <select name="skill" class="w-full px-4 py-3 border border-zinc-300 rounded-xl text-base focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition appearance-none bg-white">
                        <option value="">Semua Keahlian</option>
                        @foreach($availableSkills ?? [] as $skill)
                            <option value="{{ $skill }}" {{ ($selectedSkill ?? '') == $skill ? 'selected' : '' }}>
                                {{ $skill }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="hidden">Filter</button>
            </form>

            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                <!-- Sidebar: Top Mentors -->
                @if($topMentors && $topMentors->count() > 0)
                    <div class="lg:col-span-1">
                        <div class="bg-white p-6 rounded-2xl shadow-sm border border-zinc-200">
                            <div class="flex items-center mb-4">
                                <svg class="w-6 h-6 text-secondary mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                                <h3 class="font-semibold text-lg text-primary">Mentor Terpopuler</h3>
                            </div>

                            <div class="space-y-4">
                                @foreach($topMentors as $index => $mentor)
                                    <div class="flex items-center space-x-3">
                                        <div class="flex-shrink-0 w-10 h-10 rounded-full bg-secondary text-white flex items-center justify-center font-bold text-sm shadow-md">
                                            {{ $index + 1 }}
                                        </div>
                                        @if($mentor->user->profile_photo)
                                            <img src="{{ asset('storage/' . $mentor->user->profile_photo) }}" alt="{{ $mentor->user->name }}" class="w-10 h-10 rounded-full object-cover ring-2 ring-white shadow">
                                        @else
                                            <div class="w-10 h-10 rounded-full bg-primary text-white flex items-center justify-center font-bold text-sm shadow">
                                                {{ substr($mentor->user->name, 0, 1) }}
                                            </div>
                                        @endif
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-primary truncate">{{ $mentor->user->name }}</p>
                                            <p class="text-xs text-zinc-500">{{ $mentor->stats['completed_sessions'] ?? 0 }} sessions</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Main Grid: Mentor Cards -->
                <div class="{{ ($topMentors && $topMentors->count() > 0) ? 'lg:col-span-3' : 'lg:col-span-4' }}">
                    @if($mentors->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @foreach($mentors as $mentor)
                                <div class="bg-white p-6 rounded-2xl shadow-sm border border-zinc-200 hover:shadow-lg transition-shadow duration-300">
                                    <div class="flex items-start justify-between mb-4">
                                        <div class="flex items-center space-x-4">
                                            @if($mentor->user->profile_photo)
                                                <img src="{{ asset('storage/' . $mentor->user->profile_photo) }}" alt="{{ $mentor->user->name }}" class="w-16 h-16 rounded-full object-cover ring-4 ring-white shadow-lg">
                                            @else
                                                <div class="w-16 h-16 rounded-full bg-primary text-white flex items-center justify-center font-bold text-xl ring-4 ring-white shadow-lg">
                                                    {{ substr($mentor->user->name, 0, 1) }}
                                                </div>
                                            @endif
                                            <div>
                                                <h3 class="font-bold text-lg text-primary">{{ $mentor->user->name }}</h3>
                                                <p class="text-sm text-zinc-600">{{ $mentor->user->address ?? 'Sumatera Barat' }}</p>
                                                @if($mentor->current_job)
                                                    <p class="text-xs text-zinc-500 mt-1">{{ $mentor->current_job }}</p>
                                                @endif
                                                @if($mentor->stats['reputation_score'] > 0)
                                                    <div class="flex items-center space-x-1 mt-1">
                                                        <svg class="w-5 h-5 text-secondary" fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                        </svg>
                                                        <span class="font-semibold text-primary">{{ number_format($mentor->stats['reputation_score'], 1) }}</span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    @if($mentor->about)
                                        <p class="text-sm text-zinc-700 mb-4 leading-relaxed line-clamp-3">
                                            {{ $mentor->about }}
                                        </p>
                                    @endif

                                    <!-- Skills -->
                                    @if($mentor->stats['skills'] && count($mentor->stats['skills']) > 0)
                                        <div class="flex flex-wrap gap-2 mb-4">
                                            @foreach(array_slice($mentor->stats['skills'], 0, 3) as $skill)
                                                <span class="px-3 py-1 bg-secondary/10 text-secondary text-xs font-medium rounded-full">
                                                    {{ $skill }}
                                                </span>
                                            @endforeach
                                            @if(count($mentor->stats['skills']) > 3)
                                                <span class="px-3 py-1 bg-zinc-100 text-zinc-600 text-xs font-medium rounded-full">
                                                    +{{ count($mentor->stats['skills']) - 3 }}
                                                </span>
                                            @endif
                                        </div>
                                    @endif

                                    <!-- Availability -->
                                    <div class="flex items-center justify-between mb-4">
                                        <div class="flex items-center space-x-2 text-sm">
                                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            <span class="font-medium text-zinc-700">{{ $mentor->stats['completed_sessions'] ?? 0 }} sessions selesai</span>
                                        </div>
                                        @auth
                                            @if(auth()->user()->umkmOwner)
                                                <a href="{{ route('mentoring.create') }}?mentor_id={{ $mentor->id }}" class="bg-primary text-white px-5 py-2 rounded-full text-sm font-medium hover:bg-primary-700 transition shadow-sm">
                                                    Ajukan
                                                </a>
                                            @else
                                                <a href="{{ route('mentor.detail', $mentor->id) }}" class="bg-primary text-white px-5 py-2 rounded-full text-sm font-medium hover:bg-primary-700 transition shadow-sm">
                                                    Detail
                                                </a>
                                            @endif
                                        @else
                                            <a href="{{ route('mentor.detail', $mentor->id) }}" class="bg-primary text-white px-5 py-2 rounded-full text-sm font-medium hover:bg-primary-700 transition shadow-sm">
                                                Detail
                                            </a>
                                        @endauth
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12">
                            <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-zinc-100 mb-6">
                                <svg class="w-12 h-12 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-zinc-900 mb-2">Tidak Ada Mentor Ditemukan</h3>
                            <p class="text-zinc-600">Coba gunakan filter atau kata kunci yang berbeda</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Login Modal -->
    @include('components.modals.login')
</x-layouts.main>
