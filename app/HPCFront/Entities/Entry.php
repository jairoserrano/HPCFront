<?php namespace HPCFront\Entities;


class Entry extends \Eloquent {

    protected $fillable = ['name', 'description'];

    public function job(){
        return $this->belongsTo('\HPCFront\Entities\Job');
    }
} 