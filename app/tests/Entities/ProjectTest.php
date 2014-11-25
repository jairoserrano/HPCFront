<?php
use Way\Tests\ModelHelpers;
use HPCFront\Entities\Project;

class ProjectTest extends TestCase{
    use ModelHelpers;
    protected $entity;

    public function setUp(){
        parent::setUp();

        $this->entity = new Project();
    }

    public function testProjectHasFillableAttribute(){
        $this->assertClassHasAttribute('fillable', 'HPCFront\Entities\Project');
    }

    public function testProjectHasManyJobs(){
        $this->assertHasMany('jobs', 'HPCFront\Entities\Project');
    }

} 