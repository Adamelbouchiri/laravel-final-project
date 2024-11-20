<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinalProject extends Model
{
    protected $fillable = [
        'question',
        'answer',
        'course_id',
    ];

    public function course() {
        return $this->belongsTo(Course::class);
    }
}
