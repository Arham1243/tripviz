<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Config extends Model
{

    protected $table = 'configs';

    protected $fillable = [
        'flag_type',
        'flag_value',
        'is_active',
    ];

}
