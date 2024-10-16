<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourExtraPrice extends Model
{
    use HasFactory;
    protected $fillable = [
        'tour_id',
        'name',
        'price',
        'type',
        'is_per_person',
    ];

    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }
}
