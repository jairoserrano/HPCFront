<?php namespace HPCFront\Entities;

class Project extends \Eloquent {

	protected $fillable = ['name', 'description'];

    public function jobs(){
        return $this->hasMany('\HPCFront\Entities\Job');
    }

}