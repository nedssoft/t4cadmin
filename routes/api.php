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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => 'v1'], function () {

 Route::get('level', 'APILevel@index');

 
 /*
  |--------------------------------------------------------------------------
  | Questions API Routes
  |--------------------------------------------------------------------------
  |
  */
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
   Route::post('badge/create', 'APIBadge@create'); //
   Route::post('badge/addplayerbadge', 'APIBadge@createPlayerBadge'); // adds badge for player, receives array of player_id and badge_id
   Route::get('badge/player/{id}', 'APIBadge@playerbadges'); //return's the specified player badges

    /*
  |--------------------------------------------------------------------------
  | Level API Routes
  |--------------------------------------------------------------------------
  |
  */

  Route::get('level/index', 'APILevel@index');
  Route::post('level/create', 'APILevel@create'); //
  Route::post('level/addplayerlevel', 'APILevel@updatePlayerLevel'); // updates player level
  Route::get('level/player/{id}', 'APILevel@createPlayerLevel'); //return's the specified player badges


 /*
  |--------------------------------------------------------------------------
  | Player API Routes
  |--------------------------------------------------------------------------
  |
  */
  Route::post('player/create', 'APIPlayer@create');
  Route::post('player/login', 'APIPlayer@login');
  Route::get('player/{id}', 'APIPlayer@player'); //get specified player info

});

