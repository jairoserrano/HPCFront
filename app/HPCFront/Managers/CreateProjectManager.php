<?php namespace HPCFront\Managers;

use HPCFront\Entities\Project;

class CreateProjectManager extends BaseManager implements ManagerInterface
{

    function getRules()
    {
        return array(
            'name' => 'required',
            'description' => 'required'
        );
    }

}