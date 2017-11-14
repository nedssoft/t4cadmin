<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Badges extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'icon', 'points','description'
    ];

    /**
	 * Gets the players who has achived this badge
     *
     */
    public function players()
    {
        return $this->belongsToMany('App\Players', 'player_badges', 'badge_id', 'player_id');
    }
}
