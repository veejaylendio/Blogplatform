<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $fillable = [
        'company_name',
        'job_title',
        'currently_working',
        'start_date',
        'end_date',
        'description'
    ];
}
