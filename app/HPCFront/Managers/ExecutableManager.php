<?php namespace HPCFront\Managers;


class ExecutableManager extends BaseManager implements ManagerInterface{

    function getRules()
    {
        return array(
            'name'  => 'required',
            'path'  => 'required',
            'type'  => 'required|alpha'
        );
    }

    public function getExecutablesPath(){
        return storage_path() . "/executables/";
    }
}