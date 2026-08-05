<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Blog extends Model
{
    use HasTranslations;

    protected $table = 'blog';

    protected $translatable = ['title', 'caption', 'content'];

    protected $fillable = [
        'date',
        'title',
        'slug',
        'img',
        'caption',
        'content',
        'status',
        'hit',
        'tags',
        'keyword',
        'id_category',
    ];

    public function category()
    {
        return $this->belongsTo(Kategori::class, 'id_category');
    }

    public function tags()
    {
        return $this->belongsToMany(Tags::class, 'blog_tags', 'blog_id', 'tag_id');
    }
}