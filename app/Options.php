<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Options extends Model
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
        'question_id', 'option'
    ];

    /**
     * Get the question that owns the answer
     *
     */
    public function question()
    {
        return $this->belongsTo('App\Questions');
    }
}
