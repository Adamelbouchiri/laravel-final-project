<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class userClasses extends Model
{
    protected $fillable = [
        'user_id',
        'classe_id',
        'isPaid',
    ];
}
