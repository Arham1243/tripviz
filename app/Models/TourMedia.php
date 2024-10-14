<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourMedia extends Model
{
    use HasFactory;

    protected $fillable = ['tour_id', 'image_path', 'alt_text'];

    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }
}
