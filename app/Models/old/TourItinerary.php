<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourItinerary extends Model
{
    use HasFactory;

    protected $table = 'tour_itineraries';

    protected $fillable = [
        'tour_id',
        'day',
        'title',
        'short_desc',
        'img_path',
    ];
}
