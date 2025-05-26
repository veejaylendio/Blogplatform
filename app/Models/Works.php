<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Works extends Model
{
    protected $fillable = [
        'works_header',
        'works_image',
        'works_title',
        'works_project_type',
        'works_url',
        'works_description',
    ];
}
