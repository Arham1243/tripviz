<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsTag extends Model
{
    protected $table = 'news_tags';

    protected $fillable = [
        'name',
        'slug',
        'is_active',
    ];
}
