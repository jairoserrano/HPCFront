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
            )
        )->where('id', '=', $id)->first();
    }

    public function getAllUserProjects($id){
        return $this->entity
            ->where('user_owner', '=', $id)
            ->orderBy('created_at', 'DESC')
            ->get();
    }

    public function getLastProject(){
        return ($this->entity->count() > 0) ? $this->entity->orderBy('id', 'DESC')->first() : 0 ;
    }

    public function getUserProjects($user_id){
        return $this->entity
            ->with(
                array(
                    'projects' => function($query) use ($user_id){
                        $query->where('user_owner', '=', $user_id);
                    },
                    'projects.jobs'
                )
            )
            ->get();
    }
}