<?php namespace HPCFront\Managers;

class FilesManager
{

    protected $path;
    protected $file;

    function __construct($path, $file)
    {
        $this->setFile($file);
        $this->setFilePath($path);
    }


    public function setFile($file){
        $this->file = $file;
    }

    public function setFilePath($path)
    {
        $this->path = $this->file->move(
            $path,
            $this->file->getClientOriginalName()
        );
    }

    public function getFilePath(){
        return $this->path;
    }

}



