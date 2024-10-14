<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToursAdditional extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function additionalItems()
    {
        return $this->hasMany(AdditionalItem::class, 'additional_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($additional) {
            $additional->additionalItems()->each(function ($item) {
                $item->delete();
            });
        });
    }
}
