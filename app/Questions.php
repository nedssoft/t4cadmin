<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    //
    protected $fillable =
    [ 'category_id', 'level_id', 
        'question', 'option_1', 'option_2',
        'option_3', 'option_4', 'answer','status'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function level()
    {
        return $this->belongsTo(Levels::class);
    }

   
}
