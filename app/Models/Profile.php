<?php

namespace App\Models;

use App\Models\Traits\HasUser;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasUser;

    protected $fillable = [
        'user_id',
        'contact_number',
        'address',
        'city',
        'state',
        'weight',
        'height',
        'bmi',
        'date_of_birth',
        'gender',
        'country',
        'postcode',
        'newsletter'
    ];

}