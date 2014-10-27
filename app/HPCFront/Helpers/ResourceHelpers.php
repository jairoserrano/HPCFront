<?php namespace HPCFront\Helpers;

use HPCFront\Repositories\ProjectRepository;
use HPCFront\Repositories\JobsRepository;
use HPCFront\Repositories\EntriesRepository;

class ResourceHelpers {

    protected $projectRepository;
    protected $jobRepository;
    protected $entryRepository;

    function __construct()
    {
        $this->entryRepository = new EntriesRepository();
        $this->jobRepository = new JobsRepository();
        $this->projectRepository = new ProjectRepository();
    }


    public function projectExists($id){
        return $this->existsResults($this->projectRepository->find($id));
    }

    public function jobExists($id){
        return $this->existsResults($this->jobRepository->find($id));
    }

    public function entryExists($id){
        return $this->existsResults($this->entryRepository->find($id));
    }

    private function existsResults($result){
        return !is_null($result) ? true : false;
    }
}