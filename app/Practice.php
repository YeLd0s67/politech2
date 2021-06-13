<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Practice extends Model
{
    protected $fillable = [
        'speciality', 'year', 'semester', 'group', 'practice', 'practice_type', 'advisor'
    ];
}
