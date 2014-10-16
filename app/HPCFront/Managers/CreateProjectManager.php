<?php namespace HPCFront\Managers;

use Illuminate\Filesystem\Filesystem as File;

class CreateProjectManager extends BaseManager implements ManagerInterface
{

    function getRules()
    {
        return array(
            'name' => 'required',
            'description' => 'required',
            'user_owner' => 'required',
        );
    }

}