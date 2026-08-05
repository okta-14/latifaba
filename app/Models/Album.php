<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
      protected $table = 'album';
    protected $fillable =[
                
        'title',
        'img',
        'hit',
        'slug',
        'date',
        'status',
    ];

     public function fotos()
    {
        return $this->hasMany(Foto::class, 'id_album');
    }
}
