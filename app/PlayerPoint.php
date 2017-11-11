<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlayerPoint extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    protected $fillable = [
        'player_id', 'point'
    ];
}
