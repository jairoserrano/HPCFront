<?php namespace HPCFront\Managers;

class ProjectManager extends BaseManager implements ManagerInterface
{

    function getRules()
    {
        return array(
            'name' => 'required',
            'description' => 'required'
        );
    }



}