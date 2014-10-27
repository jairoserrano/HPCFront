<?php
use HPCFront\Helpers\ResourceHelpers;
/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (Auth::guest())
	{
		if (Request::ajax())
		{
			return Response::make('Unauthorized', 401);
		}
		else
		{
			return Redirect::route('login');
		}
	}
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::route('login');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});



Route::filter('exists', function($route, $request, $value){
    $helper =  new ResourceHelpers();

    foreach($route->parameters() as $resource => $id){
        if($resource == 'project' || $resource == 'projects'){
            if(!$helper->projectExists($id)){
                throw new \HPCFront\Exceptions\ResourceException('projecto no encontrado', 404);
            }
        }
        if($resource == 'jobs' || $resource == 'job'){
            if(!$helper->jobExists($id)){
                throw new \HPCFront\Exceptions\ResourceException('job no encontrado', 404);
            }
        }
        if($resource == 'entries'){
            if(!$helper->entryExists($id)){
                throw new \HPCFront\Exceptions\ResourceException('entry no encontrado', 404);
            }
        }

    }

});

Route::filter('ownership', function($route, $request, $value){
    $projectRepository =  new \HPCFront\Repositories\ProjectRepository();
    $params = $route->parameters();

    if(array_key_exists('project', $params) || array_key_exists('projects', $params)){
        if(isset($params['projects'])){
            $project_id = $params['projects'];
        }

        if(isset($params['project'])){
            $project_id = $params['project'];
        }

        if(Auth::user()->username != $projectRepository->find($project_id)->user_owner){
            throw new \HPCFront\Exceptions\ResourceException('No tienes acceso a éste proyecto o sus jobs', 403);
        }
    }


});