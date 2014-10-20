<?php namespace HPCFront\Entities;


class Job extends BaseEntity implements EntityInterface {

    protected $fillable = ['name', 'description', 'type', 'project_id', 'executable'];

    public function entries(){
        return $this->hasMany('\HPCFront\Entities\Entry');
    }

    public function project(){
        return $this->belongsTo('\HPCFront\Entities\Project');
    }
} 