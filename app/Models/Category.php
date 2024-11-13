<?php

namespace App\Models;

use Awcodes\Curator\Models\Media;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = ['name', 'description', 'thumbnail', 'slug'];

    public function videos()
    {
        return $this->hasMany(Video::class, 'category_id', 'id');
    }

    public function image()
    {
        return $this->belongsTo(Media::class, 'thumbnail', 'id');
    }



    protected static function boot()
    {
        parent::boot();

        static::saved(function () {
            Cache::forget('index_categories');
        });

        static::deleted(function () {
            Cache::forget('index_categories');
        });
    }
}
