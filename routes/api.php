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
      Route::post('signup', 'APIPlayer@create');
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
        return $request->user();
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
      Route::get('questions/{category_id}/{sib_category}', 'ApiQuestion@index');

      /*
      |--------------------------------------------------------------------------
      | Categories API Routes
      |--------------------------------------------------------------------------
      |
      */
      Route::get('categories', 'ApiCategory@index');
      Route::post('categories/store', 'ApiCategory@create');
      Route::get('categories/{id}', 'ApiCategory@show');

      /*
      |--------------------------------------------------------------------------
      | Badges API Routes
      |--------------------------------------------------------------------------
      |
      */
      Route::get('badge/index', 'APIBadge@index');
      Route::get('badge/create', 'APIBadge@create');

      /*
      |--------------------------------------------------------------------------
      | Player API Routes
      |--------------------------------------------------------------------------
      |
      */
      Route::post('player/create', 'APIPlayer@create');
      Route::post('player/login', 'APIPlayer@login');
      Route::get('player/{id}', 'APIPlayer@player');
    });
});