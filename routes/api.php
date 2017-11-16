<?php

use Illuminate\Http\Request;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'v1'], function() {
    /*
    |--------------------------------------------------------------------------
    | Routes outside the API auth guard but requires that the client
    | requesting for resources within these routes be valid and trusted.
    |--------------------------------------------------------------------------
    |
    */
    Route::group(['middleware' => 'api-auth.client'], function() {
      //Create a new user resource
      Route::post('players', 'APIPlayer@create');
    });


    /*
    |--------------------------------------------------------------------------
    | Protected API Routes
    |--------------------------------------------------------------------------
    |
    */
    Route::group(['middleware' => 'auth:api'], function() {
      //Get the current user
      Route::get('user', function (Request $request) {
        return $request->user()->load('profile', 'point', 'badges', 'levels');
      });

      /*
      |--------------------------------------------------------------------------
      | Questions API Routes
      |--------------------------------------------------------------------------
      |
      */
      Route::get('questions', 'ApiQuestion@index');
      Route::get('questions/paginate', 'ApiQuestion@paginate');
      Route::get('questions/{question_id}', 'ApiQuestion@findByID')->where('question_id', '[0-9]+');
      Route::get('questions/category/{category_id}', 'ApiQuestion@categoryQuestions')->where('category_id', '[0-9]+');
      Route::get('questions/subcategory/{sub_categoryID}', 'ApiQuestion@subCategoryQuestions')->where('sub_categoryID', '[0-9]+');
      //Route::get('questions/{category_id}/{sib_category}', 'ApiQuestion@index');

      /*
      |--------------------------------------------------------------------------
      | Categories API Routes
      |--------------------------------------------------------------------------
      |
      */
      Route::get('categories', 'ApiCategory@index');
      Route::get('categories/paginate', 'ApiCategory@paginate');
      Route::get('categories/{category_id}', 'ApiCategory@findByID')->where('category_id', '[0-9]+');
      Route::get('categories/{category_id}/subcategories', 'ApiCategory@subCategories')->where('category_id', '[0-9]+');
      Route::get('categories/subcategory/{sub_categoryID}', 'ApiCategory@subCategory')->where('sub_categoryID', '[0-9]+');

      /*
      |--------------------------------------------------------------------------
      | Badges API Routes
      |--------------------------------------------------------------------------
      |
      */
      Route::get('badges', 'APIBadge@index');
      Route::get('badges/paginate', 'ApiCategory@paginate');
      Route::get('badges/{badge_id}', 'APIBadge@findByID')->where('badge_id', '[0-9]+');
      //Route::get('badges/create', 'APIBadge@create');

      /*
      |--------------------------------------------------------------------------
      | Player API Routes
      |--------------------------------------------------------------------------
      |
      */
      Route::get('players', 'APIPlayer@index');
      Route::get('players/paginate', 'APIPlayer@paginate');
      //Route::post('players/login', 'APIPlayer@login');
      Route::post('players/{player_id}', 'APIPlayer@update')->where('player_id', '[0-9]+');
      Route::delete('players/{player_id}', 'APIPlayer@delete')->where('player_id', '[0-9]+');
      Route::get('players/{player_id}', 'APIPlayer@findByID')->where('player_id', '[0-9]+');
      Route::get('players/{player_id}/badges', 'APIBadge@playerBadges')->where('player_id', '[0-9]+');
      Route::post('players/{player_id}/badges/{badge_id}', 'APIBadge@createPlayerBadge')->where(['player_id' => '[0-9]+', 'badge_id' => '[0-9]+']);
      Route::delete('players/{player_id}/badges/{badge_id}', 'APIBadge@removePlayerBadge')->where(['player_id' => '[0-9]+', 'badge_id' => '[0-9]+']);
      Route::get('players/{player_id}/levels', 'APILevel@levels')->where('player_id', '[0-9]+');
      Route::post('players/{player_id}/levels/{level_id}', 'APILevel@createPlayerLevel')->where(['player_id' => '[0-9]+', 'level_id' => '[0-9]+']);
      Route::delete('players/{player_id}/levels/{level_id}', 'APILevel@removePlayerLevel')->where(['player_id' => '[0-9]+', 'level_id' => '[0-9]+']);
      Route::get('players/{player_id}/points', 'APIPoint@playerPoints')->where('player_id', '[0-9]+');
      Route::post('players/{player_id}/points', 'APIPoint@updatePlayerPoints')->where('player_id', '[0-9]+');

      /*
      |--------------------------------------------------------------------------
      | Level API Routes
      |--------------------------------------------------------------------------
      |
      */
      Route::get('levels', 'APILevel@index');
      Route::get('levels/paginate', 'APILevel@paginate');
      Route::get('levels/{level_id}', 'APILevel@findByID')->where('level_id', '[0-9]+');
      Route::get('levels/{level_id}/players', 'APILevel@levelPlayers')->where('level_id', '[0-9]+');

      /*
      |--------------------------------------------------------------------------
      | Points API Routes
      |--------------------------------------------------------------------------
      |
      */
      Route::get('points', 'APIPoint@index');
      Route::get('points/paginate', 'APIPoint@paginate');
      Route::get('points/{point_id}', 'APIPoint@findByID')->where('point_id', '[0-9]+');

      /*
      |--------------------------------------------------------------------------
      | Settings API Routes
      |--------------------------------------------------------------------------
      |
      */
      Route::get('settings/category/{category_id}', 'APISettings@categorySettings')->where('category_id', '[0-9]+');
    });
});