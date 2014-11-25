<?php

class ProjectsControllerTest extends TestCase{

    public function testIndexMethod(){
        $response = $this->action('GET', 'projects.index');
        $this->assertViewHas('projects',
            null,
            'No se han agregado los proyectos en la variable "projects"'
        );
        $this->assertResponseOk('No está llevando a ningun lado');
    }

    public function testCreateMethod(){
        $this->action('GET', 'projects.create');
        $crawler = $this->client->getCrawler();

        $form = $crawler->filter('form');

        $this->assertResponseOk('No está llevando a ningun lado');
        //Basic form information
        $this->assertCount(1, $form);
        $this->assertEquals('POST', $form->attr('method'));
        $this->assertEquals(route('projects.store'), $form->attr('action'));

        $this->assertCount(3, $form->filter('input'));
        $this->assertCount(1, $form->filter('input[type="submit"]'));

    }

    /*public function testStoreMethod(){
        $this->action('POST', 'projects.store');
        $this->assertResponseOk();
        $this->assertRedirectedToRoute('projects.index');
    }*/
} 