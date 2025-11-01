<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use App\Models\PostLike;
use Illuminate\View\View;

class ForumController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();

        // Get user's posts
        $myPosts = Post::with(['forum', 'tags', 'likes', 'comments'])
            ->where('posted_by', $user->id)
            ->latest()
            ->get()
            ->map(function ($post) {
                return [
                    'type' => 'post',
                    'data' => $post,
                    'created_at' => $post->created_at,
                    'stats' => [
                        'likes_count' => $post->likes->count(),
                        'comments_count' => $post->comments->count(),
                    ],
                ];
            });

        // Get user's comments
        $myComments = Comment::with(['post.forum', 'post.author', 'replies'])
            ->where('user_id', $user->id)
            ->latest()
            ->get()
            ->map(function ($comment) {
                return [
                    'type' => 'comment',
                    'data' => $comment,
                    'created_at' => $comment->created_at,
                    'replies_count' => $comment->replies->count(),
                ];
            });

        // Get posts liked by user
        $userLikes = PostLike::with(['post.forum', 'post.tags', 'post.likes', 'post.comments', 'post.author'])
            ->where('user_id', $user->id)
            ->latest('created_at')
            ->get()
            ->map(function ($like) {
                $post = $like->post;
                return [
                    'type' => 'liked',
                    'data' => $post,
                    'created_at' => $like->created_at,
                    'stats' => [
                        'likes_count' => $post->likes->count(),
                        'comments_count' => $post->comments->count(),
                    ],
                ];
            });

        // Combine and sort by created_at
        $activities = collect()
            ->merge($myPosts)
            ->merge($myComments)
            ->merge($userLikes)
            ->sortByDesc('created_at')
            ->values();

        // Statistics
        $stats = [
            'posts_count' => $myPosts->count(),
            'comments_count' => $myComments->count(),
            'liked_posts_count' => $userLikes->count(),
            'total_engagement' => $myPosts->sum(fn($p) => $p['stats']['likes_count'] + $p['stats']['comments_count']),
        ];

        return view('user.my-forum', [
            'title' => 'Forum Saya',
            'activities' => $activities,
            'stats' => $stats,
        ]);
    }
}
