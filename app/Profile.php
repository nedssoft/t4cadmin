<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Get the player who has this profile
     *
     */
    public function player()
    {
        return $this->belongsTo('App\Players');
    }
}
