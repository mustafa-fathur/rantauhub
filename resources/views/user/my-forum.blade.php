@extends('components.layouts.user.dashboard', ['title' => $title ?? 'Forum Saya'])

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex gap-6">
        <!-- Sidebar Card -->
        <x-user.sidebar :user="auth()->user()" />

        <!-- Main Content Area -->
        <main class="flex-1 min-w-0">
            <!-- Page Header -->
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-primary mb-2">Forum Aktivitas Saya</h1>
                <p class="text-zinc-600">Kelola postingan dan aktivitas forum Anda</p>
            </div>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                <div class="bg-white rounded-xl shadow-md border border-zinc-200 p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-zinc-600 mb-1">Postingan Saya</p>
                            <p class="text-2xl font-bold text-primary">{{ $stats['posts_count'] ?? 0 }}</p>
                        </div>
                        <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-md border border-zinc-200 p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-zinc-600 mb-1">Komentar Saya</p>
                            <p class="text-2xl font-bold text-primary">{{ $stats['comments_count'] ?? 0 }}</p>
                        </div>
                        <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-md border border-zinc-200 p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-zinc-600 mb-1">Post Disukai</p>
                            <p class="text-2xl font-bold text-primary">{{ $stats['liked_posts_count'] ?? 0 }}</p>
                        </div>
                        <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-primary" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-md border border-zinc-200 p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-zinc-600 mb-1">Total Engagement</p>
                            <p class="text-2xl font-bold text-primary">{{ $stats['total_engagement'] ?? 0 }}</p>
                        </div>
                        <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Activities -->
            <div class="bg-white rounded-xl shadow-md border border-zinc-200 p-6">
                <h2 class="text-xl font-bold text-primary mb-4">Aktivitas Terbaru</h2>

                @if(isset($activities) && $activities->count() > 0)
                    <div class="space-y-4">
                        @foreach($activities as $activity)
                            @if($activity['type'] === 'post')
                                @php $post = $activity['data']; @endphp
                                <div class="border-b border-zinc-200 pb-4 last:border-b-0">
                                    <div class="flex items-start justify-between">
                                        <div class="flex-1">
                                            <div class="flex items-center space-x-2 mb-2">
                                                <span class="px-2 py-1 bg-green-100 text-green-700 text-xs font-medium rounded">Postingan</span>
                                                <span class="text-xs text-zinc-500">{{ $activity['created_at']->diffForHumans() }}</span>
                                            </div>
                                            <a href="{{ route('forum.detail', $post->id) }}" class="block">
                                                <h3 class="text-lg font-bold text-primary mb-1 hover:text-primary-700">{{ $post->title }}</h3>
                                                <p class="text-sm text-zinc-600 mb-2 line-clamp-2">{{ \Illuminate\Support\Str::limit($post->body, 150) }}</p>
                                                <div class="flex items-center space-x-4 text-sm text-zinc-500">
                                                    <span class="text-primary font-medium">{{ $post->forum->title }}</span>
                                                    <span>{{ $activity['stats']['likes_count'] }} suka</span>
                                                    <span>{{ $activity['stats']['comments_count'] }} komentar</span>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @elseif($activity['type'] === 'comment')
                                @php $comment = $activity['data']; @endphp
                                <div class="border-b border-zinc-200 pb-4 last:border-b-0">
                                    <div class="flex items-start space-x-3">
                                        <div class="flex-shrink-0">
                                            @if($comment->user->profile_photo)
                                                <img src="{{ asset('storage/' . $comment->user->profile_photo) }}" alt="{{ $comment->user->name }}"
                                                     class="w-10 h-10 rounded-full object-cover">
                                            @else
                                                <div class="w-10 h-10 rounded-full bg-primary text-white flex items-center justify-center font-bold text-sm">
                                                    {{ substr($comment->user->name, 0, 1) }}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="flex-1">
                                            <div class="flex items-center space-x-2 mb-2">
                                                <span class="px-2 py-1 bg-blue-100 text-blue-700 text-xs font-medium rounded">Komentar</span>
                                                <span class="text-xs text-zinc-500">{{ $activity['created_at']->diffForHumans() }}</span>
                                            </div>
                                            <a href="{{ route('forum.detail', $comment->post->id) }}" class="block">
                                                <p class="text-zinc-700 mb-2">{{ \Illuminate\Support\Str::limit($comment->body, 100) }}</p>
                                                <p class="text-sm text-zinc-600">
                                                    pada postingan: <span class="font-medium text-primary">{{ $comment->post->title }}</span>
                                                    @if($activity['replies_count'] > 0)
                                                        · {{ $activity['replies_count'] }} balasan
                                                    @endif
                                                </p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @elseif($activity['type'] === 'liked')
                                @php $post = $activity['data']; @endphp
                                <div class="border-b border-zinc-200 pb-4 last:border-b-0">
                                    <div class="flex items-start space-x-3">
                                        <div class="flex-shrink-0">
                                            <svg class="w-10 h-10 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        <div class="flex-1">
                                            <div class="flex items-center space-x-2 mb-2">
                                                <span class="px-2 py-1 bg-red-100 text-red-700 text-xs font-medium rounded">Disukai</span>
                                                <span class="text-xs text-zinc-500">{{ $activity['created_at']->diffForHumans() }}</span>
                                            </div>
                                            <a href="{{ route('forum.detail', $post->id) }}" class="block">
                                                <h3 class="text-lg font-bold text-primary mb-1 hover:text-primary-700">{{ $post->title }}</h3>
                                                <p class="text-sm text-zinc-600 mb-2">
                                                    oleh <span class="font-medium">{{ $post->author->name }}</span>
                                                    · {{ $activity['stats']['likes_count'] }} suka
                                                    · {{ $activity['stats']['comments_count'] }} komentar
                                                </p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12">
                        <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-zinc-100 mb-4">
                            <svg class="w-10 h-10 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-zinc-900 mb-2">Belum Ada Aktivitas</h3>
                        <p class="text-zinc-600 mb-4">Mulai berpartisipasi di forum untuk melihat aktivitas Anda di sini</p>
                        <a href="{{ route('forum') }}" class="inline-flex items-center text-primary hover:text-primary-700 font-medium">
                            Jelajahi Forum
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                @endif
            </div>
        </main>
    </div>
</div>
@endsection
