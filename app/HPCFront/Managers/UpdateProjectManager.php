<?php

namespace HPCFront\Managers;


class UpdateProjectManager extends BaseManager implements ManagerInterface
{

    function getRules()
    {
        return array(
            'name' => 'required',
            'description' => 'required',
        );

    }
}