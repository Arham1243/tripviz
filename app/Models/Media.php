<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Media extends Model
{
    protected $fillable = ['file_path', 'alt_text'];

    public function mediable()
    {
        return $this->morphTo();
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
            self::deleteImage($item->file_path);
        });
    }
}
