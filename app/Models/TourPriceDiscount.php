<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourPriceDiscount extends Model
{
    use HasFactory;

    protected $fillable = [
        'tour_id',
        'people_from',
        'people_to',
        'amount',
        'type',
    ];

    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }
}
