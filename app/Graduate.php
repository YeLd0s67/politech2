<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Graduate extends Model
{
    protected $fillable = [
        'iin', 'first_name', 'middle_name', 'last_name', 'date_birth', 'gender', 'nation',
        'spec_code', 'spec', 'group', 'grant','company', 'study', 'university', 
        'study_type', 'university_year', 'work', 'army', 'abroad', 
        'child', 'unemployed', 'address', 'email', 'phone', 'business', 'end_year'
    ];
}
