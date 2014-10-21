<?php namespace HPCFront\Entities;

use HPCFront\Components\Builders\Field\Field;
use Symfony\Component\Finder\SplFileInfo;

class Entry extends BaseEntity implements EntityInterface {

    protected $table    = 'entries';
    protected $fillable = ['name', 'path', 'job_id'];

    public function job(){
        return $this->belongsTo('\HPCFront\Entities\Job');
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