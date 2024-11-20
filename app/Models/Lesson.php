<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $fillable = [
        'name',
        'description',
        'course_id',
        'content',
        'isDone',
        'current',
    ];

    public function course() {
        return $this->belongsTo(Course::class);
    }
}
