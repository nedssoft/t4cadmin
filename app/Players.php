<?php

namespace App;
<<<<<<< HEAD
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class Players extends Model
{
    use HasApiTokens, Notifiable;
    
=======

use Illuminate\Database\Eloquent\Model;

class Players extends Model
{
>>>>>>> 27818cd36302771bdb209252bfc5dc8a523ebd50
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
<<<<<<< HEAD
        'name', 'email', 'password','phone','username'
    ]; 

    //get player badges

    public function badges(){
    	return $this->hasMany('App\PlayerBadges');
    }

    //get player levels

    public function level(){
        return $this->hasOne('App\Levels');
    }
    
    //get player points and money

    public function point(){
        return $this->hasOne('App\Points');
    }

=======
        'name', 'username','email','password','level'
    ];
>>>>>>> 27818cd36302771bdb209252bfc5dc8a523ebd50
}
