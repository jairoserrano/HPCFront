<?php namespace HPCFront\Managers;

abstract class BaseManager
{

    protected $entity;
    protected $rules;
    protected $project_path;

    abstract function getRules();

    function __construct($entity, $input)
    {
        $this->entity = $entity;
        $this->rules = $this->getRules();
        $this->data = array_only($input, array_keys($this->rules));
        //dd($this->data);
    }

    public function save()
    {
        $this->isValid();
        $this->entity->fill($this->data);

        $newEntity = $this->entity->save();

        return $newEntity;
    }

    public function isValid()
    {
        $validation = \Validator::make($this->data, $this->rules);
        if ($validation->fails()) {
            throw new ValidationException('Validation failed', $validation->messages());
        }

    }



} 