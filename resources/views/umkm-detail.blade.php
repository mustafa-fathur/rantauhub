<x-layouts.main>
    <div class="min-h-screen bg-white py-8">
        <div class="container mx-auto px-4 max-w-7xl">
            <!-- Back Button -->
            <a href="{{ route('umkm') }}" class="inline-flex items-center text-primary font-medium mb-6 hover:text-primary-700 transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Kembali
            </a>

            <!-- Header: UMKM Info -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-10">
                <!-- Left: Logo & Name -->
                <div class="lg:col-span-2">
                    <div class="flex items-center space-x-6 mb-4">
                        <div class="w-20 h-20 bg-primary rounded-xl flex items-center justify-center text-white text-4xl font-bold shadow-lg">
                            K
                        </div>
                        <div>
                            <h1 class="text-3xl font-bold text-primary">Keripik Balado Uni Kezi</h1>
                            <p class="text-zinc-600 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                oleh Kezia Valerina · Padang, Sumatera Barat
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Right: Buttons -->
                <div class="flex flex-col space-y-4">
                    <a href="#" class="bg-primary text-white px-6 py-3 rounded-full font-semibold text-center hover:bg-primary-700 transition shadow-md">
                        Dukung Sekarang
                    </a>
                    <button class="border border-zinc-300 px-6 py-3 rounded-full font-medium text-center hover:bg-zinc-50 transition flex items-center justify-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                        <span>Hubungi UMKM</span>
                    </button>
                </div>
            </div>

            <!-- Main Content -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Left: Image + Overview -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- Product Image -->
                    <div class="rounded-2xl overflow-hidden shadow-lg">
                        <img src="https://images.tokopedia.net/img/cache/700/product-1/2020/6/15/12345678/12345678_keripik-balado.jpg" alt="Keripik Balado Uni Kezi"
                             class="w-full h-96 object-cover hover:scale-105 transition-transform duration-500">
                    </div>

                    <!-- Tabs -->
                    <div class="bg-primary/10 rounded-2xl p-1 inline-block">
                        <div class="flex space-x-1">
                            <button class="px-6 py-3 bg-primary text-white rounded-xl font-medium">Overview</button>
                            <button class="px-6 py-3 text-primary font-medium hover:bg-primary/20 rounded-xl transition">Funding</button>
                            <button class="px-6 py-3 text-primary font-medium hover:bg-primary/20 rounded-xl transition">Mentorship</button>
                            <button class="px-6 py-3 text-primary font-medium hover:bg-primary/20 rounded-xl transition">Updates</button>
                        </div>
                    </div>

                    <!-- Overview Content -->
                    <div class="space-y-8">
                        <!-- Tentang Bisnis -->
                        <div class="bg-white p-8 rounded-2xl shadow-sm border border-zinc-200">
                            <h3 class="text-2xl font-bold text-primary mb-4">Tentang Bisnis</h3>
                            <p class="text-zinc-700 leading-relaxed mb-6">
                                Keripik singkong dan ubi dengan balado khas Padang yang pedas dan gurih. Produk halal dan higienis.
                            </p>
                        </div>

                        <!-- Misi Kami -->
                        <div class="bg-white p-8 rounded-2xl shadow-sm border border-zinc-200">
                            <h3 class="text-2xl font-bold text-primary mb-4">Misi Kami</h3>
                            <p class="text-zinc-700 leading-relaxed">
                                Menjadi brand keripik balado terdepan dengan cita rasa otentik dan kemasan modern.
                            </p>
                        </div>

                        <!-- Media Sosial -->
                        <div class="bg-white p-8 rounded-2xl shadow-sm border border-zinc-200">
                            <h3 class="text-2xl font-bold text-primary mb-4">Media Sosial</h3>
                            <div class="flex items-center space-x-6">
                                <a href="#" class="flex items-center space-x-2 text-green-600 hover:text-green-700">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2.04c-5.5 0-9.96 4.47-9.96 9.96 0 4.41 2.86 8.15 6.84 9.49.5.09.68-.22.68-.48 0-.24-.01-.87-.01-1.71-2.78.6-3.37-1.34-3.37-1.34-.45-1.15-1.11-1.46-1.11-1.46-.91-.62.07-.61.07-.61 1.01.07 1.54 1.03 1.54 1.03.9 1.54 2.36 1.1 2.93.84.09-.65.35-1.1.64-1.35-2.22-.25-4.55-1.11-4.55-4.94 0-1.09.39-1.98 1.03-2.68-.1-.25-.45-1.27.1-2.65 0 0 .84-.27 2.75 1.02.8-.22 1.65-.33 2.5-.33.85 0 1.7.11 2.5.33 1.91-1.29 2.75-1.02 2.75-1.02.55 1.38.2 2.4.1 2.65.64.7 1.03 1.59 1.03 2.68 0 3.84-2.34 4.69-4.57 4.93.36.31.68.92.68 1.85 0 1.34-.01 2.42-.01 2.75 0 .27.18.58.69.48 3.97-1.34 6.83-5.08 6.83-9.49 0-5.5-4.46-9.96-9.96-9.96z"/>
                                    </svg>
                                    <span class="font-medium">+62 813-7851-4467</span>
                                </a>
                                <a href="#" class="flex items-center space-x-2 text-pink-600 hover:text-pink-700">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2.04c-5.5 0-9.96 4.47-9.96 9.96 0 4.41 2.86 8.15 6.84 9.49.5.09.68-.22.68-.48 0-.24-.01-.87-.01-1.71-2.78.6-3.37-1.34-3.37-1.34-.45-1.15-1.11-1.46-1.11-1.46-.91-.62.07-.61.07-.61 1.01.07 1.54 1.03 1.54 1.03.9 1.54 2.36 1.1 2.93.84.09-.65.35-1.1.64-1.35-2.22-.25-4.55-1.11-4.55-4.94 0-1.09.39-1.98 1.03-2.68-.1-.25-.45-1.27.1-2.65 0 0 .84-.27 2.75 1.02.8-.22 1.65-.33 2.5-.33.85 0 1.7.11 2.5.33 1.91-1.29 2.75-1.02 2.75-1.02.55 1.38.2 2.4.1 2.65.64.7 1.03 1.59 1.03 2.68 0 3.84-2.34 4.69-4.57 4.93.36.31.68.92.68 1.85 0 1.34-.01 2.42-.01 2.75 0 .27.18.58.69.48 3.97-1.34 6.83-5.08 6.83-9.49 0-5.5-4.46-9.96-9.96-9.96z"/>
                                    </svg>
                                    <span class="font-medium">@keripikbalado_unikezi</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Sidebar -->
                <div class="space-y-8">
                    <!-- Ringkasan Pendanaan -->
                    <div class="bg-gradient-to-br from-primary to-primary-800 text-white p-8 rounded-2xl shadow-xl">
                        <h3 class="text-2xl font-bold mb-6">Ringkasan Pendanaan</h3>
                        <div class="space-y-4">
                            <div>
                                <p class="text-sm opacity-90">Total Terkumpul</p>
                                <p class="text-3xl font-bold">Rp 12,0 Juta</p>
                            </div>
                            <div>
                                <div class="w-full bg-white/20 rounded-full h-3">
                                    <div class="bg-yellow-500 h-3 rounded-full transition-all duration-500" style="width: 48%"></div>
                                </div>
                                <p class="text-sm mt-2">48% Tercapai</p>
                            </div>
                            <a href="#" class="block w-full bg-yellow-500 text-primary text-center py-3 rounded-full font-bold hover:bg-yellow-600 transition">
                                Dukung UMKM Ini
                            </a>
                        </div>
                    </div>

                    <!-- Informasi -->
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-zinc-200">
                        <h3 class="text-xl font-bold text-primary mb-4">Informasi</h3>
                        <div class="space-y-4 text-sm">
                            <div class="flex items-center space-x-3">
                                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <div>
                                    <p class="font-medium">Lokasi</p>
                                    <p class="text-zinc-600">Bukittinggi, Sumatera Barat</p>
                                </div>
                            </div>
                            <div>
                                <p class="font-medium">Total Backers</p>
                                <p class="text-2xl font-bold text-primary">18 Orang</p>
                            </div>
                            <div>
                                <p class="font-medium">Target Pendanaan</p>
                                <p class="text-2xl font-bold text-primary">Rp 25,0 Juta</p>
                            </div>
                        </div>
                    </div>

                    <!-- Hubungi -->
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-zinc-200">
                        <h3 class="text-xl font-bold text-primary mb-4">Hubungi</h3>
                        <input type="text" placeholder="Kirim Pesan" class="w-full px-4 py-3 border border-zinc-300 rounded-lg mb-4 focus:outline-none focus:ring-2 focus:ring-primary">
                        <button class="w-full bg-green-600 text-white py-3 rounded-lg font-medium hover:bg-green-700 transition flex items-center justify-center space-x-2">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.04c-5.5 0-9.96 4.47-9.96 9.96 0 4.41 2.86 8.15 6.84 9.49.5.09.68-.22.68-.48 0-.24-.01-.87-.01-1.71-2.78.6-3.37-1.34-3.37-1.34-.45-1.15-1.11-1.46-1.11-1.46-.91-.62.07-.61.07-.61 1.01.07 1.54 1.03 1.54 1.03.9 1.54 2.36 1.1 2.93.84.09-.65.35-1.1.64-1.35-2.22-.25-4.55-1.11-4.55-4.94 0-1.09.39-1.98 1.03-2.68-.1-.25-.45-1.27.1-2.65 0 0 .84-.27 2.75 1.02.8-.22 1.65-.33 2.5-.33.85 0 1.7.11 2.5.33 1.91-1.29 2.75-1.02 2.75-1.02.55 1.38.2 2.4.1 2.65.64.7 1.03 1.59 1.03 2.68 0 3.84-2.34 4.69-4.57 4.93.36.31.68.92.68 1.85 0 1.34-.01 2.42-.01 2.75 0 .27.18.58.69.48 3.97-1.34 6.83-5.08 6.83-9.49 0-5.5-4.46-9.96-9.96-9.96z"/>
                            </svg>
                            <span>WhatsApp</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.main>