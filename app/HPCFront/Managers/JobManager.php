<?php namespace HPCFront\Managers;

class JobManager extends BaseManager{

    function getRules()
    {
        return array(
            'name'              => 'required',
            'description'       => 'required',
            'executable_id'     => 'required|integer',
            'project_id'        => 'required|integer',
        );
    }

    public function createJobFolder($name){
        $job_id =  $this->getEntity()->id;
        $name = $this->getJobsRootFolder()."/$job_id/$name/";

        if(!$this->file->exists($name)){
            return $this->file->makeDirectory($name, 0775, true);
        }
    }

    public function getJobsRootFolder(){
        return storage_path() . "/jobs/";
    }
}