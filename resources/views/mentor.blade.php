<x-layouts.main>
    <div class="min-h-screen bg-white py-12">
        <div class="container mx-auto px-4 max-w-7xl">
            <!-- Title -->
            <h1 class="text-4xl md:text-5xl font-bold text-primary mb-10">Direktori Mentor</h1>

            <!-- Search & Filter Row -->
            <div class="flex flex-col lg:flex-row gap-6 mb-10">
                <!-- Search -->
                <div class="flex-1">
                    <div class="relative">
                        <input type="text" placeholder="Cari mentor..."
                               class="w-full pl-12 pr-4 py-3 border border-zinc-300 rounded-xl text-base focus:outline-none focus:ring-2 focus:ring-secondary focus:border-transparent transition">
                        <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </div>

                <!-- Filter Dropdown -->
                <div class="lg:w-64">
                    <select class="w-full px-4 py-3 border border-zinc-300 rounded-xl text-base focus:outline-none focus:ring-2 focus:ring-secondary focus:border-transparent transition appearance-none bg-white">
                        <option>Semua Keahlian</option>
                        <option>Marketing</option>
                        <option>F&B Business</option>
                        <option>Social Media</option>
                        <option>Digital Marketing</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                <!-- Sidebar: Top Mentors -->
                <div class="lg:col-span-1">
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-zinc-200">
                        <div class="flex items-center mb-4">
                            <svg class="w-6 h-6 text-secondary mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                            <h3 class="font-semibold text-lg text-primary">Mentor Terpopuler</h3>
                        </div>

                        <div class="space-y-4">
                            @php
                                $topMentors = [
                                    ['name' => 'Bayu Andrawati, S.E., M.M.', 'mentorships' => 15, 'image' => 'https://randomuser.me/api/portraits/men/32.jpg'],
                                    ['name' => 'Bayu Andrawati, S.E., M.M.', 'mentorships' => 15, 'image' => 'https://randomuser.me/api/portraits/men/45.jpg'],
                                    ['name' => 'Bayu Andrawati, S.E., M.M.', 'mentorships' => 15, 'image' => 'https://randomuser.me/api/portraits/men/12.jpg'],
                                    ['name' => 'Bayu Andrawati, S.E., M.M.', 'mentorships' => 15, 'image' => 'https://randomuser.me/api/portraits/women/68.jpg'],
                                    ['name' => 'Bayu Andrawati, S.E., M.M.', 'mentorships' => 15, 'image' => 'https://randomuser.me/api/portraits/men/75.jpg'],
                                ];
                            @endphp

                            @foreach($topMentors as $index => $mentor)
                                <div class="flex items-center space-x-3">
                                    <div class="flex-shrink-0 w-10 h-10 rounded-full bg-secondary text-white flex items-center justify-center font-bold text-sm shadow-md">
                                        {{ $index + 1 }}
                                    </div>
                                    <img src="{{ $mentor['image'] }}" alt="{{ $mentor['name'] }}" class="w-10 h-10 rounded-full object-cover ring-2 ring-white shadow">
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-primary truncate">{{ $mentor['name'] }}</p>
                                        <p class="text-xs text-zinc-500">{{ $mentor['mentorships'] }} mentorships</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Main Grid: Mentor Cards -->
                <div class="lg:col-span-3">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @php
                            $mentors = [
                                [
                                    'name' => 'Bayu Andrawati, S.E., M.M.',
                                    'location' => 'Surabaya, Indonesia',
                                    'rating' => 4.9,
                                    'description' => 'Pengusaha sukses asal Padang, kini menetap di Jakarta. Berpengalaman 15+ tahun di bidang F&B dan ekspor kuliner.',
                                    'skills' => ['Marketing', 'F&B Business', 'Social Media'],
                                    'available_hours' => 5,
                                    'image' => 'https://randomuser.me/api/portraits/men/32.jpg'
                                ],
                                [
                                    'name' => 'Bayu Andrawati, S.E., M.M.',
                                    'location' => 'Surabaya, Indonesia',
                                    'rating' => 4.9,
                                    'description' => 'Pengusaha sukses asal Padang, kini menetap di Jakarta. Berpengalaman 15+ tahun di bidang F&B dan ekspor kuliner.',
                                    'skills' => ['Marketing', 'F&B Business', 'Social Media'],
                                    'available_hours' => 5,
                                    'image' => 'https://randomuser.me/api/portraits/men/45.jpg'
                                ],
                                [
                                    'name' => 'Bayu Andrawati, S.E., M.M.',
                                    'location' => 'Surabaya, Indonesia',
                                    'rating' => 4.9,
                                    'description' => 'Pengusaha sukses asal Padang, kini menetap di Jakarta. Berpengalaman 15+ tahun di bidang F&B dan ekspor kuliner.',
                                    'skills' => ['Marketing', 'F&B Business', 'Social Media'],
                                    'available_hours' => 5,
                                    'image' => 'https://randomuser.me/api/portraits/women/68.jpg'
                                ],
                                [
                                    'name' => 'Bayu Andrawati, S.E., M.M.',
                                    'location' => 'Surabaya, Indonesia',
                                    'rating' => 4.9,
                                    'description' => 'Pengusaha sukses asal Padang, kini menetap di Jakarta. Berpengalaman 15+ tahun di bidang F&B dan ekspor kuliner.',
                                    'skills' => ['Marketing', 'F&B Business', 'Social Media'],
                                    'available_hours' => 5,
                                    'image' => 'https://randomuser.me/api/portraits/men/12.jpg'
                                ],
                            ];
                        @endphp

                        @foreach($mentors as $mentor)
                            <div class="bg-white p-6 rounded-2xl shadow-sm border border-zinc-200 hover:shadow-lg transition-shadow duration-300">
                                <div class="flex items-start justify-between mb-4">
                                    <div class="flex items-center space-x-4">
                                        <img src="{{ $mentor['image'] }}" alt="{{ $mentor['name'] }}" class="w-16 h-16 rounded-full object-cover ring-4 ring-white shadow-lg">
                                        <div>
                                            <h3 class="font-bold text-lg text-primary">{{ $mentor['name'] }}</h3>
                                            <p class="text-sm text-zinc-600">{{ $mentor['location'] }}</p>
                                            <div class="flex items-center space-x-1 mt-1">
                                                <svg class="w-5 h-5 text-secondary" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c..3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                </svg>
                                                <span class="font-semibold text-primary">{{ $mentor['rating'] }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <p class="text-sm text-zinc-700 mb-4 leading-relaxed line-clamp-3">
                                    {{ $mentor['description'] }}
                                </p>

                                <!-- Skills -->
                                <div class="flex flex-wrap gap-2 mb-4">
                                    @foreach($mentor['skills'] as $skill)
                                        <span class="px-3 py-1 bg-secondary/10 text-secondary text-xs font-medium rounded-full">
                                            {{ $skill }}
                                        </span>
                                    @endforeach
                                </div>

                                <!-- Availability -->
                                <div class="flex items-center justify-between mb-4">
                                    <div class="flex items-center space-x-2 text-sm">
                                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <span class="font-medium text-zinc-700">{{ $mentor['available_hours'] }} jam tersedia</span>
                                    </div>
                                    <button class="bg-primary text-white px-5 py-2 rounded-full text-sm font-medium hover:bg-primary-700 transition shadow-sm">
                                        Ajukan
                                    </button>
                                </div>

                                <!-- Favorite Icon (Centered Below Card) -->
                                <div class="flex justify-center mt-4">
                                    <button class="text-secondary hover:opacity-80 transition">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.974 2.89a1 1 0 00-.364 1.118l1.52 4.674c.3.921-.755 1.688-1.54 1.118l-3.975-2.89a1 1 0 00-1.175 0l-3.974 2.89c-.784.57-1.838-.197-1.54-1.118l1.52-4.674a1 1 0 00-.364-1.118l-3.975-2.89c-.783-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.main>