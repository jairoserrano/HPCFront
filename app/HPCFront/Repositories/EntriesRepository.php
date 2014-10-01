<?php namespace HPCFront\Repositories;

use HPCFront\Entities\Entry;

class EntriesRepository extends BaseRepository{

    public function getEntity()
    {
        return new Entry();
    }

    public function getJobEntriesList($job_id){
        return $this->entity
            ->where('job_id','=', $job_id)
            ->lists('name', 'id');
    }

    public function findJobEntry($jobId, $entryId){
        return $this->entity
            ->where('id', '=', $entryId)
            ->where('job_id', '=', $jobId)
            ->first();
    }
}