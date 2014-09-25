<?php namespace HPCFront\Entities;


class Entry extends \Eloquent {

    protected $table    = 'entries';
    protected $fillable = ['name', 'path', 'job_id'];

    public function job(){
        return $this->belongsTo('\HPCFront\Entities\Job');
    }
} 