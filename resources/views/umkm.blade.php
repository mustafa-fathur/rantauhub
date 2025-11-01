<x-layouts.main>
    <!-- Hero Section -->
    <section class="relative h-[600px] md:h-[700px] flex items-center justify-center overflow-hidden">
        <a href="/register">
            <div class="absolute inset-0 z-0">
            <img src="{{ asset('assets/images/hero-umkm.png') }}" alt="RantauHub"
                 class="w-full h-full object-cover filter">
            <div class="absolute inset-0 bg-gradient-to-b from-transparent"></div>
        </div>
        </a>
    </section>

    <!-- Title + Filters -->
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl md:text-4xl font-bold text-primary mb-8">Pendanaan UMKM</h2>

            <form method="GET" action="{{ route('umkm') }}" class="flex flex-col lg:flex-row gap-6 items-center justify-between">
                <!-- Search -->
                <div class="flex-1 w-full lg:w-auto">
                    <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Cari UMKM..."
                           class="w-full px-4 py-3 border border-zinc-300 rounded-lg text-base focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition">
                </div>

                <!-- Kategori -->
                <div class="w-full lg:w-64">
                    <select name="category" class="w-full px-4 py-3 border border-zinc-300 rounded-lg text-base focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->value }}" {{ ($selectedCategory ?? '') == $category->value ? 'selected' : '' }}>
                                {{ $category->label() }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Sort -->
                <div class="w-full lg:w-64">
                    <select name="sort" class="w-full px-4 py-3 border border-zinc-300 rounded-lg text-base focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary">
                        <option value="latest" {{ ($sort ?? 'latest') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                        <option value="name" {{ ($sort ?? 'latest') == 'name' ? 'selected' : '' }}>Nama A-Z</option>
                        <option value="most_funded" {{ ($sort ?? 'latest') == 'most_funded' ? 'selected' : '' }}>Paling Banyak Terdanai</option>
                    </select>
                </div>

                <!-- Minimum Pendanaan -->
                <div class="bg-gradient-to-r from-primary to-primary-800 text-white px-8 py-5 rounded-lg shadow-md text-center min-w-[220px]">
                    <p class="text-sm font-medium uppercase tracking-wider">Minimum Pendanaan</p>
                    <p class="text-3xl font-bold">Rp 100.000</p>
                </div>

                <button type="submit" class="hidden">Filter</button>
            </form>
        </div>
    </section>

    <!-- UMKM Grid -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            @php
                // Fallback data statis untuk MVP jika tidak ada data dari database
                $staticUmkms = [
                    [
                        'id' => 999,
                        'name' => 'Keripik Balado Uni Kezi',
                        'location' => 'Padang, Sumatera Barat',
                        'description' => 'Keripik singkong dan ubi dengan balado khas Padang yang pedas dan gurih. Produk halal dan higienis.',
                        'logo' => null,
                        'funding_stats' => [
                            'total_funded' => 12000000,
                            'target_amount' => 25000000,
                            'percentage' => 48,
                            'investors_count' => 18,
                            'has_open_request' => true,
                        ]
                    ],
                    [
                        'id' => 998,
                        'name' => 'Batagor Mang Ujang',
                        'location' => 'Bukittinggi, Sumatera Barat',
                        'description' => 'Batagor khas Bandung dengan cita rasa yang khas, dibuat dengan bahan-bahan pilihan berkualitas tinggi.',
                        'logo' => null,
                        'funding_stats' => [
                            'total_funded' => 8500000,
                            'target_amount' => 20000000,
                            'percentage' => 42,
                            'investors_count' => 12,
                            'has_open_request' => true,
                        ]
                    ],
                    [
                        'id' => 997,
                        'name' => 'Rendang Minang Asli',
                        'location' => 'Payakumbuh, Sumatera Barat',
                        'description' => 'Rendang dengan resep turun temurun, dimasak dengan api kayu dan bumbu rempah pilihan.',
                        'logo' => null,
                        'funding_stats' => [
                            'total_funded' => 15000000,
                            'target_amount' => 30000000,
                            'percentage' => 50,
                            'investors_count' => 25,
                            'has_open_request' => true,
                        ]
                    ],
                ];
                
                // Gunakan data real jika ada, jika tidak gunakan data statis
                $displayUmkms = $umkms->count() > 0 ? $umkms : collect($staticUmkms);
            @endphp

            @if($displayUmkms->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                    @foreach($displayUmkms as $umkm)
                        <div class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-xl transition-all duration-300">
                            <!-- Image -->
                            <div class="w-full h-48 bg-zinc-100">
                                @if(isset($umkm->logo) && $umkm->logo)
                                    <img src="{{ asset('storage/' . $umkm->logo) }}" alt="{{ $umkm->name ?? 'UMKM' }}"
                                         class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-primary/10">
                                        <span class="text-4xl font-bold text-primary">{{ substr($umkm->name ?? 'U', 0, 1) }}</span>
                                    </div>
                                @endif
                            </div>

                            <div class="p-5">
                                <h3 class="text-lg font-bold text-primary mb-1">{{ $umkm->name ?? 'Nama UMKM' }}</h3>
                                <div class="flex items-center text-sm text-zinc-600 mb-2">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <span>{{ $umkm->location ?? 'Sumatera Barat' }}</span>
                                </div>
                                <p class="text-sm text-zinc-600 mb-4 line-clamp-2">
                                    {{ $umkm->description ?? 'Tidak ada deskripsi' }}
                                </p>

                                <!-- Progress -->
                                @if(isset($umkm->funding_stats) && ($umkm->funding_stats['has_open_request'] ?? false))
                                    <div class="mb-4">
                                        <div class="flex justify-between text-sm mb-1">
                                            <span class="text-zinc-700 font-medium">
                                                Rp {{ number_format(($umkm->funding_stats['total_funded'] ?? 0) / 1000000, 1, ',', '.') }} jt terkumpul
                                            </span>
                                            <span class="text-primary font-bold">{{ $umkm->funding_stats['percentage'] ?? 0 }}%</span>
                                        </div>
                                        <div class="w-full bg-zinc-200 rounded-full h-2">
                                            <div class="bg-secondary h-2 rounded-full transition-all duration-500"
                                                 style="width: {{ $umkm->funding_stats['percentage'] ?? 0 }}%"></div>
                                        </div>
                                    </div>

                                    <!-- Investors -->
                                    <div class="flex items-center justify-between text-sm mb-4">
                                        <div class="flex items-center space-x-1 text-zinc-600">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                            </svg>
                                            <span>{{ $umkm->funding_stats['investors_count'] ?? 0 }} Investor</span>
                                        </div>
                                    </div>
                                @endif

                                <!-- CTA -->
                                @if(isset($umkm->id) && $umkm->id < 900)
                                    <a href="{{ route('umkm.detail', $umkm->id) }}"
                                       class="block w-full bg-primary text-white text-center py-2.5 rounded-lg font-semibold hover:bg-primary-700 transition text-sm">
                                        Lihat Detail
                                    </a>
                                @else
                                    <a href="{{ route('umkm.detail', $umkm->id) }}"
                                       class="block w-full bg-primary text-white text-center py-2.5 rounded-lg font-semibold hover:bg-primary-700 transition text-sm">
                                        Lihat Detail
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $umkms->links() }}
                </div>
            @else
                <div class="text-center py-12">
                    <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-zinc-100 mb-6">
                        <svg class="w-12 h-12 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-zinc-900 mb-2">Tidak Ada UMKM Ditemukan</h3>
                    <p class="text-zinc-600">Coba gunakan filter atau kata kunci yang berbeda</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Login Modal -->
    @include('components.modals.login')
</x-layouts.main>
