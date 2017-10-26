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

use Illuminate\Database\Eloquent\Model;

class Levels extends Model
{   
    protected $fillable = [
        'name', 'description', 'icon'
    ];

}
