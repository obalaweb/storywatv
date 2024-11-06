<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class WebController extends Controller
{
    public function index()
    {
        $videos = Cache::remember('index_videos', 36000, function () {
            return Video::latest()->where('is_active', true)->where('trending_score', '>', 70)->paginate(8);
        });


        return view('frontend.index', compact('videos'));
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
        return view('blog.index');
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
}
