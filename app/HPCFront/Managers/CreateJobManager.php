<?php namespace HPCFront\Managers;


class CreateJobManager extends BaseManager implements ManagerInterface
{

    function getRules()
    {
        return array(
            'name'          => 'required',
            'description'   => 'required',
            'type'          => 'required',
            'project_id'    => 'required|integer',
            'executable'    => '',
        );
    }

}