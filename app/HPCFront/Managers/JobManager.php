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
        $path_name = $this->getJobsRootFolder()."/$job_id/$name/";

        if(!$this->file->exists($path_name)){
            \SSH::run(
                array(
                    "mkdir $path_name",
                    "chown -R hpcfront:apache $path_name",
                    "chmod -R u+rwx $path_name",
                    "chmod -R g+rw $path_name",
                    "chmod -R o-rwx $path_name"
                )
            );
        }
    }

    public function getJobsRootFolder(){
        return storage_path() . "/jobs/";
    }
}
