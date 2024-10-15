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

    public function attributeItems()
    {
        return $this->hasMany(TourAttributeItem::class);
    }

    public function tours()
    {
        return $this->belongsToMany(Tour::class, 'tour_attribute_tour_attribute_item')
            ->withPivot('tour_attribute_item_id')
            ->withTimestamps();
    }
}
