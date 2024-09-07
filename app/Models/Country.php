<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = ['name', 'continent_id', 'img_path', 'short_desc', 'slug', 'show_on_homepage'];

    public function continent()
    {
        return $this->belongsTo(Continent::class);
    }

    public function cities()
    {
        return $this->hasMany(City::class);
    }

    public function tours()
    {
        return Tour::whereHas('cities', function ($query) {
            $query->where('country_id', $this->id);
        })->where('tours.is_active', true);
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($country) {
            // Delete all related cities when the country is deleted
            $country->cities()->each(function ($city) {
                $city->delete();
            });
        });
    }
}
