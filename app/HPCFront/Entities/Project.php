<?php namespace HPCFront\Entities;

class Project extends BaseEntity implements EntityInterface {

	protected $fillable = ['name', 'description', 'user_owner'];

    public function jobs(){
        return $this->hasMany('\HPCFront\Entities\Job');
    }

}