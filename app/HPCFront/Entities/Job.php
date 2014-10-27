<?php namespace HPCFront\Entities;


class Job extends BaseEntity implements EntityInterface {

    protected $fillable = ['name', 'description', 'project_id', 'executable_id'];

    public function entries(){
        return $this->hasMany('\HPCFront\Entities\Entry');
    }

    public function executable(){
        return $this->hasOne('\HPCFront\Entities\Executable');
    }

    public function project(){
        return $this->belongsTo('\HPCFront\Entities\Project');
    }
} 