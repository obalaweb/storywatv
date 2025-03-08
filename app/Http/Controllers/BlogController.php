<?php

namespace App\Http\Controllers;

use Firefly\FilamentBlog\Enums\PostStatus;
use Firefly\FilamentBlog\Models\Category;
use Firefly\FilamentBlog\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {

        $posts = Post::published()->latest()->paginate(4);

        return view('blog.index', compact('posts'));
    }

    public function show(Post $post)
    {
        $post->load(['user', 'tags', 'comments']);

        $previousPost = Post::where('published_at', '<', $post->published_at)
            ->where('status', PostStatus::PUBLISHED)
            ->orderBy('published_at', 'desc')
            ->first();

        $nextPost = Post::where('published_at', '>', $post->published_at)
            ->where('status', PostStatus::PUBLISHED)
            ->orderBy('published_at', 'asc')
            ->first();

        $categories = Category::withCount('posts')->get();
        $popularPosts = Post::published()->orderBy('views', 'desc')->take(3)->get();

        return view('blog.show', compact('post', 'previousPost', 'nextPost', 'categories', 'popularPosts'));
    }
}
