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

Route::resource('projects', 'ProjectsController', array('except' => 'show'));

Route::resource('jobs', 'JobsController');

Route::resource('entries', 'EntriesController');
Route::resource('results', 'ResultsController');
