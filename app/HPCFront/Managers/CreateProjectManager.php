<?php namespace HPCFront\Managers;

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