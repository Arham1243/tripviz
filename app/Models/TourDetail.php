<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourDetail extends Model
{
    use HasFactory;

    protected $fillable = ['tour_id', 'name', 'items'];

    protected $casts = [
        'items' => 'array',
    ];
}
