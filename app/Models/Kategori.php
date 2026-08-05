<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori';

    protected $fillable = [
        'title',
        'slug',
    ];

    public function blogs()
    {
        return $this->hasMany(Blog::class, 'id_category');
    }
}