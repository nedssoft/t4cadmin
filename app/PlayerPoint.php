<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlayerPoint extends Model
{
    protected $fillable = [
        'player_id', 'point'
    ];
}
