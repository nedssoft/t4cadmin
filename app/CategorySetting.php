<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategorySetting extends Model
{
    /**
     * Get the player who has this category settings
     *
     */
    public function player()
    {
        return $this->belongsTo('App\Players', 'player_id');
    }

    /**
     * Get the category of this setting
     *
     */
    public function category()
    {
        return $this->belongsTo('App\Category', 'category_id');
    }

    /**
     * Get the diffculty level of this setting
     *
     */
    public function level()
    {
        return $this->belongsTo('App\Levels', 'level_id');
    }

    /**
     * Get the sub category (if set) of this setting
     *
     */
    public function subCategory()
    {
        return $this->belongsTo('App\SubCategory', 'sub_category_id');
    }
}
