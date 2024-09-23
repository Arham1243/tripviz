<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogTagRelation extends Model
{
    use HasFactory;

    protected $table = 'blog_tag';

    public $timestamps = true;

    protected $fillable = [
        'blog_id',
        'blog_tag_id',
    ];

    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }

    public function tag()
    {
        return $this->belongsTo(BlogTag::class, 'blog_tag_id');
    }
}
