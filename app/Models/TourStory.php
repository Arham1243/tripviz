<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourStory extends Model
{
    use HasFactory;

    protected $table = 'tour_stories';

    protected $fillable = [
        "title",
        "slug",
        "short_desc",
        "long_desc",
        "estimated_read_time",
        "img_path",
        "city_id",
        "is_active",
        "show_on_homepage",
    ];


    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
