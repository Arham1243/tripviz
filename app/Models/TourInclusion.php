<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourInclusion extends Model
{
    use HasFactory;

    protected $table = 'tour_inclusions';

    protected $fillable = [
        'title',
        'tour_id',
    ];
}
