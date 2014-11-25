<?php
/**
 * Created by PhpStorm.
 * User: perseus
 * Date: 21/10/14
 * Time: 2:36 PM
 */

namespace HPCFront\Managers;


class EntryManager extends BaseManager{

    function getRules()
    {

    }

    public function getEntriesPath($job_id){
        return $this->getJobsRootFolder($job_id) . "/entries/";
    }

    public function getResultsPath($job_id){
        return $this->getJobsRootFolder($job_id) . "/results/";
    }

    public function getJobsRootFolder($job_id){
        return storage_path() . "/jobs/$job_id";
    }

}