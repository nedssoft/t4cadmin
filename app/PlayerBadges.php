<?php

namespace App;



use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class PlayerBadges extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
     public $timestamps = false;

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'player_id', 'badge_id'
    ];

    public function player()
    {
        return $this->belongsTo('App\Players', 'player_id');
    }

}
