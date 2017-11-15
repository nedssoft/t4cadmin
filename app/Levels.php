<?php

namespace App;


use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Levels extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'icon','description'
    ]; 

    public function questions()
    {
        return $this->hasMany(Questions::class);
    }

    /**
     * Get the players who has this level
     *
     */
    public function players()
    {
        return $this->belongsToMany('App\Players', 'player_levels', 'level_id', 'player_id');
    }
}
