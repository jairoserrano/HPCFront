<?php

class AuthController extends \BaseController{

    public function getLogin(){
        return View::make('auth.login');
    }

    public function auth(){

        $input = Input::only('username', 'password');

        if(Ldap::auth($input['username'],$input['password'])){
            return Redirect::route('projects.index');
        }else{
            return Redirect::back();
        }
    }

} 