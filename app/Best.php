<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Best extends Model
{
    protected $fillable = [
        'name', 'code', 'end_year', 'job', 'business', 'study', 'tech', 'army', 'abroad', 'child', 'work'
    ];
}
