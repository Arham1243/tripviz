<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToursFaq extends Model
{
    use HasFactory;
    
    protected $table = 'tours_faqs';
    
     protected $fillable = [
        'question',
        'answer',
        'tour_id',
    ];
    
      public function tour()
    {
        return $this->belongsTo(Tour::class, 'tour_id');
    }
}
