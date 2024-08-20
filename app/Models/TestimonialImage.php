<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestimonialImage extends Model
{
    use HasFactory;
    protected $fillable = [
        "testimonial_id",
        "img_path",
    ];

    public function testimonial()
    {
        return $this->belongsTo(Testimonial::class);
    }
}
