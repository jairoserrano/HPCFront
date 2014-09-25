<?php namespace HPCFront\Repositories;

use HPCFront\Entities\Project;

class ProjectRepository extends BaseRepository
{

    public function getEntity()
    {
        return new Project();
    }

    public function findWithAllJobsInformation($id)
    {
        return $this->entity->with(
            array(
                'jobs' => function($query){
                    $query->orderBy('created_at', 'ASC');
                },
                'jobs.entries',
                'jobs.results'
            )
        )->where('id', '=', $id)->first();
    }
}