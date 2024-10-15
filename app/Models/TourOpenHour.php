<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourOpenHour extends Model
{
    use HasFactory;

    protected $fillable = [
        'tour_availability_id',
        'day',
        'open_time',
        'close_time',
        'close_time',
        'enabled',
    ];

    public function tourAvailability()
    {
        return $this->belongsTo(TourAvailability::class);
    }
}
