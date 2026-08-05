<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Service extends Model
{

    use HasTranslations;
    public $translatable = ['title', 'short', 'content'];
    protected $table = 'service';
    
    protected $fillable =[
        'title',
        'short',
        'content',
        'icon',
        'img',
        'status',
        'slug',
        'url',
    ];

      public function programs()
    {
        return $this->hasMany(Program::class, 'id_service');
    }
}
