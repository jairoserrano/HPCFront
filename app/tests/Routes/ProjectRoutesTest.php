<?php

class ProjectRoutesTest extends TestCase{
    public function testProjectsIndexRoute(){
        $this->call('GET', 'projects');
        $this->assertResponseOk('No existe la ruta para ver todos los proyectos');
    }

    public function testProjectStoreRoute(){
        $this->call('POST', 'projects');
        $this->assertResponseOk('No existe la ruta para guardar un proyecto');
    }


    public function tesEditProjectByIdRoute(){
        $this->call('GET', 'projects/{projects}/edit', array('projects' => 5));
        $this->assertResponseOk('No existe la ruta para la vista de edición de un proyecto');
    }

    public function testUpdateProjectByIdRoute(){
        $this->call('PUT', 'projects/{projects}', array('projects' => 5));
        $this->assertResponseOk('No existe la ruta para actualizar un proyecto');
    }

    public function testDeleteProjectByIdRoute(){
        $this->call('DELETE', 'projects/{projects}', array('projects' => 5));
        $this->assertResponseOk('No existe la ruta para destruir un proyecto');
    }
} 