<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'name',
        'classe_id',
    ];

    public function class()
    {
        return $this->belongsTo(Classe::class);
    }

    public function lessons() {
        return $this->hasMany(Lesson::class);
    }

    public function project() {
        return $this->hasOne(FinalProject::class);
    }

    public function users() {
        return $this->belongsToMany(User::class, 'user_courses');
    }
}
