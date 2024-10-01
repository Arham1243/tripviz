<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Country extends Model
{
    use SoftDeletes;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function cities()
    {
        return $this->hasMany(City::class);
    }

    public function tours()
    {
        return Tour::whereHas('cities', function ($query) {
            $query->where('country_id', $this->id);
        })->where('tours.is_active', true);
    }

    public function seo()
    {
        return $this->morphOne(Seo::class, 'seoable');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($item) {
            if ($item->isForceDeleting()) {
                self::deleteImage($item->featured_image);
                if ($item->seo) {
                    self::deleteImage($item->seo->seo_featured_image);
                    self::deleteImage($item->seo->fb_featured_image);
                    self::deleteImage($item->seo->tw_featured_image);
                    $item->seo->delete();
                }
                $item->cities()->each(function ($city) {
                    $city->delete();
                });
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
