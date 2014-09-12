<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', ['as' => 'login', 'uses' => 'UsersController@getLogin']);
Route::post('login', ['as' => 'post.login', 'uses' => 'UsersController@postLogin']);
Route::resource('users','UsersController',array('except' => array('show')));

Route::resource('jobs','JobsController');
