<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Get the player who has this account
     *
     */
    public function player()
    {
        return $this->belongsTo('App\Players');
    }
}
