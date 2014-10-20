<?php namespace HPCFront\Managers;
use Illuminate\Filesystem\Filesystem as File;


class CreateJobManager extends JobManager implements ManagerInterface
{
    public $path;

    function getRules()
    {
        return array(
            'name'          => 'required',
            'description'   => 'required',
            'type'          => 'required',
            'project_id'    => 'required|integer',
            'executable'    => '',
        );
    }

    public function save(){

        if ($this->getInput()->hasFile('executable')) {
            $file_path = new FilesManager($this->getExecsPath(), $this->getInput()->file('executable'));
            $this->setNewData('executable', $file_path->getFilePath());
        }

        $this->isValid();
        $this->getEntity()->fill($this->getData());
        $this->getEntity()->save();

        $this->createJobFolder('results');
        $this->createJobFolder('entries');

    }

}