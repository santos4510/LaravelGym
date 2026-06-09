<?php

namespace App\\Models;

use Illuminate\\Database\\Eloquent\\Factories\\HasFactory;
use Illuminate\\Database\\Eloquent\\Model;

class Attendance extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected \ = [
        'user_id',
        'date',
    ];

    /**
     * Get the user that owns the attendance.
     */
    public function user()
    {
        return \->belongsTo(User::class);
    }
}
