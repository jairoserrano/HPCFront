<?php namespace HPCFront\Managers;

use Illuminate\Filesystem\Filesystem as File;

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