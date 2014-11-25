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

<<<<<<< HEAD
    public function createJobFolder($name){
        $job_id = $this->getEntity()->id;
        $name = $this->getJobsRootFolder()."/$job_id/$name/";

        if(!$this->file->exists($name)){
            return $this->file->makeDirectory($name, 0777, true);
=======
    public function createJobFolder($path_name){
        $job_id =  $this->getEntity()->id;
        $path_name = $this->getJobsRootFolder()."/$job_id/$name/";

        if(!$this->file->exists($path_name)){

            //return $this->file->makeDirectory($name, 0775, true);
            return SSH::run(array(
                "mkdir $path_name",
            ));
>>>>>>> 93d619ee2fc745f7c762bb81366738332163917b
        }
    }

    public function getJobsRootFolder(){
        return storage_path() . "/jobs/";
    }
}
