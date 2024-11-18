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
}
