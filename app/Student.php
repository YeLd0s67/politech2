<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Student extends Model
{
    use Notifiable;
    
    protected $fillable = [
        'iin', 'first_name', 'middle_name', 'last_name', 'date_birth', 'gender', 'citizen', 'nation',
        'spec', 'group', 'passport', 'passport_given','address', 'phone', 'school', 
        'lang', 'family_children', 'clubs', 'parent_names', 'work', 
        'parent_passport', 'parent_iin', 'status'
    ];

}
