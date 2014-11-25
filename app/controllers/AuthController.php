<?php

class AuthController extends \BaseController
{

    public function getLogin()
    {
        return View::make('auth.login');
    }

    public function auth()
    {
        $data = Input::only('username', 'password');

        $credentials = array(
            'username' => $data['username'],
            'password' => $data['password']
        );


        if (Auth::attempt($credentials)) {
            return Redirect::route('projects.index');
        } else {
            return Redirect::back()->with('login_error', 1);
        }
    }

    public function logout()
    {
        Auth::logout();
        return Redirect::route('login');

    }

} 