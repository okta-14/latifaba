<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectFoto extends Model
{
    protected $table = 'project_foto';

    protected $fillable = [
        'id_project',
        'img',
    ];

    
    public function program()             
    {
        return $this->belongsTo(Program::class, 'id_project');  
    }
}