<?php namespace HPCFront\Managers;


class JobManager extends BaseManager implements ManagerInterface {

    function getRules()
    {
        return array(
            'name'          => 'required',
            'description'   => 'required',
            'type'          => 'required',
            'project_id'    => 'required|integer',
            'executable'    => 'required|',
        );
    }

}