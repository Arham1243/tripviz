<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Continent extends Model
{

    protected $fillable = ['name'];

    public function countries()
    {
        return $this->hasMany(Country::class);
    }
    
    
     protected static function boot()
    {
        parent::boot();

        static::deleting(function ($continent) {
            $continent->countries()->each(function ($country) {
                $country->delete();
            });
        });
    }
}
