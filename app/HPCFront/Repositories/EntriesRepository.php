<?php namespace HPCFront\Repositories;

use HPCFront\Entities\Entry;

class EntriesRepository extends BaseRepository{

    public function getEntity()
    {
        return new Entry();
    }
}