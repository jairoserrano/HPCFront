<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */


    protected $jobTypes;

    protected function setJobTypes(){
        $this->jobTypes = array(
            'java'      => 'Java',
            'php'       => 'PHP',
            'python'    => 'Python',
            'bash'      => 'Bash',
            'cpp'       => 'C++',
        );
    }


}
