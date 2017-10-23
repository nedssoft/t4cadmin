<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    public $primaryKey = 'cid';
    public $fillable = array('name', 'description', 'imgUrl');
    

    public function questions()
    {
    	return $this->hasMany(Questions::class);
    }
}
