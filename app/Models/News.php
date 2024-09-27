<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class News extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $dates = ['deleted_at'];

    public function tags()
    {
        return $this->belongsToMany(NewsTag::class, 'news_news_tag');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(NewsCategory::class);
    }

    public function seo()
    {
        return $this->morphOne(Seo::class, 'seoable');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($news) {
            if ($news->isForceDeleting()) {
                self::deleteImage($news->featured_image);
                if ($news->seo) {
                    self::deleteImage($news->seo->seo_featured_image);
                    self::deleteImage($news->seo->fb_featured_image);
                    self::deleteImage($news->seo->tw_featured_image);
                    $news->seo->delete();
                }
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
