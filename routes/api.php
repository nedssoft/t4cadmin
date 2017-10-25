<?php

use Illuminate\Http\Request;
use App\Category;

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


  Route::group(['prefix' => 'v1'], function() {

/*
  |--------------------------------------------------------------------------
  | Auth API Routes
  |--------------------------------------------------------------------------
  |
  */

    Route::get('/auth/index', 'AuthController@index1');
    // Route::post('/login', 'AuthController@login');
    // Route::post('/signup', 'AuthController@signup');
   
/*
  |--------------------------------------------------------------------------
  | Player API Routes
  |--------------------------------------------------------------------------
  |
  */

//   Route::get('/index', 'PlayerController@index');

  //get all player details
//   Route::get('/{player}', 'PlayerController@player');  
  
  //get all player level
//   Route::update('/{player}', 'PlayerController@player');



 /*
  |--------------------------------------------------------------------------
  | Questions API Routes
  |--------------------------------------------------------------------------
  |
  */


  /*
  |--------------------------------------------------------------------------
  | Categories API Routes
  |--------------------------------------------------------------------------
  |
  */
  Route::get('categories', 'CategoryController@apiIndex');
  Route::get('categories/{name}', 'CategoryController@apiShow');

 /*
  |--------------------------------------------------------------------------
  | Badges API Routes
  |--------------------------------------------------------------------------
  |
  */

//   Route::get('/index', 'BadgesController@index');
//   Route::get('/create', 'BadgesController@create');
//   Route::get('/signup', 'BadgesController@signup');

 /*
  |--------------------------------------------------------------------------
  | Levels API Routes
  |--------------------------------------------------------------------------
  |
  */
  });