<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourAvailability extends Model
{
    use HasFactory;

    protected $fillable = [
        'tour_id',
        'date_range',
        'available_for_booking',
        'max_guest',
        'min_adult',
        'max_adult',
        'adult_price',
        'min_child',
        'max_child',
        'child_price',
    ];

    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }
}
