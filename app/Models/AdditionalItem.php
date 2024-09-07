<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdditionalItem extends Model
{
    use HasFactory;

    protected $table = 'additional_items';

    protected $fillable = [
        'tour_id',
        'additional_id',
        'title',
    ];

    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }

    public function additional()
    {
        return $this->belongsTo(ToursAdditional::class, 'additional_id');
    }
}
