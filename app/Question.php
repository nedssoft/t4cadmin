<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    //
    protected $fillable =
    [ 'category_id', 'level_id', 
    	'question', 'option_1', 'option_2',
		'option_3', 'option_4', 'answer',
    ];

    public function categories()
    {
    	return $this->belongsTo(Category::class);
    }

    public function levels()
    {
    	return $this->belongsTo(Level::class);
    }

   
}
