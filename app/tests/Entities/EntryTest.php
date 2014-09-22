<?php
use Way\Tests\ModelHelpers;
use HPCFront\Entities\Entry;

class EntryTest extends TestCase {
    use ModelHelpers;
    protected $entity;

    public function setUp(){
        parent::setUp();

        $this->entity = new Entry();
    }

    public function testEntryHasFillableAttribute(){
        $this->assertClassHasAttribute('fillable', 'HPCFront\Entities\Entry');
    }

    public function testEntryBelongToJobs(){
        $this->assertBelongsTo('job', 'HPCFront\Entities\Entry');
    }
}
 