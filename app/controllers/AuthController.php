<?php

class AuthController extends \BaseController
{

    public function getLogin()
    {
        return View::make('auth.login');
    }

    public function auth()
    {
        $data = Input::only('uid', 'password');

        $credentials = array(
            'uid' => $data['uid'],
            'password' => sha1($data['password'])
        );


        if (Auth::attempt($credentials)) {
            return Redirect::route('pojects.index');
        } else {
            return Redirect::back()->with('login_error', 1);
        }
    }

    public function logout()
    {
        //Auth::logout();

        return Redirect::action('login');

    }

} 