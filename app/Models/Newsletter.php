<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
    
    protected $table = 'newsletters';

    protected $fillable = [
        'email',
        'is_active',
    ];
}
