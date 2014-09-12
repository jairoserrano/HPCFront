<?php
/**
 * Created by PhpStorm.
 * User: perseus
 * Date: 12/09/14
 * Time: 11:10 AM
 */

class UsersControllerTest extends TestCase{
    protected $methods=[
            'index',
            'edit',
            'store',
            'destroy',
            'getLogin',
            'postLogin'
        ];

    public function testControllerHasMethods(){

        foreach($this->methods as $method){
            $this->assertTrue(
                method_exists('UsersController', $method),
                "La clase no tiene el metodo $method"
            );
        }

    }


    public function testIndexView(){
        $response = $this->action('GET', 'UsersController@index');
        $crawler = $this->client->request('GET', 'users');
        $table = $crawler->filter('table')->eq(0);


        //$view = $response->original();

        //$this->assertEquals(true, is_array($view['users']));

        $this->assertCount(1, $table, 'No hay una tabla, solo quiero una');
        $this->assertEquals('table-bordered', $table->attr('class'), 'La tabla no tiene las clases requeridas');
    }

} 