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

    Route::resource('executables', 'ExecutablesController', array('except' => 'show'));
    Route::get('executables/download/{id}',array('as'=> 'download_executable', 'uses' => 'ExecutablesController@downloadFile'));


    Route::group(array('before' => 'exists:resource'), function(){

        Route::resource('projects', 'ProjectsController');
        Route::resource('project.jobs', 'ProjectJobsController', array('except' => 'index'));
        Route::resource('project.job.entries', 'JobEntriesController', array('except' => array('show', 'index')));
    });

    Route::get('entry/get-entry/{entry_id}',array('as'=> 'get_entry', 'uses' => 'JobEntriesController@getFile'));
    Route::get('jobs/{id}/run', array('as' => 'run_job', 'uses' => 'ProjectJobsController@runJob'));
    Route::post('jobs/{id}/exec', array('as' => 'exec_job', 'uses' => 'ProjectJobsController@executeJob'));
    Route::get('download/{result}', array('as'=> 'download_result', 'uses' => 'JobsController@downloadResult'));


    Route::get('logout', array( 'as'=> 'logout', 'uses' => 'AuthController@logout'));
});

