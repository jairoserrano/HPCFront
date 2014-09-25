<?php namespace HPCFront\Repositories;
use HPCFront\Entities\Job;

class JobsRepository extends BaseRepository{

    public function getEntity()
    {
        return new Job();
    }

    public function getList(){
        return $this->entity->lists('name', 'id');
    }
}