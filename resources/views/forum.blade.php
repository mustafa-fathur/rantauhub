<x-layouts.main>
    <div class="min-h-screen bg-white py-12">
        <div class="container mx-auto px-4 max-w-7xl">
            <!-- Title -->
            <div class="mb-10">
                <h1 class="text-4xl md:text-5xl font-bold text-primary mb-2">Forum Komunitas</h1>
                <p class="text-zinc-600">Diskusi dan berbagi pengalaman dengan komunitas RantauHub</p>
            </div>

            <!-- Search & Filter -->
            <form method="GET" action="{{ route('forum') }}" class="mb-8">
                <div class="flex flex-col md:flex-row gap-4">
                    <div class="flex-1">
                        <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Cari diskusi..."
                               class="w-full px-4 py-3 border border-zinc-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary">
                    </div>
                    <div class="md:w-48">
                        <select name="sort" class="w-full px-4 py-3 border border-zinc-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary">
                            <option value="latest" {{ ($sort ?? 'latest') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                            <option value="popular" {{ ($sort ?? 'latest') == 'popular' ? 'selected' : '' }}>Populer</option>
                            <option value="most_commented" {{ ($sort ?? 'latest') == 'most_commented' ? 'selected' : '' }}>Paling Banyak Komentar</option>
                        </select>
                    </div>
                    <button type="submit" class="hidden">Filter</button>
                </div>
            </form>

            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                <!-- Sidebar: Kategori -->
                <div class="lg:col-span-1">
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-zinc-200 sticky top-4">
                        <h3 class="font-bold text-lg text-primary mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                            Kategori
                        </h3>

                        <div class="space-y-2">
                            <a href="{{ route('forum') }}" class="block px-4 py-2.5 rounded-lg text-sm font-medium transition {{ !request()->has('forum') ? 'bg-primary text-white' : 'text-zinc-700 hover:bg-zinc-100' }}">
                                Semua Kategori
                            </a>
                            @foreach($forums as $forum)
                                <a href="{{ route('forum', ['forum' => $forum->id]) }}" class="block px-4 py-2.5 rounded-lg text-sm font-medium transition {{ (request()->get('forum') == $forum->id) ? 'bg-primary text-white' : 'text-zinc-700 hover:bg-zinc-100' }}">
                                    {{ $forum->title }}
                                    <span class="text-xs opacity-75">({{ $forum->posts_count }})</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Main Content: Forum Threads -->
                <div class="lg:col-span-3">
                    @if($posts->count() > 0)
                        <div class="space-y-6">
                            @foreach($posts as $post)
                                <a href="{{ route('forum.detail', $post->id) }}" class="block bg-white p-6 rounded-2xl shadow-sm border border-zinc-200 hover:shadow-md transition-shadow">
                                    <div class="flex items-start space-x-4">
                                        <!-- Avatar -->
                                        <div class="flex-shrink-0">
                                            @if($post->author->profile_photo)
                                                <img src="{{ asset('storage/' . $post->author->profile_photo) }}" alt="{{ $post->author->name }}"
                                                     class="w-12 h-12 rounded-full object-cover ring-2 ring-white shadow">
                                            @else
                                                <div class="w-12 h-12 rounded-full bg-primary text-white flex items-center justify-center font-bold text-lg ring-2 ring-white shadow">
                                                    {{ substr($post->author->name, 0, 1) }}
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Content -->
                                        <div class="flex-1 min-w-0">
                                            <div class="flex items-center justify-between mb-2">
                                                <h3 class="text-lg font-bold text-primary line-clamp-2">
                                                    {{ $post->title }}
                                                </h3>
                                                <span class="ml-4 px-3 py-1 bg-primary/10 text-primary text-xs font-medium rounded-full whitespace-nowrap">
                                                    {{ $post->forum->title }}
                                                </span>
                                            </div>
                                            <p class="text-sm text-zinc-600 mb-3">
                                                oleh <span class="font-medium">{{ $post->author->name }}</span> · {{ $post->created_at->diffForHumans() }}
                                            </p>

                                            <!-- Tags -->
                                            @if($post->tags->count() > 0)
                                                <div class="flex flex-wrap gap-2 mb-4">
                                                    @foreach($post->tags->take(3) as $tag)
                                                        <span class="px-3 py-1 bg-blue-100 text-blue-700 text-xs font-medium rounded-full">
                                                            {{ $tag->tag }}
                                                        </span>
                                                    @endforeach
                                                </div>
                                            @endif

                                            <!-- Stats -->
                                            <div class="flex items-center space-x-6 text-sm text-zinc-500">
                                                <div class="flex items-center space-x-1">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                              d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                                    </svg>
                                                    <span>{{ $post->stats['comments_count'] }} balasan</span>
                                                </div>
                                                <div class="flex items-center space-x-1">
                                                    <svg class="w-4 h-4 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path>
                                                    </svg>
                                                    <span>{{ $post->stats['likes_count'] }} suka</span>
                                                </div>
                                                <div class="flex items-center space-x-1">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                              d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                    </svg>
                                                    <span>{{ $post->stats['views'] }} views</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div class="mt-8">
                            {{ $posts->links() }}
                        </div>
                    @else
                        <div class="text-center py-12">
                            <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-zinc-100 mb-6">
                                <svg class="w-12 h-12 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-zinc-900 mb-2">Belum Ada Diskusi</h3>
                            <p class="text-zinc-600">Jadilah yang pertama memulai diskusi!</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-layouts.main>
