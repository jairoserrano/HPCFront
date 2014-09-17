<?php

use Mockery\Mock;

/*class UsersControllerTest extends TestCase
{

    protected $methods = [
        'index',
        'edit',
        'store',
        'destroy',
        'getLogin',
        'postLogin'
    ];

    public function testControllerHasMethods()
    {

        foreach($this->methods as $method) {
            $this->assertTrue(
                method_exists('UsersController', $method),
                "La clase no tiene el metodo $method"
            );
        }
    }

    public function testControllerHasNotMethods()
    {

        $this->assertClassHasStaticAttribute('show', 'UsersController');

    }

    public function testIndex()
    {
        $this->action('GET', 'UsersController@index');
        $crawler = $this->client->getCrawler();
        $table = $crawler->filter('table');

        //Los usuarios deben ir todos en una colección de objetos, dentro de una variable $users
        //$this->assertViewHas('users', 'No estás enviadno la variable users');

        $this->assertCount(1, $table, 'No hay una tabla, solo debe existir una');
        $this->assertContains('table table-hover table-responsive', $table->attr('class'), 'La tabla no tiene las clases requeridas');
    }

    public function testGetLogin()
    {
        $this->action('GET', 'UsersController@getLogin');
        $crawler = $this->client->getCrawler();
        $form = $crawler->filter('form');

        $inputs = $form->filter('input[type="text"], input[type="password"]');
        $checkbox = $form->filter('input[type="checkbox"]');
        $submit = $form->filter('input[type="submit"]');

        $this->assertResponseOk('No estás llevando al login');

        //Atributos minímos para el formulario
        $this->assertEquals(
            URL::action('UsersController@postLogin'),
            $form->attr('action'),
            'El formulario tiene el "action" incorrecto'
        );

        $this->assertEquals(
            'POST',
            $form->attr('method'),
            'El formulario tiene el "method" incorrecto'
        );

        $this->assertContains('form', $form->attr('class'));

        //Elementos mínimos del formulario
        $this->assertCount(1, $form, 'Necesitamos solo un formulario');
        $this->assertCount(2, $inputs, 'Solo necesitamos dos inputs');
        $this->assertCount(1, $checkbox, 'Solo un checkbox para recordar al usuario');
        $this->assertCount(1, $submit, 'Solo un boton para el submit');
        $this->assertContains('form-control', $inputs->attr('class'), 'Faltan las clases de Bootstrap');
        $this->assertNotEmpty(
            $form->filter('label')->attr('for'),
            'No se han definido el atributo "for" de los labels'
        );

    }

    public function testPostLoginWithAuthTrue()
    {
        Input::shouldReceive('get')->with('email')->once()->andReturn('email');
        Input::shouldReceive('get')->with('password')->once()->andReturn('password');
        Auth::shouldReceive('attempt')->once()->andReturn(true);

        //Laravel almacena los usuarios logueados en Auth::user();
        $user = Mockery::mock('User');
        Auth::shouldReceive('user')->once()->andReturn($user);

        $this->action('POST', 'UsersController@postLogin');

        //Mirar los filtros de Laravel para implementar
        $this->assertRedirectedToRoute('dashboard');

    }

    public function testPostLoginWithAuthFalse()
    {
        Input::shouldReceive('get')->with('email')->once()->andReturn('email');
        Input::shouldReceive('get')->with('password')->once()->andReturn('password');
        Auth::shouldReceive('attempt')->once()->andReturn(false);

        $this->action('POST', 'UsersController@postLogin');

        $this->assertRedirectedToRoute('login');

    }

} */