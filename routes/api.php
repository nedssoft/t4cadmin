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


  /*
  |--------------------------------------------------------------------------
  | Categories API Routes
  |--------------------------------------------------------------------------
  |
  */
  Route::get('categories', 'CategoryController@all');
  Route::get('categories/{id}', 'CategoryController@show');

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

