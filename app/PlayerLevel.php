<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlayerLevel extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'player_id', 'level_id'
    ];
}
