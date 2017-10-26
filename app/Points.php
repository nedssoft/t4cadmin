<?php

namespace App;

<<<<<<< HEAD
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Points extends Model
{
   
    /**
=======
use Illuminate\Database\Eloquent\Model;

class Points extends Model
{    
     /**
>>>>>>> 27818cd36302771bdb209252bfc5dc8a523ebd50
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
<<<<<<< HEAD
        'player_id', 'value', 'amount'
=======
        'player', 'point','amount'
>>>>>>> 27818cd36302771bdb209252bfc5dc8a523ebd50
    ];
}
