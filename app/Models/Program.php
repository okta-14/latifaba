<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Program extends Model
{
    use HasTranslations;

    protected $table = 'program';

    protected $translatable = [
        'title',
        'content',
    ];

    protected $fillable = [
        'date',
        'title',
        'img',
        'content',
        'status',
        'url',
        'lokasi',
        'slug',
        'hit',
        'id_category',
        'id_service',
    ];

    public function category()
    {
        return $this->belongsTo(KategoriProject::class, 'id_category');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'id_service');
    }
    public function fotos()
    {
        return $this->hasMany(ProjectFoto::class, 'id_project');
    }
}