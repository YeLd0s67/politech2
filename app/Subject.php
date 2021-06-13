<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = [
        'speciality', 'year', 'semester', 'group', 'subject', 'exam', 'bakylau', 'course_job'
    ];
}
