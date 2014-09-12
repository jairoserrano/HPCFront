<?php
/**
 * Created by PhpStorm.
 * User: perseus
 * Date: 12/09/14
 * Time: 10:41 AM
 */

class RoutesTest extends TestCase {

    protected $routes;

    protected function setRoutes($route, $verbs = array()){
        unset($this->routes);
        $this->routes = [
            $route = ['GET', 'POST', 'PUT', 'DELETE']
        ];
    }

    public function testUsersIndexRoute(){
        $this->call('GET', 'users');
        $this->assertResponseOk('La ruta para los usuarios no existe');
    }

    public function testUsersPostRoute(){
        $this->call('POST', 'users');
        $this->assertResponseOk('La ruta para los usuarios no existe');
    }


    public function testUsersEditByIdRoute(){
        $this->call('GET', 'users/{users}/edit', array('users' => 1));
        $this->assertResponseOk('La ruta para los usuarios no existe');
    }

    public function testEditUserByIdRoute(){
        $this->call('PUT', 'users/{users}', array('users' => 1));
        $this->assertResponseOk('La ruta para los usuarios no existe');
    }

    public function testDeleteUserByIdRoute(){
        $this->call('DELETE', 'users/{users}', array('users' => 1));
        $this->assertResponseOk('La ruta para los usuarios no existe');
    }
} 