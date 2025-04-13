<?php

namespace App\Livewire;

use App\Models\Video;
use Livewire\Component;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class VideoPlayer extends Component
{
    public $currentVideo;
    public $nextVideo = null;

    public function mount(Video $video = null)
    {
        Log::info('VideoPlayer mounted');

        if (!$video) {
            Log::info('No video provided, getting scheduled or random featured video');
            $video = $this->getInitialVideo();
        } else {
            Log::info('Video provided: ' . $video->title);
        }

        $this->currentVideo = $video;
        $this->prepareNextVideo();
    }

    private function getInitialVideo()
    {
        // First try to get currently scheduled video
        $scheduledVideo = Video::currentlyScheduled()->first();
        if ($scheduledVideo) {
            Log::info('Found currently scheduled video: ' . $scheduledVideo->title);
            return $scheduledVideo;
        }

        // If no scheduled video, get next scheduled video
        $nextScheduledVideo = Video::nextScheduled()->first();
        if ($nextScheduledVideo) {
            Log::info('Found next scheduled video: ' . $nextScheduledVideo->title);
            return $nextScheduledVideo;
        }

        // If no scheduled videos, get random featured video
        Log::info('No scheduled videos found, getting random featured video');
        return $this->getRandomFeaturedVideo();
    }

    public function prepareNextVideo()
    {
        Log::info('Preparing next video');

        // First check if current video is scheduled and still within its time range
        if ($this->currentVideo->is_scheduled && $this->isVideoWithinSchedule($this->currentVideo)) {
            Log::info('Current video is scheduled and within time range, will repeat');
            $this->nextVideo = $this->currentVideo;
            return;
        }

        // Check for next scheduled video
        $nextScheduledVideo = Video::nextScheduled()->first();
        if ($nextScheduledVideo) {
            Log::info('Found next scheduled video: ' . $nextScheduledVideo->title);
            $this->nextVideo = $nextScheduledVideo;
            return;
        }

        // If no scheduled videos, get random featured video
        Log::info('No scheduled videos found, getting random featured video');
        $this->nextVideo = $this->getRandomFeaturedVideo();
    }

    private function isVideoWithinSchedule($video)
    {
        if (!$video->is_scheduled) {
            return false;
        }

        $now = now();
        return $now >= $video->scheduled_start_time && $now <= $video->scheduled_end_time;
    }

    public function transitionToNextVideo()
    {
        Log::info('Transition to next video called');

        if ($this->nextVideo) {
            Log::info('Transitioning to next video: ' . $this->nextVideo->title);
            $this->currentVideo = $this->nextVideo;
            $this->nextVideo = null;  // Reset next video to avoid reusing it
        } else {
            Log::info('No next video, repeating current video: ' . ($this->currentVideo ? $this->currentVideo->title : 'Unknown'));
            // No change to currentVideo, it will repeat
        }

        // Prepare the next video for future transitions
        $this->prepareNextVideo();

        Log::info('Transition completed, next video prepared');
    }

    private function getRandomFeaturedVideo()
    {
        Log::info('Getting random featured video');

        $videos = $this->getFeaturedVideos();
        if ($videos->count() === 0) {
            Log::warning('No featured videos available for initial load');
            return null;
        }

        // Filter out scheduled videos that are not currently active
        $availableVideos = $videos->filter(function ($video) {
            if ($video->is_scheduled) {
                return $this->isVideoWithinSchedule($video);
            }
            return true;
        });

        if ($availableVideos->isEmpty()) {
            Log::warning('No available videos after filtering scheduled ones');
            return null;
        }

        $video = $availableVideos->random();
        Log::info('Initial video selected: ' . $video->title);
        return $video;
    }

    private function getFeaturedVideos()
    {
        Log::info('Fetching featured videos from cache');

        return Cache::remember('featured_videos', 3600, function () {
            $videos = Video::where('is_featured', 1)->get();
            Log::info('Found ' . $videos->count() . ' featured videos');
            return $videos;
        });
    }

    public function render()
    {
        return view('livewire.video-player');
    }
}
