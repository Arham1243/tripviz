<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Section extends Model
{
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    public function pages()
    {
        return $this->belongsToMany(Page::class, 'page_section')
            ->withPivot('id', 'order', 'created_at', 'updated_at');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($item) {
            self::deleteImage($item->preview_image);
        });
    }

    public static function deleteImage($path)
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
