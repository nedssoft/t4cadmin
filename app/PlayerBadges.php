<?php

namespace App;


use Illuminate\Notifications\Notifiable;

use Illuminate\Database\Eloquent\Model;

class PlayerBadges extends Model
{

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'player_id', 'badge_id'
    ];

    

       
    protected $fillable = [
        'player', 'badge'
    ];

}
