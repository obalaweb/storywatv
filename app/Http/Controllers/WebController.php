<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Movie;
use App\Models\Video;
use Firefly\FilamentBlog\Models\Post;
use Illuminate\Contracts\View\View;
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

        $featuredVideo = $this->nextVideo();

        $posts = Cache::remember('index_posts', 36000, function () {
            return Post::latest()->take(9)->get();
        });


        return view('frontend.index', compact('videos', 'categories', 'otherVideos', 'featuredVideo', 'posts'));
    }

    public function contactUs(): View
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


    public function playNext()
    {
        $video = cache()->get('featuredVideo');
        cache()->forget('featuredVideo');

        $nextVideo = $this->nextVideo($video);

        // Return a JSON response with the video ID.
        return response()->json(['videoId' => $nextVideo->youtube_id]);
    }

    private function nextVideo($oldVideo = null)
    {
        // Retrieve the list of featured videos from cache (or database)
        $videos = cache()->remember('videos', 3600, function () {
            return Video::where('is_featured', 1)->get();
        });

        $videos = collect($videos);
        $videosCount = $videos->count();

        // If there are no videos, you might want to handle this scenario separately.
        if ($videosCount === 0) {
            // Optionally, return null or throw an exception
            return null;
        }

        if ($oldVideo) {
            // Find the index of the current video.
            $currentIndex = $videos->search(fn($v) => $v->id === $oldVideo->id);

            // If for any reason the old video is not found, start from the beginning.
            if ($currentIndex === false) {
                $currentIndex = 0;
            }

            // Calculate next index using modulo to loop back to the beginning.
            $nextIndex = ($currentIndex + 1) % $videosCount;
            $nextVideo = $videos->get($nextIndex);
        } else {
            // If no old video provided, it picks random video.
            $nextVideo = $videos->random();

        }

        // Update the cache with the selected video.
        cache()->put('featuredVideo', $nextVideo, 3600);

        return $nextVideo;
    }

}
