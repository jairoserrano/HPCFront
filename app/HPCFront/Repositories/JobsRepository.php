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

    public function getWithAllTheInformation($id){
        return $this->entity->with(
            array(
                'entries' => function($query){
                    $query->orderBy('created_at', 'ASC');
                },
            )
        )->where('id', '=', $id)->first();
    }

    public function getLastJob(){
        return $this->entity->orderBy('id', 'DESC')->first() != null ? $this->entity->orderBy('id', 'DESC')->first()->id : 0;
    }

}