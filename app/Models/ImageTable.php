<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageTable extends Model
{
    protected $table = 'imagetables';
    protected $fillable = [
        'table_name',
        'img_path',
        'heading',
        'sub_heading',
        'short_desc',
        'is_active',
    ];

}
