<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterClass extends Model
{
    protected $fillable = [
        'name',
        'start',
        'end',
    ];
}
