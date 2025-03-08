<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Movie;
use App\Models\Setting;
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

        $settings = Setting::firstOrCreate([], [
            'site_name' => 'Your Site Name',
            'site_tagline' => 'Building amazing experiences.',
        ]);

        $stats = [
            ['value' => 154879, 'label' => 'Visitors'],
            ['value' => 254879, 'label' => 'Downloads'],
            ['value' => 1548, 'label' => 'Trailers'],
            ['value' => 4.9, 'label' => 'Rating'],
        ];

        $videos = [
            ['title' => 'Intro Video', 'thumbnail' => asset('assets/images/about-01.jpg'), 'url' => 'https://www.youtube.com/watch?v=NEqtQYxzQaE'],
            // Add more videos
        ];

        $services = [
            ['title' => 'Film Production', 'description' => 'Lorem ipsum dolor sit amet...', 'icon' => asset('assets/images/icon-box-01.png')],
            // Add more services
        ];

        $partners = [
            ['name' => 'Partner 1', 'logo' => asset('assets/images/brand-06.png')],
            // Add more partners
        ];

        $teamMembers = [
            ['name' => 'John Doe', 'role' => 'Director', 'photo' => asset('assets/images/team-01.jpg'), 'twitter' => '#', 'linkedin' => '#'],
            // Add more team members
        ];

        return view('frontend.aboutUs', compact('settings', 'stats', 'videos', 'services', 'partners', 'teamMembers'));
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
