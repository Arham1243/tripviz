<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class NewsTag extends Model
{
    protected $table = 'news_tags';

    protected $fillable = [
        'name',
        'slug',
        'is_active',
    ];

    public function seo()
    {
        return $this->morphOne(Seo::class, 'seoable');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($tag) {
            if ($tag->seo) {
                self::deleteImage($tag->seo->seo_featured_image);
                self::deleteImage($tag->seo->fb_featured_image);
                self::deleteImage($tag->seo->tw_featured_image);
                $tag->seo->delete();
            }
        });
    }

    public static function deleteImage($path)
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
