<?php

class AuthController extends \BaseController{

    public function getLogin(){
        return View::make('auth.login');
    }

    public function authLogin(){

        return Redirect::route('projects.index');
    }

} 