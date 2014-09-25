<?php namespace HPCFront\Entities;


class Job extends \Eloquent {

    protected $fillable = ['name', 'description', 'type', 'project_id', 'executable'];

    public function entries(){
        return $this->hasMany('\HPCFront\Entities\Entry');
    }

    public function results(){
        return $this->hasMany('\HPCFront\Entities\Result');
    }

    public function project(){
        return $this->belongsTo('\HPCFront\Entities\Project');
    }
} 