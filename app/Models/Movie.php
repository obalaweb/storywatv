<?php

namespace App\Models;

use Awcodes\Curator\Models\Media;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'genre',
        'release_date',
        'duration',
        'price',
        'is_available',
        'feature_image',
        'trailer_url',
        'rating',
        'language',
        'country',
        'director',
        'cast',
        'views',
        'slug',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'release_date' => 'date',
        'duration' => 'integer',
        'price' => 'decimal:2',
        'is_available' => 'boolean',
        'rating' => 'decimal:1',
        'views' => 'integer',
        'cast' => 'array',
    ];

    /**
     * Scope a query to only include available movies.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAvailable($query)
    {
        return $query->where('is_available', true);
    }

    /**
     * Accessor for formatted price.
     *
     * @return string
     */
    public function getFormattedPriceAttribute()
    {
        return 'Ugx ' . number_format($this->price, 2);
    }

    /**
     * Mutator to capitalize the movie title.
     *
     * @param  string  $value
     * @return void
     */
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = ucwords($value);
    }

    public function thumbnail()
    {
        return $this->belongsTo(Media::class, 'feature_image', 'id');
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
