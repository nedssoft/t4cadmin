<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
|--------------------------------------------------------------------------------
| External routes - Routes that don't require auth satisfaction
|--------------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


/*
|--------------------------------------------------------------------------------
| Internal routes - Routes that should only be accessible when auth is satisfied
|--------------------------------------------------------------------------------
*/

    Route::resource('/question', 'QuestionsController');
    Route::get('categories', array('as' => 'category.index', 'uses' => 'CategoryController@index'));
    Route::get('categories/add', array('as' => 'category.create', 'uses' => 'CategoryController@create'));
    Route::post('categories/store', array('as' => 'category.store', 'uses' => 'CategoryController@store'));
    Route::get('categories/edit/{id}', array('as' => 'category.edit', 'uses' => 'CategoryController@edit'));
    Route::any('categories/update/{id}', array('as' => 'category.update', 'uses' => 'CategoryController@update'));
    Route::any('categories/delete/{id}', array('as' => 'category.destroy', 'uses' => 'CategoryController@destroy'));


//-------------------------------------------------------------//

// Player Routes
Route::post('player/create', array('as' => 'player.create', 'uses' => 'PlayerController@signup')); //create new player
Route::post('player/login', array('as' => 'player.login', 'uses' => 'PlayerController@login')); //login a player
//Route::get('player/{id}/points', array('as' => 'player.points', 'uses' => 'PlayerController@points')); //get player points
//Route::get('player/{id}/badges', array('as' => 'player.badges', 'uses' => 'PlayerController@badges')); //get player badges
//Route::get('player/{id}', array('as' => 'player.player', 'uses' => 'PlayerController@badges')); //get player full details