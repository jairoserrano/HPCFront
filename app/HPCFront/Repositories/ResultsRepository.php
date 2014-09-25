<?php namespace HPCFront\Repositories;

use HPCFront\Entities\Result;

class ResultsRepository extends BaseRepository{

    public function getEntity()
    {
        return new Result();
    }
}