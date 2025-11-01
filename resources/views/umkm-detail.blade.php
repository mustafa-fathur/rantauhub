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
                        @if($umkm->logo)
                            <img src="{{ asset('storage/' . $umkm->logo) }}" alt="{{ $umkm->name }}"
                                 class="w-20 h-20 rounded-xl object-cover shadow-lg">
                        @else
                            <div class="w-20 h-20 bg-primary rounded-xl flex items-center justify-center text-white text-4xl font-bold shadow-lg">
                                {{ substr($umkm->name, 0, 1) }}
                            </div>
                        @endif
                        <div>
                            <h1 class="text-3xl font-bold text-primary">{{ $umkm->name }}</h1>
                            <p class="text-zinc-600 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                oleh {{ $umkm->owner->user->name ?? 'Pemilik UMKM' }} · {{ $umkm->location }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Right: Buttons -->
                <div class="flex flex-col space-y-4">
                    @if($openFunding)
                        @auth
                            @if(auth()->user()->funder && auth()->user()->funder->verified)
                                <a href="{{ route('funder.funding-requests.show', $openFunding->id) }}" class="bg-primary text-white px-6 py-3 rounded-full font-semibold text-center hover:bg-primary-700 transition shadow-md">
                                    Dukung Sekarang
                                </a>
                            @else
                                <button onclick="showLoginModal('{{ route('umkm.detail', $umkm->id) }}')" class="bg-primary text-white px-6 py-3 rounded-full font-semibold text-center hover:bg-primary-700 transition shadow-md">
                                    Dukung Sekarang
                                </button>
                            @endif
                        @else
                            <button onclick="showLoginModal('{{ route('umkm.detail', $umkm->id) }}')" class="bg-primary text-white px-6 py-3 rounded-full font-semibold text-center hover:bg-primary-700 transition shadow-md">
                                Dukung Sekarang
                            </button>
                        @endauth
                    @else
                        <div class="bg-zinc-100 text-zinc-600 px-6 py-3 rounded-full font-semibold text-center">
                            Tidak Ada Request Pendanaan
                        </div>
                    @endif
                    
                    @if($umkm->owner->user->phone)
                        <a href="https://wa.me/{{ str_replace(['+', ' ', '-'], '', $umkm->owner->user->phone) }}" target="_blank" class="border border-zinc-300 px-6 py-3 rounded-full font-medium text-center hover:bg-zinc-50 transition flex items-center justify-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                            <span>Hubungi UMKM</span>
                        </a>
                    @endif
                </div>
            </div>

            <!-- Main Content -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Left: Image + Overview -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- Product Image -->
                    <div class="rounded-2xl overflow-hidden shadow-lg">
                        @if(isset($umkm->pictures) && $umkm->pictures->count() > 0 && isset($umkm->pictures->first()->path))
                            <img src="{{ asset('storage/' . $umkm->pictures->first()->path) }}" alt="{{ $umkm->name }}"
                                 class="w-full h-96 object-cover hover:scale-105 transition-transform duration-500">
                        @elseif(isset($umkm->logo) && $umkm->logo)
                            <img src="{{ asset('storage/' . $umkm->logo) }}" alt="{{ $umkm->name }}"
                                 class="w-full h-96 object-cover hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="w-full h-96 bg-primary/10 flex items-center justify-center">
                                <span class="text-6xl font-bold text-primary">{{ substr($umkm->name, 0, 1) }}</span>
                            </div>
                        @endif
                    </div>

                    <!-- Overview Content -->
                    <div class="space-y-8">
                        <!-- Tentang Bisnis -->
                        <div class="bg-white p-8 rounded-2xl shadow-sm border border-zinc-200">
                            <h3 class="text-2xl font-bold text-primary mb-4">Tentang Bisnis</h3>
                            <p class="text-zinc-700 leading-relaxed mb-6">
                                {{ $umkm->description ?? 'Tidak ada deskripsi tersedia.' }}
                            </p>
                            
                            <div class="mt-4">
                                <p class="text-sm font-medium text-zinc-600 mb-2">Kategori</p>
                                <span class="inline-block px-4 py-2 bg-primary/10 text-primary rounded-full text-sm font-medium">
                                    @if(isset($umkm->category))
                                        @if(isset($umkm->category->value) && $umkm->category->value === 'lainnya' && isset($umkm->other_category) && $umkm->other_category)
                                            {{ $umkm->other_category }}
                                        @elseif(isset($umkm->category->label))
                                            {{ is_callable($umkm->category->label) ? $umkm->category->label() : ($umkm->category->label ?? 'Makanan & Minuman') }}
                                        @else
                                            Makanan & Minuman
                                        @endif
                                    @else
                                        Makanan & Minuman
                                    @endif
                                </span>
                            </div>
                        </div>

                        <!-- Contact Info -->
                        @if((isset($umkm->owner->user->phone) && $umkm->owner->user->phone) || (isset($umkm->owner->user->email) && $umkm->owner->user->email))
                            <div class="bg-white p-8 rounded-2xl shadow-sm border border-zinc-200">
                                <h3 class="text-2xl font-bold text-primary mb-4">Kontak</h3>
                                <div class="space-y-3">
                                    @if(isset($umkm->owner->user->phone) && $umkm->owner->user->phone)
                                        <a href="https://wa.me/{{ str_replace(['+', ' ', '-'], '', $umkm->owner->user->phone) }}" target="_blank" class="flex items-center space-x-3 text-green-600 hover:text-green-700">
                                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                                            </svg>
                                            <span class="font-medium">{{ $umkm->owner->user->phone }}</span>
                                        </a>
                                    @endif
                                    @if(isset($umkm->owner->user->email) && $umkm->owner->user->email)
                                        <a href="mailto:{{ $umkm->owner->user->email }}" class="flex items-center space-x-3 text-primary hover:text-primary-700">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                            </svg>
                                            <span class="font-medium">{{ $umkm->owner->user->email }}</span>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Right Sidebar -->
                <div class="space-y-8">
                    <!-- Ringkasan Pendanaan -->
                    @if($openFunding || $totalFunded > 0)
                        <div class="bg-gradient-to-br from-primary to-primary-800 text-white p-8 rounded-2xl shadow-xl">
                            <h3 class="text-2xl font-bold mb-6">Ringkasan Pendanaan</h3>
                            <div class="space-y-4">
                                <div>
                                    <p class="text-sm opacity-90">Total Terkumpul</p>
                                    <p class="text-3xl font-bold">Rp {{ number_format($totalFunded / 1000000, 1, ',', '.') }} Juta</p>
                                </div>
                                <div>
                                    <div class="w-full bg-white/20 rounded-full h-3">
                                        <div class="bg-yellow-500 h-3 rounded-full transition-all duration-500" style="width: {{ $percentage }}%"></div>
                                    </div>
                                    <p class="text-sm mt-2">{{ $percentage }}% Tercapai</p>
                                </div>
                                @if($openFunding)
                                    @auth
                                        @if(auth()->user()->funder && auth()->user()->funder->verified && isset($openFunding->id) && $openFunding->id < 900)
                                            <a href="{{ route('funder.funding-requests.show', $openFunding->id) }}" class="block w-full bg-yellow-500 text-primary text-center py-3 rounded-full font-bold hover:bg-yellow-600 transition">
                                                Dukung UMKM Ini
                                            </a>
                                        @elseif(!auth()->user()->funder || !isset($openFunding->id) || $openFunding->id >= 900)
                                            <button onclick="showLoginModal('{{ route('umkm.detail', $umkm->id) }}')" class="w-full bg-yellow-500 text-primary text-center py-3 rounded-full font-bold hover:bg-yellow-600 transition">
                                                Dukung UMKM Ini
                                            </button>
                                        @else
                                            <div class="w-full bg-yellow-100 text-yellow-800 text-center py-3 rounded-full font-semibold text-sm">
                                                Akun Funder belum terverifikasi
                                            </div>
                                        @endif
                                    @else
                                        <button onclick="showLoginModal('{{ route('umkm.detail', $umkm->id) }}')" class="w-full bg-yellow-500 text-primary text-center py-3 rounded-full font-bold hover:bg-yellow-600 transition">
                                            Dukung UMKM Ini
                                        </button>
                                    @endauth
                                @endif
                            </div>
                        </div>
                    @endif

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
                                    <p class="text-zinc-600">{{ $umkm->location }}</p>
                                </div>
                            </div>
                            @if($investorsCount > 0)
                                <div>
                                    <p class="font-medium">Total Backers</p>
                                    <p class="text-2xl font-bold text-primary">{{ $investorsCount }} Orang</p>
                                </div>
                            @endif
                            @if($openFunding)
                                <div>
                                    <p class="font-medium">Target Pendanaan</p>
                                    <p class="text-2xl font-bold text-primary">Rp {{ number_format($targetAmount / 1000000, 1, ',', '.') }} Juta</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Login Modal -->
    @include('components.modals.login')
</x-layouts.main>
