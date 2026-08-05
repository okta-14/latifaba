<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Tags extends Model
{
    use HasTranslations;

    protected $table = 'tags';

    protected $translatable = ['title'];

    protected $fillable = [
        'title',
        'slug',
        'hit',
    ];

    public function blogs()
    {
        return $this->belongsToMany(Blog::class, 'blog_tags', 'tag_id', 'blog_id');
    }
}