<?php

namespace App;

<<<<<<< HEAD
use Illuminate\Notifications\Notifiable;
=======
>>>>>>> 27818cd36302771bdb209252bfc5dc8a523ebd50
use Illuminate\Database\Eloquent\Model;

class PlayerBadges extends Model
{
<<<<<<< HEAD
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'player_id', 'badge_id'
    ];

    
=======
       
    protected $fillable = [
        'player', 'badge'
    ];
>>>>>>> 27818cd36302771bdb209252bfc5dc8a523ebd50
}
