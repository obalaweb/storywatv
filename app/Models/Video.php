<?php

namespace App\Models;

use Awcodes\Curator\Models\Media;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Video extends Model
{
    protected $fillable = [
        'title',
        'description',
        'youtube_id', // Unique ID for the video on YouTube
        'youtube_url', // Full URL to the video on YouTube
        'thumbnail_url', // URL for the video thumbnail
        'duration', // Duration of the video in seconds
        'featured_image', // Optional field for a custom image
        'user_id', // Foreign key for the user who posted the video
        'category_id', // Foreign key for the video category
        'status', // Status of the video (e.g., active, inactive)
        'is_trending',
        'trending_score',
        'is_featured',
        'trending_since',
    ];

    protected $casts = [
        'tags' => 'array',
        'is_trending' => 'boolean',
        'is_featured' => 'boolean',
        'trending_since' => 'datetime',
    ];

    /**
     * Get the category that owns the video.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    /**
     * Returns the next video
     */
    public function nextVideo()
    {
        return $this->where('id', '>', $this->id)->where('status', 'active')->first();
    }

    /**
     * Returns the previous video
     */
    public function previousVideo()
    {
        return $this->where('id', '<', $this->id)->where('status', 'active')->orderBy('id', 'desc')->first();
    }

    /**
     * Get the user that posted the video.
     */
    public function postBy()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function getPostedOnAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->format('M d, Y');
    }

    /**
     * The tags that belong to the video.
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'video_tag');
    }
    public function markAsTrending($score)
    {
        $this->is_trending = true;
        $this->trending_score = $score;
        $this->trending_since = now();
        $this->save();
    }

    /**
     * Unmark the video as trending.
     */
    public function unmarkAsTrending()
    {
        $this->is_trending = false;
        $this->trending_score = null;
        $this->trending_since = null;
        $this->save();
    }

    /**
     * Check if the video is trending.
     */
    public function isCurrentlyTrending()
    {
        return $this->is_trending;
    }

    public function thumbnail()
    {

        return $this->belongsTo(Media::class, 'thumbnail_url', 'id');
    }


    protected static function boot()
    {
        parent::boot();

        static::saved(function () {
            Cache::forget('index_videos');
        });

        static::deleted(function () {
            Cache::forget('index_videos');
        });
    }

    public function getShortDescriptionAttribute()
    {
        $content = $this->attributes['description'];

        // Convert HTML entities like &nbsp; to normal characters
        $content = html_entity_decode($content);

        if (mb_strlen($content) > 98) {
            $description = mb_substr($content, 0, 98);
        } else {
            $description = $content;
        }

        // Remove HTML tags
        $description = strip_tags($description);

        return $description . '...';
    }

}


// $video = Video::find($videoId); // Assuming you have the video ID
// $video->markAsTrending(100); // Mark as trending with a score of 100

