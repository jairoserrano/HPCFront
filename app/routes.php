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

Route::get('/', ['as' => 'login', 'uses' => 'AuthController@login']);
Route::post('auth', ['as' => 'auth', 'uses' => 'AuthController@auth']);
Route::resource('users','UsersController',array('except' => array('show')));

Route::resource('jobs','JobsController');
