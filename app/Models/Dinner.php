<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dinner extends Model
{
    protected $table = 'dinners';

    protected $fillable = [
        'start', 'end', 'title', 'description', 'max_members'
    ];

    protected $casts = [
        'max_members' => 'integer',
        'start' => 'datetime',
        'end' => 'datetime'
    ];

    public function guests() {
        return $this->belongsToMany("App\Models\User");
    }

    public function address() {
        return $this->belongsTo("App\Models\Address");
    }

    public function host() {
        return $this->belongsTo("App\Models\User", 'user_id');
    }

}
