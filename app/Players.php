<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Players extends Model
{
    use Notifiable;
    
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','phone','username', 'token'
    ]; 

    //get player badges

    public function badges(){
    	return $this->hasMany(PlayerBadges::class);
    }

    //get player levels

    public function level(){
        return $this->hasOne(Levels::class);
    }
    
    //get player points and money

    public function point(){
        return $this->hasOne(Points::class);
    }

}
