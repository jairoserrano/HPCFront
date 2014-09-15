<?php
/**
 * Created by PhpStorm.
 * User: perseus
 * Date: 15/09/14
 * Time: 10:34 AM
 */

class AuthController extends BaseController {

    public function login(){
        return View::make('auth.login');
    }
    public function auth(){}

} 