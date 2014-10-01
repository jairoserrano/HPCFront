<?php namespace HPCFront\Managers;


class CreateEntriesManager extends BaseManager implements ManagerInterface{

    function getRules()
    {
        return array(
            'name'          => 'required',
            'description'   => 'required',
            'path'          => 'required',
            'job_id'        => 'required'
        );
    }
}