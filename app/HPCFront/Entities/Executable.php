<?php namespace HPCFront\Entities;

use Symfony\Component\Finder\SplFileInfo;

class Executable extends BaseEntity implements EntityInterface{

    protected $fillable = array('name', 'path', 'type');

    public function job(){
        return $this->hasOne('\HPCFront\Entities\Job', 'executable_id');
    }

    public function getFileNameAttribute(){

        return $this->getFileSpecs($this->path)->getFilename();
    }

    public function getFileSizeAttribute(){

        return round($this->getFileSpecs($this->path)->getSize() / 1048576, 2);
    }

    private function getFileSpecs($file_path){
        return new SplFileInfo($file_path, $file_path, $file_path);
    }
} 