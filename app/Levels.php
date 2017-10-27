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
<<<<<<< HEAD
    	return $this->hasMany(Questions::class);
    }    
=======
        return $this->hasMany(Questions::class);
    }

use Illuminate\Database\Eloquent\Model;

class Levels extends Model
{   
    protected $fillable = [
        'name', 'description', 'icon'
    ];
>>>>>>> a1e9ac07bdcc8a882f7db7b8f6c40476bd4afbe7

}
