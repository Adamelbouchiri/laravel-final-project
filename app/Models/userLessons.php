<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class userLessons extends Model
{
    protected $fillable = [
        'user_id',
        'lesson_id',
        'isDone',
        'current',
    ];
}
