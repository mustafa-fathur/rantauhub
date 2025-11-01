<x-layouts.main>
    <!-- Hero Section -->
    <section class="relative h-[600px] md:h-[700px] flex items-center justify-center overflow-hidden">
        <!-- Background Image -->
        <a href="/register">
            <div class="absolute inset-0 z-0">
            <img src="{{ asset(path: 'assets/images/home-hero.png') }}" alt="Hero Background" class="w-full h-full object-cover">
            <div class="absolute inset-0"></div>
        </div>
        </a>
    </section>

    <!-- Statistik Singkat -->
    <section class="py-16 bg-zinc-50">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Diaspora -->
                <div class="bg-white rounded-2xl shadow-sm border border-zinc-200 p-6">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-10 h-10 rounded-lg bg-primary/10 text-primary flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </div>
                        <h3 class="text-sm font-medium text-zinc-600">Diaspora Member</h3>
                    </div>
                    <p class="text-3xl font-bold text-primary">12.5K+</p>
                    <p class="text-xs text-zinc-500 mt-1">Tersebar di 20+ negara</p>
                </div>

                <!-- Active Mentor -->
                <div class="bg-white rounded-2xl shadow-sm border border-zinc-200 p-6">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-10 h-10 rounded-lg bg-secondary/10 text-secondary flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                        <h3 class="text-sm font-medium text-zinc-600">Mentor Aktif</h3>
                    </div>
                    <p class="text-3xl font-bold text-primary">320+</p>
                    <p class="text-xs text-zinc-500 mt-1">Siap membimbing UMKM</p>
                </div>

                <!-- Total Penggalangan Dana -->
                <div class="bg-white rounded-2xl shadow-sm border border-zinc-200 p-6">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-10 h-10 rounded-lg bg-primary/10 text-primary flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8V4m0 12v4m8-10a8 8 0 11-16 0 8 8 0 0116 0z"/></svg>
                        </div>
                        <h3 class="text-sm font-medium text-zinc-600">Penggalangan Dana</h3>
                    </div>
                    <p class="text-3xl font-bold text-primary">Rp 2,1 M+</p>
                    <p class="text-xs text-zinc-500 mt-1">Terkelola di RantauHub</p>
                </div>

                <!-- UMKM Terbantu -->
                <div class="bg-white rounded-2xl shadow-sm border border-zinc-200 p-6">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-10 h-10 rounded-lg bg-secondary/10 text-secondary flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6M8 6h8M5 8h14M5 16h14M5 12h14"/></svg>
                        </div>
                        <h3 class="text-sm font-medium text-zinc-600">UMKM Terbantu</h3>
                    </div>
                    <p class="text-3xl font-bold text-primary">540+</p>
                    <p class="text-xs text-zinc-500 mt-1">Terdaftar & dibina</p>
                </div>
            </div>
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
                <a href="/umkm" class="flex items-center space-x-2 text-primary hover:text-primary-600 transition">
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
                    <div class="w-full h-48 relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=900&auto=format&fit=crop&q=60" alt="Rendang autentik Minang" class="w-full h-full object-cover" loading="lazy">
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
                        <a href="/mentor" class="block w-full bg-primary text-white text-center py-2 rounded-lg hover:bg-primary-600 transition font-semibold">
                            Lihat Detail
                        </a>
                    </div>
                </div>

                <!-- UMKM Card 2 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                    <div class="w-full h-48 relative overflow-hidden">
                        <img src="https://commons.wikimedia.org/wiki/Special:FilePath/Tenunan_songket_khas_Minangkabau.jpg?width=900" alt="Kerajinan Tenun Minang (Songket Minangkabau)" class="w-full h-full object-cover" loading="lazy">
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
                    <div class="w-full h-48 relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1445077100181-a33e9ac94db0?w=900&auto=format&fit=crop&q=60" alt="Kopi Arabica Minang" class="w-full h-full object-cover" loading="lazy">
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
                    <div class="w-full h-48 relative overflow-hidden">
                        <img src="https://commons.wikimedia.org/wiki/Special:FilePath/Baju_Adat_Melayu_Pontianak.jpg?width=900" alt="Fashion Baju Kurung Modern (Melayu)" class="w-full h-full object-cover" loading="lazy">
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
                        <img src="https://randomuser.me/api/portraits/men/75.jpg" alt="Bayu Andrawati" class="w-20 h-20 rounded-full object-cover">
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
                        <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Ahmad Hidayat" class="w-20 h-20 rounded-full object-cover">
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
                        <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Rina Sari" class="w-20 h-20 rounded-full object-cover">
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
                        <img src="https://randomuser.me/api/portraits/men/41.jpg" alt="Dedi Wijaya" class="w-20 h-20 rounded-full object-cover">
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

    <!-- Kisah Sukses -->
    <section id="kisah-sukses" class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h2 class="text-3xl md:text-4xl font-bold text-primary mb-2">Kisah Sukses</h2>
                    <p class="text-zinc-600">Cerita nyata dampak kolaborasi diaspora dan UMKM</p>
                </div>
                <a href="#" class="flex items-center space-x-2 text-primary hover:text-primary-600 transition">
                    <span>Lihat Semua</span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Card 1 -->
                <div class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-lg transition">
                    <div class="h-52 w-full overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=900&auto=format&fit=crop&q=60" alt="Kuliner Minang" class="w-full h-full object-cover">
                    </div>
                    <div class="p-5">
                        <h3 class="text-lg font-bold text-primary mb-1">Rendang Menembus Pasar Asia</h3>
                        <p class="text-sm text-zinc-600 mb-4">Dengan mentor diaspora F&B, UMKM lokal menaikkan standar packaging dan ekspor pertama ke Malaysia.</p>
                        <a href="#" class="text-primary hover:text-primary-600 font-semibold text-sm">Baca kisah →</a>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-lg transition">
                    <div class="h-52 w-full overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1521737604893-d14cc237f11d?w=900&auto=format&fit=crop&q=60" alt="Mentorship" class="w-full h-full object-cover">
                    </div>
                    <div class="p-5">
                        <h3 class="text-lg font-bold text-primary mb-1">Digitalisasi Pemasaran UMKM</h3>
                        <p class="text-sm text-zinc-600 mb-4">Program mentorship 8 minggu meningkatkan omzet 3x melalui kanal digital.</p>
                        <a href="#" class="text-primary hover:text-primary-600 font-semibold text-sm">Baca kisah →</a>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-lg transition">
                    <div class="h-52 w-full overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1445077100181-a33e9ac94db0?w=900&auto=format&fit=crop&q=60" alt="Kopi Minang" class="w-full h-full object-cover">
                    </div>
                    <div class="p-5">
                        <h3 class="text-lg font-bold text-primary mb-1">Kopi Minang ke Kafe Jakarta</h3>
                        <p class="text-sm text-zinc-600 mb-4">Kolaborasi modal diaspora membuka jalur distribusi ke 25+ kafe.</p>
                        <a href="#" class="text-primary hover:text-primary-600 font-semibold text-sm">Baca kisah →</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Kata Mereka (Testimoni) -->
    <section id="testimoni" class="py-16 bg-zinc-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-10">
                <h2 class="text-3xl md:text-4xl font-bold text-primary mb-2">Kata Mereka</h2>
                <p class="text-zinc-600">Pengalaman para pelaku UMKM dan diaspora menggunakan RantauHub</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Testimonial 1 -->
                <div class="bg-white rounded-2xl shadow-sm border border-zinc-200 p-6">
                    <div class="flex items-center gap-3 mb-3">
                        <img src="https://randomuser.me/api/portraits/women/82.jpg" alt="User" class="w-12 h-12 rounded-full object-cover">
                        <div>
                            <p class="font-semibold text-primary">Siti Nurhaliza</p>
                            <p class="text-xs text-zinc-500">Pemilik UMKM Rendang - Padang</p>
                        </div>
                    </div>
                    <p class="text-zinc-700 mb-4">“Mentor diaspora membantu saya menyusun strategi pemasaran digital. Penjualan online naik signifikan!”</p>
                    <div class="flex text-secondary">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="w-5 h-5 text-zinc-300" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    </div>
                </div>

                <!-- Testimonial 2 -->
                <div class="bg-white rounded-2xl shadow-sm border border-zinc-200 p-6">
                    <div class="flex items-center gap-3 mb-3">
                        <img src="https://randomuser.me/api/portraits/men/61.jpg" alt="User" class="w-12 h-12 rounded-full object-cover">
                        <div>
                            <p class="font-semibold text-primary">Andi Pratama</p>
                            <p class="text-xs text-zinc-500">Diaspora Mentor - Singapura</p>
                        </div>
                    </div>
                    <p class="text-zinc-700 mb-4">“Platformnya memudahkan mentoring terstruktur. Saya bisa jadwalkan sesi dan monitor progres UMKM.”</p>
                    <div class="flex text-secondary">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    </div>
                </div>

                <!-- Testimonial 3 -->
                <div class="bg-white rounded-2xl shadow-sm border border-zinc-200 p-6">
                    <div class="flex items-center gap-3 mb-3">
                        <img src="https://randomuser.me/api/portraits/men/12.jpg" alt="User" class="w-12 h-12 rounded-full object-cover">
                        <div>
                            <p class="font-semibold text-primary">Rizal Fikri</p>
                            <p class="text-xs text-zinc-500">Investor Komunitas - Jakarta</p>
                        </div>
                    </div>
                    <p class="text-zinc-700 mb-4">“Transparansi progress pendanaan dan laporan penggunaan dana sangat membantu dalam mengambil keputusan.”</p>
                    <div class="flex text-secondary">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg class="w-5 h-5 text-zinc-300" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layouts.main>
