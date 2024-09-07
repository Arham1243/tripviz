<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourReview extends Model
{
    use HasFactory;

    protected $table = 'tour_reviews';

    protected $fillable = [
        'tour_id',
        'user_id',
        'title',
        'review',
        'rating',
    ];

    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
