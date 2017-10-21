<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlayerBadges extends Model
{
       
    protected $fillable = [
        'player', 'badge'
    ];
}
