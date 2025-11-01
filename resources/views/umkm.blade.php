<x-layouts.main>
    <!-- Hero Section -->
    <section class="relative h-[600px] md:h-[700px] flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('assets/images/umkm-hero.png') }}" alt="RantauHub"
                 class="w-full h-full object-cover filter brightness-75">
            <div class="absolute inset-0 bg-gradient-to-b from-transparent to-black/70"></div>
        </div>

        <div class="relative z-10 container mx-auto px-4 text-center">
            <h1 class="text-5xl md:text-7xl font-bold text-white mb-4">RantauHub</h1>
            <div class="inline-block mb-4">
                <p class="bg-yellow-500 text-primary px-6 py-2 rounded-full text-lg md:text-xl font-bold">
                    Rangkak Anak Nagari Tuju Andalas Unggul
                </p>
            </div>
            <p class="text-white text-xl md:text-2xl mb-6">Smart Solution for West Sumatra Sustainability</p>
            <p class="text-white text-sm md:text-base max-w-2xl mx-auto mb-8">
                Menghubungkan diaspora Minangkabau dengan UMKM lokal Sumatera Barat melalui investasi, mentorship, dan kolaborasi untuk ekonomi berkelanjutan.
            </p>
            <a href="#" class="inline-flex items-center space-x-2 bg-yellow-500 text-primary px-8 py-3 rounded-full font-semibold hover:bg-yellow-600 transition">
                <span>Daftar Sekarang</span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        </div>
    </section>

    <!-- Title + Filters -->
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl md:text-4xl font-bold text-primary mb-8">Pendanaan UMKM</h2>

            <div class="flex flex-col lg:flex-row gap-6 items-center justify-between">
                <!-- Kategori -->
                <div class="w-full lg:w-64">
                    <select class="w-full px-4 py-3 border border-zinc-300 rounded-lg text-base focus:outline-none focus:ring-2 focus:ring-yellow-500">
                        <option>Semua Kategori</option>
                        <option>Kuliner</option>
                        <option>Kerajinan</option>
                        <option>Pertanian</option>
                        <option>Fashion</option>
                    </select>
                </div>

                <!-- Sort -->
                <div class="w-full lg:w-64">
                    <select class="w-full px-4 py-3 border border-zinc-300 rounded-lg text-base focus:outline-none focus:ring-2 focus:ring-yellow-500">
                        <option>Paling Trending</option>
                        <option>Terbaru</option>
                        <option>Progres Tertinggi</option>
                        <option>Minimum Investasi</option>
                    </select>
                </div>

                <!-- Minimum Investasi -->
                <div class="bg-gradient-to-r from-primary to-primary-800 text-white px-8 py-5 rounded-lg shadow-md text-center min-w-[220px]">
                    <p class="text-sm font-medium uppercase tracking-wider">Minimum Investasi</p>
                    <p class="text-3xl font-bold">Rp 100.000</p>
                </div>
            </div>
        </div>
    </section>

    <!-- UMKM Grid -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @php
                    $umkms = [
                        [
                            'name' => 'Rendang Uni Rina',
                            'location' => 'Solok, Sumatera Barat',
                            'description' => 'Rendang autentik minangkabau dengan resep turun temurun yang telah diwariskan dengan 3 generasi.',
                            'funded' => 35000000,
                            'percentage' => 70,
                            'investors' => 21,
                            'image' => 'https://images.tokopedia.net/img/cache/700/product-1/2020/6/15/12345678/12345678_abc.jpg'
                        ],
                        [
                            'name' => 'Rendang Uni Rina',
                            'location' => 'Solok, Sumatera Barat',
                            'description' => 'Rendang autentik minangkabau dengan resep turun temurun yang telah diwariskan dengan 3 generasi.',
                            'funded' => 35000000,
                            'percentage' => 70,
                            'investors' => 21,
                            'image' => 'https://cf.shopee.co.id/file/abc123_def456_ghi789_jkl'
                        ],
                        [
                            'name' => 'Rendang Uni Rina',
                            'location' => 'Solok, Sumatera Barat',
                            'description' => 'Rendang autentik minangkabau dengan resep turun temurun yang telah diwariskan dengan 3 generasi.',
                            'funded' => 35000000,
                            'percentage' => 70,
                            'investors' => 21,
                            'image' => 'https://images.unsplash.com/photo-1607330287972-3ddce0f7d2b9?w=400'
                        ],
                        [
                            'name' => 'Rendang Uni Rina',
                            'location' => 'Solok, Sumatera Barat',
                            'description' => 'Rendang autentik minangkabau dengan resep turun temurun yang telah diwariskan dengan 3 generasi.',
                            'funded' => 35000000,
                            'percentage' => 70,
                            'investors' => 21,
                            'image' => 'https://images.unsplash.com/photo-1567620908042-9e0522c9c9c6?w=400'
                        ],
                        [
                            'name' => 'Rendang Uni Rina',
                            'location' => 'Solok, Sumatera Barat',
                            'description' => 'Rendang autentik minangkabau dengan resep turun temurun yang telah diwariskan dengan 3 generasi.',
                            'funded' => 35000000,
                            'percentage' => 70,
                            'investors' => 21,
                            'image' => 'https://images.unsplash.com/photo-1579621970799-9b2c7e8c1b8f?w=400'
                        ],
                        [
                            'name' => 'Rendang Uni Rina',
                            'location' => 'Solok, Sumatera Barat',
                            'description' => 'Rendang autentik minangkabau dengan resep turun temurun yang telah diwariskan dengan 3 generasi.',
                            'funded' => 35000000,
                            'percentage' => 70,
                            'investors' => 21,
                            'image' => 'https://images.unsplash.com/photo-1581093450021-92e4c6d6c7b8?w=400'
                        ],
                    ];
                @endphp

                @foreach($umkms as $umkm)
                    <div class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-xl transition-all duration-300">
                        <!-- Image -->
                        <div class="w-full h-48 bg-zinc-100">
                            <img src="{{ $umkm['image'] }}" alt="{{ $umkm['name'] }}"
                                 class="w-full h-full object-cover">
                        </div>

                        <div class="p-5">
                            <h3 class="text-lg font-bold text-primary mb-1">{{ $umkm['name'] }}</h3>
                            <div class="flex items-center text-sm text-zinc-600 mb-2">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span>{{ $umkm['location'] }}</span>
                            </div>
                            <p class="text-sm text-zinc-600 mb-4 line-clamp-2">
                                {{ $umkm['description'] }}
                            </p>

                            <!-- Progress -->
                            <div class="mb-4">
                                <div class="flex justify-between text-sm mb-1">
                                    <span class="text-zinc-700 font-medium">
                                        Rp {{ number_format($umkm['funded'], 1, ',', '.') }} jt terkumpul
                                    </span>
                                    <span class="text-primary font-bold">{{ $umkm['percentage'] }}%</span>
                                </div>
                                <div class="w-full bg-zinc-200 rounded-full h-2">
                                    <div class="bg-yellow-500 h-2 rounded-full transition-all duration-500"
                                         style="width: {{ $umkm['percentage'] }}%"></div>
                                </div>
                            </div>

                            <!-- Investors -->
                            <div class="flex items-center justify-between text-sm mb-4">
                                <div class="flex items-center space-x-1 text-zinc-600">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                    <span>{{ $umkm['investors'] }} Investor</span>
                                </div>
                            </div>

                            <!-- CTA -->
                            <a href="#"
                               class="block w-full bg-primary text-white text-center py-2.5 rounded-lg font-semibold hover:bg-primary-700 transition text-sm">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</x-layouts.main>