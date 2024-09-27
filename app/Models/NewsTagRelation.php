<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsTagRelation extends Model
{
    use HasFactory;

    protected $table = 'news_news_tag';

    public $timestamps = true;

    protected $fillable = [
        'news_id',
        'news_tag_id',
    ];

    public function news()
    {
        return $this->belongsTo(News::class);
    }

    public function tag()
    {
        return $this->belongsTo(NewsTag::class, 'news_tag_id');
    }
}
