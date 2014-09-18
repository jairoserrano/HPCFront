<?php
/**
 * Created by PhpStorm.
 * User: perseus
 * Date: 18/09/14
 * Time: 11:35 AM
 */

namespace HPCFront\Managers;


class UpdateProjectManager extends BaseManager implements ManagerInterface
{

    function getRules()
    {
        return array(
            'name' => 'required|max:12',
            'description' => 'min:1'
        );
    }
}