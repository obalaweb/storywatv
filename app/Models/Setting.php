<?php

namespace App\Models;

use Awcodes\Curator\Models\Media;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'site_name',
        'site_tagline',
        'site_logo',
        'site_icon',
        'site_email',
        'site_phone',
        'address',
        'facebook_link',
        'twitter_link',
        'instagram_link',
        'google_analytics_id',
    ];

    public function logo()
    {
        return $this->belongsTo(Media::class, 'site_logo', 'id');
    }

    public function icon()
    {
        return $this->belongsTo(Media::class, 'site_icon', 'id');
    }
}
