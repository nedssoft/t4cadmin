<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    public $fillable = array(
    	'category_id',
    	'name', 'description', 
    	'imgUrl');

    public function category()
    {
    	return $this->belongsTo(Category::class);
    }

    public function questions()
    {
    	return $this->belongsToMany('App\Questions');
    }
}
