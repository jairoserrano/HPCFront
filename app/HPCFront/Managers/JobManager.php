<?php namespace HPCFront\Managers;

class JobManager extends BaseManager{

    function getRules(){}

    public function createJobFolder($name){
        $job_id =  $this->getEntity()->id;
        $name = $this->getJobsRootFolder()."/$job_id/$name/";
        return $this->file->makeDirectory($name, 0775, true);
    }

    public function getExecsPath(){
        return storage_path() . "/execs/";
    }
    public function getJobsRootFolder(){
        return storage_path() . "/jobs/";
    }
}