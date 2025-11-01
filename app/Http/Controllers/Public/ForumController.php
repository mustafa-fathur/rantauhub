<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Forum;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ForumController extends Controller
{
    /**
     * Show list of forum posts
     */
    public function index(Request $request): View
    {
        $query = Post::with([
            'author',
            'forum',
            'likes',
            'comments',
            'tags',
        ])
        ->where(function ($q) {
            $q->where('status', 'published')
              ->orWhereNull('status');
        });

        // Filter by forum category
        if ($request->has('forum') && $request->forum) {
            $query->where('forum_id', $request->forum);
        }

        // Search by title or body
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('body', 'like', "%{$search}%");
            });
        }

        // Sort
        $sort = $request->get('sort', 'latest');
        switch ($sort) {
            case 'latest':
                $query->latest();
                break;
            case 'popular':
                $query->withCount('likes')
                    ->orderBy('likes_count', 'desc');
                break;
            case 'most_commented':
                $query->withCount('comments')
                    ->orderBy('comments_count', 'desc');
                break;
        }

        $posts = $query->paginate(10);

        // Get all forums for sidebar
        $forums = Forum::withCount('posts')->get();

        // Calculate stats for each post
        $posts->getCollection()->transform(function ($post) {
            $post->stats = [
                'likes_count' => $post->likes->count(),
                'comments_count' => $post->comments->count(),
                'views' => rand(50, 500), // TODO: Add views tracking
            ];
            return $post;
        });

        return view('forum', [
            'posts' => $posts,
            'forums' => $forums,
            'selectedForum' => $request->forum,
            'search' => $request->search,
            'sort' => $sort,
        ]);
    }

    /**
     * Show detail of a specific post with comments and replies
     */
    public function show($id): View
    {
        $post = Post::with([
            'author',
            'forum',
            'likes.user',
            'tags',
            'comments.user',
            'comments.replies.user',
        ])
        ->where(function ($q) {
            $q->where('status', 'published')
              ->orWhereNull('status');
        })
        ->findOrFail($id);

        // Get comments with replies sorted by created_at
        $comments = $post->comments()
            ->with(['user', 'replies.user'])
            ->latest()
            ->get();

        // Calculate stats
        $stats = [
            'likes_count' => $post->likes->count(),
            'comments_count' => $post->comments->count(),
            'views' => rand(100, 1000), // TODO: Add views tracking
        ];

        return view('forum-detail', [
            'post' => $post,
            'comments' => $comments,
            'stats' => $stats,
        ]);
    }
}
