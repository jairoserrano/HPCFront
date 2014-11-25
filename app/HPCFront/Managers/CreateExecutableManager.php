<?php
/**
 * Created by PhpStorm.
 * User: perseus
 * Date: 22/10/14
 * Time: 10:53 AM
 */

namespace HPCFront\Managers;


class CreateExecutableManager extends ExecutableManager{

    public function save(){

        if ($this->getInput()->hasFile('path')) {
            $file_path = new FilesManager($this->getExecutablesPath(), $this->getInput()->file('path'));
            $this->setNewData('path', $file_path->getFilePath());
        }

        $this->isValid();
        $this->getEntity()->fill($this->getData());
        $this->getEntity()->save();

    }
} 