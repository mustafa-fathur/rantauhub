<x-layouts.main>
    <!-- Hero Section -->
    <section class="relative h-[600px] md:h-[700px] flex items-center justify-center overflow-hidden">
        <!-- Background Image -->
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('assets/images/hero.png') }}" alt="Hero Background" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-black/50"></div>
        </div>

        <!-- Content -->
        <div class="relative z-10 container mx-auto px-4 text-center">
            <!-- Logo Overlay (Right Side) -->
            <div class="absolute right-8 top-8 md:right-16 md:top-16 opacity-20">
                <div class="flex items-center space-x-2">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="RantauHub" class="h-16 w-16 md:h-24 md:w-24">
                    <span class="text-4xl md:text-6xl font-bold text-secondary">RANTAU</span>
                </div>
            </div>

            <!-- Main Title -->
            <h1 class="text-5xl md:text-7xl font-bold text-secondary mb-4">
                RantauHub
            </h1>

            <!-- Subtitle 1 -->
            <div class="inline-block mb-4">
                <p class="bg-secondary text-primary px-6 py-2 rounded-lg text-lg md:text-xl font-bold">
                    Rangkak Anak Nagari Tuju Andalas Unggul
                </p>
            </div>

            <!-- Subtitle 2 -->
            <p class="text-white text-xl md:text-2xl mb-6">
                Smart Solution for West Sumatra Sustainability
            </p>

            <!-- Description -->
            <p class="text-white text-sm md:text-base max-w-2xl mx-auto mb-8">
                Menghubungkan diaspora Minangkabau dengan UMKM lokal Sumatera Barat melalui investasi, mentorship, dan kolaborasi untuk ekonomi berkelanjutan.
            </p>

            <!-- CTA Button -->
            <a href="{{ route('register') }}" class="inline-flex items-center space-x-2 bg-accent text-primary px-8 py-3 rounded-lg font-semibold hover:bg-accent-600 transition">
                <span>Daftar Sekarang</span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        </div>
    </section>

    <!-- Investasi UMKM Section -->
    <section id="umkm" class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <!-- Section Header -->
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h2 class="text-3xl md:text-4xl font-bold text-primary mb-2">Investasi UMKM</h2>
                    <p class="text-zinc-600">Para ahli diaspora siap membimbing UMKM Anda</p>
                </div>
                <a href="#" class="flex items-center space-x-2 text-primary hover:text-primary-600 transition">
                    <span>Lihat Semua</span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>

            <!-- UMKM Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- UMKM Card 1 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                    <div class="w-full h-48 bg-zinc-200 relative overflow-hidden">
                        <div class="w-full h-full flex items-center justify-center text-zinc-400">
                            <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div class="absolute top-2 left-2">
                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-orange-100 text-orange-800">
                                Kuliner
                            </span>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-bold text-primary mb-2">Rendang Uni Rina</h3>
                        <div class="flex items-center space-x-1 text-zinc-600 text-sm mb-3">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span>Solok, Sumatera Barat</span>
                        </div>
                        <p class="text-zinc-600 text-sm mb-4 line-clamp-2">
                            Rendang autentik minangkabau dengan resep turun temurun yang telah diwariskan dengan 3 generasi.
                        </p>
                        <div class="mb-4">
                            <div class="flex justify-between text-sm mb-1">
                                <span class="text-zinc-600">Rp 35.0 jt terkumpul</span>
                                <span class="text-primary font-semibold">70%</span>
                            </div>
                            <div class="w-full bg-zinc-200 rounded-full h-2">
                                <div class="bg-secondary h-2 rounded-full transition-all" style="width: 70%"></div>
                            </div>
                        </div>
                        <div class="flex items-center space-x-1 text-zinc-600 text-sm mb-4">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            <span>21 Investor</span>
                        </div>
                        <a href="#" class="block w-full bg-primary text-white text-center py-2 rounded-lg hover:bg-primary-600 transition font-semibold">
                            Lihat Detail
                        </a>
                    </div>
                </div>

                <!-- UMKM Card 2 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                    <div class="w-full h-48 bg-zinc-200 relative overflow-hidden">
                        <div class="w-full h-full flex items-center justify-center text-zinc-400">
                            <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div class="absolute top-2 left-2">
                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-purple-100 text-purple-800">
                                Kerajinan
                            </span>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-bold text-primary mb-2">Kerajinan Tenun Minang</h3>
                        <div class="flex items-center space-x-1 text-zinc-600 text-sm mb-3">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span>Padang, Sumatera Barat</span>
                        </div>
                        <p class="text-zinc-600 text-sm mb-4 line-clamp-2">
                            Produk kerajinan tenun tradisional dengan motif khas Minangkabau yang autentik dan berkualitas.
                        </p>
                        <div class="mb-4">
                            <div class="flex justify-between text-sm mb-1">
                                <span class="text-zinc-600">Rp 28.5 jt terkumpul</span>
                                <span class="text-primary font-semibold">57%</span>
                            </div>
                            <div class="w-full bg-zinc-200 rounded-full h-2">
                                <div class="bg-secondary h-2 rounded-full transition-all" style="width: 57%"></div>
                            </div>
                        </div>
                        <div class="flex items-center space-x-1 text-zinc-600 text-sm mb-4">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            <span>15 Investor</span>
                        </div>
                        <a href="#" class="block w-full bg-primary text-white text-center py-2 rounded-lg hover:bg-primary-600 transition font-semibold">
                            Lihat Detail
                        </a>
                    </div>
                </div>

                <!-- UMKM Card 3 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                    <div class="w-full h-48 bg-zinc-200 relative overflow-hidden">
                        <div class="w-full h-full flex items-center justify-center text-zinc-400">
                            <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div class="absolute top-2 left-2">
                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                Pertanian
                            </span>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-bold text-primary mb-2">Kopi Arabica Minang</h3>
                        <div class="flex items-center space-x-1 text-zinc-600 text-sm mb-3">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span>Bukittinggi, Sumatera Barat</span>
                        </div>
                        <p class="text-zinc-600 text-sm mb-4 line-clamp-2">
                            Kopi arabica premium dari perkebunan tinggi di Sumatera Barat dengan cita rasa khas.
                        </p>
                        <div class="mb-4">
                            <div class="flex justify-between text-sm mb-1">
                                <span class="text-zinc-600">Rp 42.0 jt terkumpul</span>
                                <span class="text-primary font-semibold">84%</span>
                            </div>
                            <div class="w-full bg-zinc-200 rounded-full h-2">
                                <div class="bg-secondary h-2 rounded-full transition-all" style="width: 84%"></div>
                            </div>
                        </div>
                        <div class="flex items-center space-x-1 text-zinc-600 text-sm mb-4">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            <span>32 Investor</span>
                        </div>
                        <a href="#" class="block w-full bg-primary text-white text-center py-2 rounded-lg hover:bg-primary-600 transition font-semibold">
                            Lihat Detail
                        </a>
                    </div>
                </div>

                <!-- UMKM Card 4 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                    <div class="w-full h-48 bg-zinc-200 relative overflow-hidden">
                        <div class="w-full h-full flex items-center justify-center text-zinc-400">
                            <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div class="absolute top-2 left-2">
                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-pink-100 text-pink-800">
                                Fashion
                            </span>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-bold text-primary mb-2">Fashion Baju Kurung Modern</h3>
                        <div class="flex items-center space-x-1 text-zinc-600 text-sm mb-3">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span>Payakumbuh, Sumatera Barat</span>
                        </div>
                        <p class="text-zinc-600 text-sm mb-4 line-clamp-2">
                            Baju kurung dengan desain modern namun tetap mempertahankan nilai-nilai budaya Minangkabau.
                        </p>
                        <div class="mb-4">
                            <div class="flex justify-between text-sm mb-1">
                                <span class="text-zinc-600">Rp 18.5 jt terkumpul</span>
                                <span class="text-primary font-semibold">37%</span>
                            </div>
                            <div class="w-full bg-zinc-200 rounded-full h-2">
                                <div class="bg-secondary h-2 rounded-full transition-all" style="width: 37%"></div>
                            </div>
                        </div>
                        <div class="flex items-center space-x-1 text-zinc-600 text-sm mb-4">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            <span>12 Investor</span>
                        </div>
                        <a href="#" class="block w-full bg-primary text-white text-center py-2 rounded-lg hover:bg-primary-600 transition font-semibold">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mentor Terbaik Section -->
    <section id="mentor" class="py-16 bg-zinc-50">
        <div class="container mx-auto px-4">
            <!-- Section Header -->
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h2 class="text-3xl md:text-4xl font-bold text-primary mb-2">Mentor Terbaik</h2>
                    <p class="text-zinc-600">Para ahli diaspora siap membimbing UMKM Anda</p>
                </div>
                <a href="#" class="flex items-center space-x-2 text-primary hover:text-primary-600 transition">
                    <span>Lihat Semua</span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>

            <!-- Mentor Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Mentor Card 1 -->
                <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition">
                    <div class="flex justify-center mb-4">
                        <div class="w-20 h-20 rounded-full bg-primary flex items-center justify-center overflow-hidden">
                            <span class="text-white text-2xl font-semibold">BA</span>
                        </div>
                    </div>
                    <h3 class="text-lg font-bold text-primary text-center mb-2">Bayu Andrawati, S.E., M.M.</h3>
                    <div class="flex items-center justify-center space-x-1 text-zinc-600 text-sm mb-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span>Surabaya, Indonesia</span>
                    </div>
                    <div class="flex items-center justify-center space-x-1 mb-3">
                        <svg class="w-5 h-5 text-secondary" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <span class="font-semibold text-primary">4.9</span>
                    </div>
                    <p class="text-zinc-600 text-sm text-center mb-4 line-clamp-3">
                        Pengusaha sukses asal Padang, kini menetap di Jakarta. Berpengalaman 15+ tahun di bidang F&B dan ekspor kuliner.
                    </p>
                    <div class="flex flex-wrap justify-center gap-2 mb-4">
                        <span class="px-3 py-1 bg-blue-100 text-primary rounded-full text-xs font-medium">Marketing</span>
                        <span class="px-3 py-1 bg-blue-100 text-primary rounded-full text-xs font-medium">F&B Business</span>
                        <span class="px-3 py-1 bg-blue-100 text-primary rounded-full text-xs font-medium">Social Media</span>
                    </div>
                    <div class="flex items-center justify-center space-x-1 text-zinc-600 text-sm mb-4">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>5 jam tersedia</span>
                    </div>
                    <a href="#" class="block w-full bg-primary text-white text-center py-2 rounded-lg hover:bg-primary-600 transition font-semibold">
                        Ajukan
                    </a>
                </div>

                <!-- Mentor Card 2 -->
                <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition">
                    <div class="flex justify-center mb-4">
                        <div class="w-20 h-20 rounded-full bg-primary flex items-center justify-center overflow-hidden">
                            <span class="text-white text-2xl font-semibold">AH</span>
                        </div>
                    </div>
                    <h3 class="text-lg font-bold text-primary text-center mb-2">Ahmad Hidayat, S.Kom.</h3>
                    <div class="flex items-center justify-center space-x-1 text-zinc-600 text-sm mb-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span>Jakarta, Indonesia</span>
                    </div>
                    <div class="flex items-center justify-center space-x-1 mb-3">
                        <svg class="w-5 h-5 text-secondary" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <span class="font-semibold text-primary">4.8</span>
                    </div>
                    <p class="text-zinc-600 text-sm text-center mb-4 line-clamp-3">
                        Tech entrepreneur dengan pengalaman 12+ tahun di bidang digital marketing dan e-commerce.
                    </p>
                    <div class="flex flex-wrap justify-center gap-2 mb-4">
                        <span class="px-3 py-1 bg-blue-100 text-primary rounded-full text-xs font-medium">Digital Marketing</span>
                        <span class="px-3 py-1 bg-blue-100 text-primary rounded-full text-xs font-medium">E-Commerce</span>
                        <span class="px-3 py-1 bg-blue-100 text-primary rounded-full text-xs font-medium">Technology</span>
                    </div>
                    <div class="flex items-center justify-center space-x-1 text-zinc-600 text-sm mb-4">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>8 jam tersedia</span>
                    </div>
                    <a href="#" class="block w-full bg-primary text-white text-center py-2 rounded-lg hover:bg-primary-600 transition font-semibold">
                        Ajukan
                    </a>
                </div>

                <!-- Mentor Card 3 -->
                <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition">
                    <div class="flex justify-center mb-4">
                        <div class="w-20 h-20 rounded-full bg-primary flex items-center justify-center overflow-hidden">
                            <span class="text-white text-2xl font-semibold">RS</span>
                        </div>
                    </div>
                    <h3 class="text-lg font-bold text-primary text-center mb-2">Rina Sari, S.Pd.</h3>
                    <div class="flex items-center justify-center space-x-1 text-zinc-600 text-sm mb-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span>Bandung, Indonesia</span>
                    </div>
                    <div class="flex items-center justify-center space-x-1 mb-3">
                        <svg class="w-5 h-5 text-secondary" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <span class="font-semibold text-primary">4.7</span>
                    </div>
                    <p class="text-zinc-600 text-sm text-center mb-4 line-clamp-3">
                        Pengusaha fashion dengan keahlian dalam branding dan retail management. Memiliki jaringan luas di industri mode Indonesia.
                    </p>
                    <div class="flex flex-wrap justify-center gap-2 mb-4">
                        <span class="px-3 py-1 bg-blue-100 text-primary rounded-full text-xs font-medium">Branding</span>
                        <span class="px-3 py-1 bg-blue-100 text-primary rounded-full text-xs font-medium">Retail</span>
                        <span class="px-3 py-1 bg-blue-100 text-primary rounded-full text-xs font-medium">Fashion</span>
                    </div>
                    <div class="flex items-center justify-center space-x-1 text-zinc-600 text-sm mb-4">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>6 jam tersedia</span>
                    </div>
                    <a href="#" class="block w-full bg-primary text-white text-center py-2 rounded-lg hover:bg-primary-600 transition font-semibold">
                        Ajukan
                    </a>
                </div>

                <!-- Mentor Card 4 -->
                <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition">
                    <div class="flex justify-center mb-4">
                        <div class="w-20 h-20 rounded-full bg-primary flex items-center justify-center overflow-hidden">
                            <span class="text-white text-2xl font-semibold">DW</span>
                        </div>
                    </div>
                    <h3 class="text-lg font-bold text-primary text-center mb-2">Dedi Wijaya, S.T., M.M.</h3>
                    <div class="flex items-center justify-center space-x-1 text-zinc-600 text-sm mb-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span>Medan, Indonesia</span>
                    </div>
                    <div class="flex items-center justify-center space-x-1 mb-3">
                        <svg class="w-5 h-5 text-secondary" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <span class="font-semibold text-primary">4.6</span>
                    </div>
                    <p class="text-zinc-600 text-sm text-center mb-4 line-clamp-3">
                        Konsultan bisnis dengan fokus pada manajemen operasional dan strategi pertumbuhan untuk UMKM.
                    </p>
                    <div class="flex flex-wrap justify-center gap-2 mb-4">
                        <span class="px-3 py-1 bg-blue-100 text-primary rounded-full text-xs font-medium">Business Strategy</span>
                        <span class="px-3 py-1 bg-blue-100 text-primary rounded-full text-xs font-medium">Operations</span>
                        <span class="px-3 py-1 bg-blue-100 text-primary rounded-full text-xs font-medium">Management</span>
                    </div>
                    <div class="flex items-center justify-center space-x-1 text-zinc-600 text-sm mb-4">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>7 jam tersedia</span>
                    </div>
                    <a href="#" class="block w-full bg-primary text-white text-center py-2 rounded-lg hover:bg-primary-600 transition font-semibold">
                        Ajukan
                    </a>
                </div>
            </div>
        </div>
    </section>
</x-layouts.main>
