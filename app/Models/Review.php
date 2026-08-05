<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'review';

    protected $fillable = [
        'nama',
        'pekerjaan',
        'review',
        'stars',
        'status',
    ];

    protected $casts = [
        'pekerjaan' => 'array',
        'review' => 'array',
    ];
}