<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlayerLevel extends Model
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
        'player_id', 'level_id'
    ];

    public function player()
    {
        return $this->belongsTo('App\Players');
    }
}
