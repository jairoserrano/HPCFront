<?php namespace HPCFront\Repositories;


abstract class BaseRepository implements RepositoryInterface{
    protected $entity;

    function __construct()
    {
        $this->entity = $this->getEntity();
    }

    abstract public function getEntity();

    public function find($id){
        return $this->entity->find($id);
    }

    public function all(){
        return $this->entity->all();
    }
} 