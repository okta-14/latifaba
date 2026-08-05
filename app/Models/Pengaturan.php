<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Pengaturan extends Model
{
    use HasTranslations;

    public $translatable = ['address'];

    protected $table = 'pengaturan';

    protected $fillable = [
        'company',
        'address',
        'phone',
        'fax',
        'email',
        'website',
        'map',
        'script',
        'intro',
        'cek',
        'url_popup',
        'header',
        'favicon',
        'popup',
        'background',
        'copyright',
        'meta_title',
        'meta_description',
        'meta_keyword',
        'seo',
        'background_intro',
        'logo',
        'catalog',
        'member',
    ];
}