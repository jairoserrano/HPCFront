<?php namespace HPCFront\Entities;


class Result extends \Eloquent{

    protected $fillable = array('name', 'path');

    public function job()
    {
        return $this->belongsTo('\HPCFront\Entities\Job');

    }

} 