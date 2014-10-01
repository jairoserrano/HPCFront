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
Route::get('/', array('uses' => 'ProjectsController@index'));
Route::get('projects/{id}/create/job', array('as' => 'new_job', 'uses' => 'JobsController@newJob'));
Route::get('jobs/{id}/create/entry', array('as' => 'new_entry', 'uses' => 'EntriesController@newEntry'));
Route::get('jobs/{id}/run', array('as' => 'run_job', 'uses' => 'JobsController@runJob'));
Route::post('jobs/{id}/exec', array('as' => 'exec_job', 'uses' => 'JobsController@executeJob'));
Route::get('entry/getdocument/{id}', 'EntriesController@getFile');
Route::get('result/getdocument/{id}', 'ResultsController@getFile');
Route::resource('entries', 'EntriesController', array('except' => array('create', 'show', 'index')));
Route::resource('projects', 'ProjectsController');
Route::resource('jobs', 'JobsController', array('except' => array('create')));
