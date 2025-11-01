<x-layouts.main>
    <div class="min-h-screen bg-white py-12">
        <div class="container mx-auto px-4 max-w-7xl">
            <!-- Title -->
            <div class="mb-10">
                <h1 class="text-4xl md:text-5xl font-bold text-primary mb-2">Forum Komunitas</h1>
                <p class="text-zinc-600">Diskusi dan berbagi pengalaman dengan komunitas RantauHub</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                <!-- Sidebar: Kategori -->
                <div class="lg:col-span-1">
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-zinc-200">
                        <h3 class="font-bold text-lg text-primary mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                            Kategori
                        </h3>

                        <div class="space-y-2">
                            @php
                                $categories = [
                                    ['name' => 'Semua Kategori', 'active' => true],
                                    ['name' => 'Bisnis & Kuliner'],
                                    ['name' => 'Ekspor Produk Lokal'],
                                    ['name' => 'Digital Marketing'],
                                    ['name' => 'Mentorship'],
                                    ['name' => 'Investasi'],
                                    ['name' => 'Teknologi dan Digitalisasi'],
                                ];
                            @endphp

                            @foreach($categories as $cat)
                                <a href="#" class="block px-4 py-2.5 rounded-lg text-sm font-medium transition
                                    {{ $cat['active'] ?? false ? 'bg-primary text-white' : 'text-zinc-700 hover:bg-zinc-100' }}">
                                    {{ $cat['name'] }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Main Content: Forum Threads -->
                <div class="lg:col-span-3">
                    <div class="space-y-6">
                        @php
                            $threads = [
                                [
                                    'title' => 'Tips Packaging Rendang untuk Ekspor ke Luar Negeri',
                                    'author' => 'Bayu Andrawati, S.E., M.M.',
                                    'time' => '2 jam lalu',
                                    'tags' => ['ekspor', 'packaging', 'rendang'],
                                    'replies' => 24,
                                    'views' => 352,
                                    'avatar' => 'https://randomuser.me/api/portraits/men/32.jpg'
                                ],
                                [
                                    'title' => 'Tips Packaging Rendang untuk Ekspor ke Luar Negeri',
                                    'author' => 'Bayu Andrawati, S.E., M.M.',
                                    'time' => '2 jam lalu',
                                    'tags' => ['ekspor', 'packaging', 'rendang'],
                                    'replies' => 24,
                                    'views' => 352,
                                    'avatar' => 'https://randomuser.me/api/portraits/men/45.jpg'
                                ],
                                [
                                    'title' => 'Tips Packaging Rendang untuk Ekspor ke Luar Negeri',
                                    'author' => 'Bayu Andrawati, S.E., M.M.',
                                    'time' => '2 jam lalu',
                                    'tags' => ['ekspor', 'packaging', 'rendang'],
                                    'replies' => 24,
                                    'views' => 352,
                                    'avatar' => 'https://randomuser.me/api/portraits/women/68.jpg'
                                ],
                                [
                                    'title' => 'Tips Packaging Rendang untuk Ekspor ke Luar Negeri',
                                    'author' => 'Bayu Andrawati, S.E., M.M.',
                                    'time' => '2 jam lalu',
                                    'tags' => ['ekspor', 'packaging', 'rendang'],
                                    'replies' => 24,
                                    'views' => 352,
                                    'avatar' => 'https://randomuser.me/api/portraits/men/12.jpg'
                                ],
                                [
                                    'title' => 'Tips Packaging Rendang untuk Ekspor ke Luar Negeri',
                                    'author' => 'Bayu Andrawati, S.E., M.M.',
                                    'time' => '2 jam lalu',
                                    'tags' => ['ekspor', 'packaging', 'rendang'],
                                    'replies' => 24,
                                    'views' => 352,
                                    'avatar' => 'https://randomuser.me/api/portraits/men/75.jpg'
                                ],
                            ];
                        @endphp

                        @foreach($threads as $thread)
                            <div class="bg-white p-6 rounded-2xl shadow-sm border border-zinc-200 hover:shadow-md transition-shadow">
                                <div class="flex items-start space-x-4">
                                    <!-- Avatar -->
                                    <div class="flex-shrink-0">
                                        <img src="{{ $thread['avatar'] }}" alt="{{ $thread['author'] }}"
                                             class="w-12 h-12 rounded-full object-cover ring-2 ring-white shadow">
                                    </div>

                                    <!-- Content -->
                                    <div class="flex-1 min-w-0">
                                        <h3 class="text-lg font-bold text-primary mb-1 line-clamp-2">
                                            {{ $thread['title'] }}
                                        </h3>
                                        <p class="text-sm text-zinc-600 mb-3">
                                            oleh <span class="font-medium">{{ $thread['author'] }}</span> · {{ $thread['time'] }}
                                        </p>

                                        <!-- Tags -->
                                        <div class="flex flex-wrap gap-2 mb-4">
                                            @foreach($thread['tags'] as $tag)
                                                <span class="px-3 py-1 bg-blue-100 text-blue-700 text-xs font-medium rounded-full">
                                                    {{ $tag }}
                                                </span>
                                            @endforeach
                                        </div>

                                        <!-- Stats -->
                                        <div class="flex items-center space-x-6 text-sm text-zinc-500">
                                            <div class="flex items-center space-x-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                          d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                                </svg>
                                                <span>{{ $thread['replies'] }} balasan</span>
                                            </div>
                                            <div class="flex items-center space-x-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                          d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                </svg>
                                                <span>{{ $thread['views'] }} views</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.main>