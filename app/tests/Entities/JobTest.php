<?php

use Way\Tests\ModelHelpers;
use HPCFront\Entities\Job;

class JobTest extends TestCase {
    use ModelHelpers;
    protected $entity;

    public function setUp(){
        parent::setUp();

        $this->entity = new Job();
    }

    public function testJobHasFillableAttribute(){
        $this->assertClassHasAttribute('fillable', 'HPCFront\Entities\Job');
    }

    public function testJobHasManyEntries(){
        $this->assertHasMany('entries', 'HPCFront\Entities\Job');
    }

    public function testJobHasManyResults(){
        $this->assertHasMany('results', 'HPCFront\Entities\Job');
    }

    public function testJobBelongsToProject(){
        $this->assertBelongsTo('project', 'HPCFront\Entities\Job');
    }
}
 