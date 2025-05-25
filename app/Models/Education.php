<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $fillable = [
        'institution_name',
        'degree_name',
        'date',
        'description'
    ];
}
