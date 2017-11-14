<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class Players extends Authenticatable
{
    use Notifiable, HasApiTokens;
    
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','phone','username'
    ]; 

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password'];

    //get player badges

    public function badges() 
    {
    	return $this->belongsToMany('App\Badges', 'player_badges', 'player_id', 'badge_id');
    }

    /**
     * Check if the player has a given badge
     *
     * @param int $badgeID 
     *
     * @return bool
     */
    public function hasBadge($badgeID)
    {
        return $this->badges->contains('id', $badgeID);
    }

    //get player levels

    public function level()
    {
        return $this->hasOne(Levels::class, 'player_id');
    }
    
    //get player points and money

    public function point()
    {
        return $this->hasOne(PlayerPoint::class, 'player_id');
    }

    /**
     * Get the profile of the player
     *
     */
    public function profile()
    {
        return $this->hasOne('App\Profile', 'player_id');
    }

    /**
     * Get the accounts of the player
     *
     */
    public function accounts()
    {
        return $this->hasMany('App\Account', 'player_id');
    }

    /**
     * Get API user entity
     *
     * @param string $username
     * 
     * @return this
     */
    public function findForPassport($username)
    {
        return $this->where(function ($query) use ($username) {
            $query->where('username', $username)
                    ->orWhere('email', $username);
            })->first();
    }

}
