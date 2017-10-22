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

//-------------Categories---------------------------------//
Route::get('category', array('as' => 'category.index', 'uses' => 'CategoryController@index'));
Route::get('category/add', array('as' => 'category.create', 'uses' => 'CategoryController@create'));
Route::post('category/store', array('as' => 'category.store', 'uses' => 'CategoryController@store'));
Route::get('category/edit/{id}', array('as' => 'category.edit', 'uses' => 'CategoryController@edit'));
Route::patch('category/update/{id}', array('as' => 'category.update', 'uses' => 'CategoryController@update'));
Route::delete('category/delete/{id}', array('as' => 'category.destroy', 'uses' => 'CategoryController@destroy'));
//-------------------------------------------------------------//
