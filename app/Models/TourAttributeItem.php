<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TourAttributeItem extends Model
{
    protected $fillable = ['tour_attribute_id', 'item'];

    public function tourAttributes()
    {
        return $this->belongsToMany(TourAttribute::class, 'tour_attribute_tour_attribute_item', 'tour_attribute_item_id', 'tour_attribute_id');
    }

    public function attributes()
    {
        return $this->belongsToMany(TourAttribute::class, 'tour_attribute_tour_attribute_item');
    }
}
