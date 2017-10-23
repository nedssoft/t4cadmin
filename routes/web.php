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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('/question', 'QuestionsController');


//-------------Categories---------------------------------//
Route::get('categories', array('as' => 'category.index', 'uses' => 'CategoryController@index'));
Route::get('categories/add', array('as' => 'category.create', 'uses' => 'CategoryController@create'));
Route::post('categories/store', array('as' => 'category.store', 'uses' => 'CategoryController@store'));
Route::get('categories/edit/{id}', array('as' => 'category.edit', 'uses' => 'CategoryController@edit'));
Route::any('categories/update/{id}', array('as' => 'category.update', 'uses' => 'CategoryController@update'));
Route::any('categories/delete/{id}', array('as' => 'category.destroy', 'uses' => 'CategoryController@destroy'));
//-------------------------------------------------------------//

// Player Routes
Route::get('player/create', array('as' => 'player.create', 'uses' => 'PlayerController@signup'));