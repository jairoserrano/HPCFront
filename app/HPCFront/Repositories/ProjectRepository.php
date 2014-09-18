<?php namespace HPCFront\Repositories;

use HPCFront\Entities\Project;

class ProjectRepository implements RepositoryInterface{

    protected $project;

    function __construct(Project $project)
    {
        $this->project = $project;
    }

    public function all()
    {
        return $this->project->all();
    }

    public function find($id)
    {
        return $this->project->find($id);
    }
}