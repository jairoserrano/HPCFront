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
            $full_file_path = $file_path->getFilePath();
            $this->setNewData('path', $full_file_path);

            \SSH::run(
                array(
                    "chown -R hpcfront:apache $full_file_path",
                    "chmod -R u+rwx $full_file_path",
                    "chmod -R g+rw $full_file_path",
                    "chmod -R o-rwx $full_file_path"
                )
            );
        }

        $this->isValid();
        $this->getEntity()->fill($this->getData());
        $this->getEntity()->save();

    }
} 