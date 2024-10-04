<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TourAttribute extends Model
{
    use SoftDeletes;

    protected $table = 'tour_attributes';

    protected $fillable = [
        'name',
        'status',
        'items',
    ];
}
