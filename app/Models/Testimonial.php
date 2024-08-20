<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        "title",
        "content",
        "rating",
        "main_img_path",
    ];

    public function images()
    {
        return $this->hasMany(TestimonialImage::class);
    }


    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($testimonial) {
            $testimonial->images()->each(function ($image) {
                $image->delete();
            });
        });
    }
}
