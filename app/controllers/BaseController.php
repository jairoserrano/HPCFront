<?php

class BaseController extends Controller {

    protected function getJobTypes(){
        return array(
            'java'      => 'Java',
            'js'       => 'Javascript',
        );
    }

}
