<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{

    protected $fillable = ['name', 'continent_id'];

    public function continent()
    {
        return $this->belongsTo(Continent::class);
    }

    public function cities()
    {
        return $this->hasMany(City::class);
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
