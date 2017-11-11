<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    //
    protected $fillable = ['category_id', 'level_id', 'point_id', 'question', 'answer','status'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function level()
    {
        return $this->belongsTo(Levels::class);
    }

    public function subcategories()
    {
        return $this->hasManyThrough('App\SubCategory', 'App\Category', 'id', 'category_id');
    }

    /**
     * Get the options for the question
     *
     */
    public function options()
    {
        return $this->hasMany('App\Options', 'question_id');
    }

    /**
     * Get the point for the question
     *
     */
    public function point()
    {
        return $this->belongsTo('App\Points');
    }
}