<?php
/**
 * Created by PhpStorm.
 * User: perseus
 * Date: 30/09/14
 * Time: 3:42 PM
 */

namespace HPCFront\Managers;


class UpdateJobManager extends JobManager
{

    function getRules()
    {
        return array(
            'name'          => 'required',
            'description'   => 'required',
            'type'          => 'required',
            'executable'    => '',
        );
    }


    public function save()
    {

        if ($this->getInput()->hasFile('executable')) {
            $file_path = new FilesManager($this->getExecsPath(), $this->getInput()->file('executable'));
            $this->setNewData('executable', $file_path->getFilePath());
        } else {
            $input['executable'] = $this->getEntity()->executable;
        }

        $this->isValid();
        $this->getEntity()->fill($this->getData());
        $this->getEntity()->save();

    }

} 