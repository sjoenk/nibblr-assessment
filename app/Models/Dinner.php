<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dinner extends Model
{
    protected $table = 'dinners';

    protected $fillable = [
        'start', 'end', 'title', 'description', 'max_members'
    ];

}
