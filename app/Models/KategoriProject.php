<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriProject extends Model
{
    protected $table = 'kategori_project';

    protected $fillable =[
        'title',
        'slug',
    ];

    public function programs()
        {
            return $this->hasMany(Program::class, 'id_category');
        }
}
