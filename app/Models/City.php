<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = ['name', 'country_id', 'show_on_homepage', 'img_path', 'slug', 'short_desc'];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function tours()
    {
        return $this->belongsToMany(Tour::class, 'city_tour')
            ->where('tours.is_active', true);
    }
}
