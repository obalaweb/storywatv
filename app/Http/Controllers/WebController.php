<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Movie;
use App\Models\Video;
use Firefly\FilamentBlog\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class WebController extends Controller
{
    public function index()
    {
        $videos = Cache::remember('index_videos', 36000, function () {
            return Video::latest()->where('status', 'active')->where('is_trending', 1)->take(8)->get();
        });

        $otherVideos = Cache::remember('index_other_videos', 36000, function () {
            return Video::latest()->where('status', 'active')->where('is_trending', 0)->take(6)->get();
        });
        $categories = Cache::remember('index_categories', 36000, function () {
            return Category::latest()->withCount('videos')->take(6)->get();
        });

        $featuredVideo = Cache::remember('featured_video', 36000, function () {
            return Video::where('is_featured', 1)->first();
        });

        $posts = Cache::remember('index_posts', 36000, function () {
            return Post::latest()->take(9)->get();
        });

        return view('frontend.index', compact('videos', 'categories', 'otherVideos', 'featuredVideo', 'posts'));
    }

    public function contactUs()
    {
        return view('frontend.contactUs');
    }

    public function aboutUs()
    {
        return view('frontend.aboutUs');
    }

    public function blog()
    {
        $posts = Post::latest()->paginate(4);
        return view('blog.index', compact('posts'));
    }


    public function movies()
    {
        $movies = Movie::paginate(8);
        return view('frontend.movies', compact('movies'));
    }

    public function showMovie(Movie $movie)
    {
        return view('movies.show', compact('movie'));
    }


    public function videos()
    {
        return view('videos.index');
    }

    public function showVideo(Video $video)
    {
        $nextVideo = $video->nextVideo();
        $previousVideo = $video->previousVideo();
        $relatedVideos = Video::where('category_id', $video->category_id)->where('id', '!=', $video->id)->take(6)->get();
        return view('videos.show', compact('video', 'previousVideo', 'nextVideo', 'relatedVideos'));
    }


    public function submitVideo()
    {
        return view('frontend.submitVideo');
    }
}
