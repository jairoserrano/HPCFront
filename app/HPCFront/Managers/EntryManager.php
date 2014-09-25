<?php namespace HPCFront\Managers;


class EntryManager extends BaseManager{

    protected $filesRules;
    function getRules()
    {
        return array(
            'name'      => 'required',
            'path'      => 'required',
            'job_id'    => 'required|integer',
            'job_type'  => 'required'
        );
    }

}