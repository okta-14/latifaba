<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupCompanies extends Model
{
    protected $table = 'group_companies';
    protected $fillable = [
    'title',
    'image',
    'url',
    'status',
];
}
