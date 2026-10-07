<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    protected $table = 'foto';

    protected $fillable = [
        'id_album',
        'img',
    ];

    public function album()
    {
        return $this->belongsTo(Album::class,'id_album');
    }
}