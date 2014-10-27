<?php

class BaseController extends Controller {

    protected function getJobTypes(){
        return array(
            'java'      => 'Java',
            'php'       => 'PHP',
            'python'    => 'Python',
            'bash'      => 'Bash',
            'cpp'       => 'C++',
        );
    }


}
