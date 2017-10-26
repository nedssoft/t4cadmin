<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    public $primaryKey = 'id';
    public $fillable = array('name', 'description', 'imgUrl');
    

    public function questions()
    {
    	return $this->hasMany(Questions::class);
    }

    public function subCategories(){

    	return $this->hasMany(SubCategory::class);
    }
}
