<?php
namespace HPCFront\Managers;


class CreateExecutableManager extends ExecutableManager
{

    public function save()
    {

        if ($this->getInput()->hasFile('path')) {
            $file_path = new FilesManager($this->getExecutablesPath(), $this->getInput()->file('path'));
            $this->setNewData('path', $file_path->getFilePath());
        }

        $this->isValid();
        $this->getEntity()->fill($this->getData());
        $this->getEntity()->save();
        $full_file_path = $this->getEntity()->path->getPathName();

        @chmod($full_file_path, 0750);
    }
}
