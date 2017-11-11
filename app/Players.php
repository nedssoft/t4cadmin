<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class Players extends Model
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
    	return $this->hasMany(PlayerBadges::class, 'player_id');
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
