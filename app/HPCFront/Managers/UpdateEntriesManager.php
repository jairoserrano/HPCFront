<?php namespace HPCFront\Managers;


class UpdateEntriesManager extends BaseManager implements ManagerInterface{

    function getRules()
    {
        return array(
            'name'          => 'required',
            'path'          => '',
        );
    }

    public function save(){

        if ($this->getInput()->hasFile('path')) {
            $file_path = new FilesManager(
                $this->getEntriesPath($this->getEntity()->job_id),
                $this->getInput()->file('path'));
            $this->setNewData('path', $file_path->getFilePath());
        }else{
            $this->setNewData('path', $this->getEntity()->path);
        }

        $this->isValid();
        $this->getEntity()->fill($this->getData());
        $this->getEntity()->save();
    }

} 