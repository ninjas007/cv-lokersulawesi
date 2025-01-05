<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends Model
{
    use SoftDeletes;

    protected $table = 'jobs';

    protected $fillable = [
        'slug',
        'title',
        'company_name',
        'location',
        'image',
        'job_types',
        'salary',
        'status',
        'publish_on',
        'publish_on_date',
        'description',
    ];
}
