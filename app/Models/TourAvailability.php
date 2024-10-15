<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourAvailability extends Model
{
    use HasFactory;

    protected $fillable = [
        'tour_id',
        'is_fixed_date',
        'start_date',
        'end_date',
        'last_booking_date',
        'is_open_hours',
    ];

    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }

    public function openHours()
    {
        return $this->hasMany(TourOpenHour::class);
    }
}
