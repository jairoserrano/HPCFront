<?php namespace HPCFront\Repositories;

use HPCFront\Entities\Executable;

class ExecutableRepository extends BaseRepository implements RepositoryInterface {

    public function getEntity()
    {
        return new Executable();
    }

    public function listAll(){
        return $this->entity->lists('name', 'id');
    }
}