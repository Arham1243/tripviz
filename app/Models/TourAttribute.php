<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourAttribute extends Model
{
    use HasFactory;

    protected $table = 'tour_attributes';

    protected $fillable = [
        'tour_id',
        'title',
        'icon_class',
    ];
}
