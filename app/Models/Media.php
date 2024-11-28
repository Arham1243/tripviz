<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $fillable = ['file_path', 'alt_text'];

    public function mediable()
    {
        return $this->morphTo();
    }
}
