<?php namespace HPCFront\Managers;


class UpdateEntriesManager extends BaseManager implements ManagerInterface{

    function getRules()
    {
        return array(
            'name'          => 'required',
            'path'          => '',
        );
    }

} 