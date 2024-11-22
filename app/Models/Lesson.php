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
    ];

    public function course() {
        return $this->belongsTo(Course::class);
    }

    public function users() {
        return $this->belongsToMany(User::class, 'user_lessons');
    }
}
