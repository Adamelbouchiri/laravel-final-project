<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class userCourses extends Model
{
    protected $fillable = [
        'user_id',
        'course_id',
        'completed',
    ];
}
