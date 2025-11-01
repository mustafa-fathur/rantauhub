<x-layouts.main>
    <div class="min-h-screen bg-white py-12">
        <div class="container mx-auto px-4 max-w-5xl">
            <!-- Back Button -->
            <a href="{{ route('forum') }}" class="inline-flex items-center text-primary font-medium mb-6 hover:text-primary-700 transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Kembali ke Forum
            </a>

            <!-- Post Content -->
            <div class="bg-white rounded-2xl shadow-lg border border-zinc-200 p-8 mb-8">
                <!-- Post Header -->
                <div class="flex items-start space-x-4 mb-6">
                    <div class="flex-shrink-0">
                        @if($post->author->profile_photo)
                            <img src="{{ asset('storage/' . $post->author->profile_photo) }}" alt="{{ $post->author->name }}"
                                 class="w-16 h-16 rounded-full object-cover ring-2 ring-white shadow-lg">
                        @else
                            <div class="w-16 h-16 rounded-full bg-primary text-white flex items-center justify-center font-bold text-2xl ring-2 ring-white shadow-lg">
                                {{ substr($post->author->name, 0, 1) }}
                            </div>
                        @endif
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center justify-between mb-2">
                            <h1 class="text-2xl md:text-3xl font-bold text-primary">{{ $post->title }}</h1>
                            <span class="ml-4 px-4 py-2 bg-primary/10 text-primary text-sm font-medium rounded-full whitespace-nowrap">
                                {{ $post->forum->title }}
                            </span>
                        </div>
                        <p class="text-sm text-zinc-600 mb-4">
                            oleh <span class="font-medium">{{ $post->author->name }}</span> · {{ $post->created_at->format('d M Y, H:i') }} · {{ $post->created_at->diffForHumans() }}
                        </p>

                        <!-- Tags -->
                        @if($post->tags->count() > 0)
                            <div class="flex flex-wrap gap-2 mb-4">
                                @foreach($post->tags as $tag)
                                    <span class="px-3 py-1 bg-blue-100 text-blue-700 text-xs font-medium rounded-full">
                                        {{ $tag->tag }}
                                    </span>
                                @endforeach
                            </div>
                        @endif

                        <!-- Stats -->
                        <div class="flex items-center space-x-6 text-sm text-zinc-500 mb-6">
                            <div class="flex items-center space-x-1">
                                <svg class="w-4 h-4 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path>
                                </svg>
                                <span>{{ $stats['likes_count'] }} suka</span>
                            </div>
                            <div class="flex items-center space-x-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                </svg>
                                <span>{{ $stats['comments_count'] }} komentar</span>
                            </div>
                            <div class="flex items-center space-x-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                <span>{{ $stats['views'] }} views</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Post Body -->
                <div class="prose max-w-none mb-6">
                    <p class="text-zinc-700 leading-relaxed whitespace-pre-wrap">{{ $post->body }}</p>
                </div>
            </div>

            <!-- Comments Section -->
            <div class="bg-white rounded-2xl shadow-lg border border-zinc-200 p-8">
                <h2 class="text-2xl font-bold text-primary mb-6">
                    Komentar ({{ $stats['comments_count'] }})
                </h2>

                @if($comments->count() > 0)
                    <div class="space-y-6">
                        @foreach($comments as $comment)
                            <div class="border-b border-zinc-200 pb-6 last:border-b-0 last:pb-0">
                                <!-- Comment -->
                                <div class="flex items-start space-x-4 mb-4">
                                    <div class="flex-shrink-0">
                                        @if($comment->user->profile_photo)
                                            <img src="{{ asset('storage/' . $comment->user->profile_photo) }}" alt="{{ $comment->user->name }}"
                                                 class="w-10 h-10 rounded-full object-cover ring-2 ring-white shadow">
                                        @else
                                            <div class="w-10 h-10 rounded-full bg-primary text-white flex items-center justify-center font-bold text-sm ring-2 ring-white shadow">
                                                {{ substr($comment->user->name, 0, 1) }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex items-center space-x-2 mb-2">
                                            <span class="font-semibold text-primary">{{ $comment->user->name }}</span>
                                            <span class="text-xs text-zinc-500">{{ $comment->created_at->diffForHumans() }}</span>
                                        </div>
                                        <p class="text-zinc-700 leading-relaxed">{{ $comment->body }}</p>
                                    </div>
                                </div>

                                <!-- Replies -->
                                @if($comment->replies->count() > 0)
                                    <div class="ml-14 space-y-4 mt-4 pl-4 border-l-2 border-zinc-200">
                                        @foreach($comment->replies as $reply)
                                            <div class="flex items-start space-x-4">
                                                <div class="flex-shrink-0">
                                                    @if($reply->user->profile_photo)
                                                        <img src="{{ asset('storage/' . $reply->user->profile_photo) }}" alt="{{ $reply->user->name }}"
                                                             class="w-8 h-8 rounded-full object-cover ring-2 ring-white shadow">
                                                    @else
                                                        <div class="w-8 h-8 rounded-full bg-secondary text-white flex items-center justify-center font-bold text-xs ring-2 ring-white shadow">
                                                            {{ substr($reply->user->name, 0, 1) }}
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="flex-1">
                                                    <div class="flex items-center space-x-2 mb-1">
                                                        <span class="font-semibold text-sm text-primary">{{ $reply->user->name }}</span>
                                                        <span class="text-xs text-zinc-500">{{ $reply->created_at->diffForHumans() }}</span>
                                                    </div>
                                                    <p class="text-sm text-zinc-700 leading-relaxed">{{ $reply->body }}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12">
                        <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-zinc-100 mb-4">
                            <svg class="w-10 h-10 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                        </div>
                        <p class="text-zinc-600">Belum ada komentar. Jadilah yang pertama berkomentar!</p>
                    </div>
                @endif

                <!-- Comment Form (Guest message) -->
                @guest
                    <div class="mt-8 p-6 bg-zinc-50 rounded-xl border border-zinc-200 text-center">
                        <p class="text-zinc-700 mb-4">Untuk berkomentar, silakan <a href="{{ route('login') }}" class="text-primary font-semibold hover:underline">masuk</a> terlebih dahulu.</p>
                    </div>
                @endguest
            </div>
        </div>
    </div>
</x-layouts.main>
