<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    protected $fillable = [
        'name',
        'seats',
        'coach_id',
        'isPremium',
        'start',
        'end',
    ];

    public function coach() {
        return $this->belongsTo(User::class);
    }

    public function users() {
        return $this->belongsToMany(User::class, 'user_classes');
    }
}
