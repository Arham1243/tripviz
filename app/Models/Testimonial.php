<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Testimonial extends Model
{
    use SoftDeletes;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function media()
    {
        return $this->morphMany(Media::class, 'mediable');
    }

    public static function deleteImage($path)
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }

    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($item) {
            if ($item->isForceDeleting()) {
                $item->media()->each(function ($media) {
                    $media->forceDelete();
                });
                self::deleteImage($item->featured_image);
            }
        });
    }
}
