<?php
/**
 * Created by PhpStorm.
 * User: perseus
 * Date: 22/10/14
 * Time: 10:53 AM
 */

namespace HPCFront\Managers;


class UpdateExecutableManager extends ExecutableManager {

    public function save(){

        if ($this->getInput()->hasFile('path')) {
            $file_path = new FilesManager($this->getExecutablesPath(), $this->getInput()->file('path'));
            $this->setNewData('path', $file_path->getFilePath());
        }else{
            $this->setNewData('path', $this->getEntity()->path);
        }

        $this->isValid();
        $this->getEntity()->fill($this->getData());
        $this->getEntity()->save();

    }
} 