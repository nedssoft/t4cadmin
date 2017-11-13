<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    //
    protected $fillable = ['category_id', 'level_id', 'point_id', 'question', 'answer','status'];

    public function categories()
    {
        return $this->belongsToMany('App\Category', 'question_categories', 'question_id', 'category_id');
    }

    public function level()
    {
        return $this->belongsTo(Levels::class);
    }

    public function subCategories()
    {
        return $this->belongsToMany('App\SubCategory', 'question_sub_categories', 'question_id', 'sub_category_id');
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