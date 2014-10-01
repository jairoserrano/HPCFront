<?php
/**
 * Created by PhpStorm.
 * User: perseus
 * Date: 30/09/14
 * Time: 3:42 PM
 */

namespace HPCFront\Managers;


class UpdateJobManager extends BaseManager{

    function getRules()
    {
        return array(
            'name'          => 'required',
            'description'   => 'required',
            'type'          => 'required',
            'executable'    => '',
        );
    }
} 