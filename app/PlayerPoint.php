<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlayerPoint extends Model
{
    protected $table = 'player_points';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    protected $fillable = [
        'player_id', 'total_points', 'earned_points'
    ];

    public function player()
    {
        return $this->belongsTo('App\Players');
    }
}
