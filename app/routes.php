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

Route::group(array('before' => 'guest'), function () {
    Route::get('/', array( 'as'=> 'login', 'uses' => 'AuthController@getLogin'));
    Route::post('auth', array( 'as'=> 'auth', 'uses' => 'AuthController@auth'));
});

Route::group(array('before' => 'auth'), function () {

    Route::resource('projects', 'ProjectsController');
    Route::resource('project.jobs', 'ProjectJobsController', array('except' => 'index'));
    Route::resource('entries', 'EntriesController', array('except' => array('create', 'show', 'index')));

    Route::get('jobs/{id}/create/entry', array('as' => 'new_entry', 'uses' => 'EntriesController@newEntry'));
    Route::get('jobs/{id}/run', array('as' => 'run_job', 'uses' => 'JobsController@runJob'));
    Route::post('jobs/{id}/exec', array('as' => 'exec_job', 'uses' => 'JobsController@executeJob'));
    Route::get('entry/getdocument/{id}', 'EntriesController@getFile');
    Route::get('download/{result}', array('as'=> 'download_result', 'uses' => 'JobsController@downloadResult'));
    Route::resource('jobs', 'JobsController', array('except' => array('create')));

    Route::get('logout', array( 'as'=> 'logout', 'uses' => 'AuthController@logout'));
});