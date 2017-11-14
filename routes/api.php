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
      Route::post('player/create', 'APIPlayer@create');
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
        return $request->user()->load('profile');
      });

      Route::get('level', 'APILevel@index');

      /*
      |--------------------------------------------------------------------------
      | Questions API Routes
      |--------------------------------------------------------------------------
      |
      */
      Route::get('questions', 'ApiQuestion@index');
      Route::get('questions/random', 'ApiQuestion@randomQuestions');
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

      /*
      |--------------------------------------------------------------------------
      | Badges API Routes
      |--------------------------------------------------------------------------
      |
      */
      Route::get('badges', 'APIBadge@index');
      Route::get('badges/paginate', 'ApiCategory@paginate');
      Route::get('badges/{badge_id}', 'APIBadge@findByID')->where('badge_id', '[0-9]+');
      Route::get('badge/create', 'APIBadge@create');

      /*
      |--------------------------------------------------------------------------
      | Player API Routes
      |--------------------------------------------------------------------------
      |
      */
      Route::post('player/login', 'APIPlayer@login');
      Route::get('player/{id}', 'APIPlayer@player')->where('id', '[0-9]+');
      Route::get('player/badges', 'APIPlayer@badges');
      Route::post('player/badges/create/{badge_id}', 'APIPlayer@createPlayerBadge');

      /*
      |--------------------------------------------------------------------------
      | Settings API Routes
      |--------------------------------------------------------------------------
      |
      */
      Route::get('settings/category/{category_id}', 'APISettings@categorySettings')->where('category_id', '[0-9]+');
    });
});