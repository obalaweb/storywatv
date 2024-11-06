<?php

namespace App\Models;

use Awcodes\Curator\Models\Media;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Podcast extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'host',
        'episode_count',
        'published_at',
        'audio_url',
        'thumbnail',
    ];

    /**
     * Casts for attribute types.
     *
     * @var array
     */
    protected $casts = [
        'published_at' => 'date',
        'episode_count' => 'integer',
    ];

    public function media()
    {
        return $this->belongsTo(Media::class, 'thumbnail', 'id');
    }
}
