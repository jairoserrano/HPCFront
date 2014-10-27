<?php namespace HPCFront\Managers;

use HPCFront\Repositories\JobsRepository;

class CreateEntriesManager extends EntryManager implements ManagerInterface{

    function getRules()
    {
        return array(
            'name'          => 'required',
            'path'          => 'required',
            'job_id'        => 'required'
        );
    }

    public function save(){


        if ($this->getInput()->hasFile('path')) {
            $file_path = new FilesManager(
                $this->getEntriesPath($this->getInput()->get('job_id')),
                $this->getInput()->file('path'));
            $this->setNewData('path', $file_path->getFilePath());
        }

        $this->isValid();
        $this->getEntity()->fill($this->getData());
        $this->getEntity()->save();
    }
}