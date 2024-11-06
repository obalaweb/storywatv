<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name'];

    /**
     * The videos that belong to the tag.
     */
    public function videos()
    {
        return $this->belongsToMany(Video::class, 'video_tag');
    }
}
