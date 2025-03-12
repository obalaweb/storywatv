<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::latest()->paginate(12);
        return view('videos.index', compact('videos'));
    }

    public function show(Video $video)
    {
        $nextVideo = $video->nextVideo();
        $previousVideo = $video->previousVideo();
        $relatedVideos = Video::where('category_id', $video->category_id)->where('id', '!=', $video->id)->take(6)->get();

        return view('videos.show', compact('video', 'previousVideo', 'nextVideo', 'relatedVideos'));
    }

    public function category()
    {
        return view('videos.category');
    }
}
