<?php

use Way\Tests\ModelHelpers;
use HPCFront\Entities\Result;

class ResultTest extends TestCase {
    use ModelHelpers;
    protected $entity;

    public function setUp(){
        parent::setUp();

        $this->entity = new Result();
    }

    public function testResultHasFillableAttribute(){
        $this->assertClassHasAttribute('fillable', 'HPCFront\Entities\Result');
    }


    public function testResultBelongToJobs(){
        $this->assertBelongsTo('job', 'HPCFront\Entities\Result');
    }
}
 