<?php namespace HPCFront\Managers;


use CobraYa\Managers\ValidationException;

abstract class BaseManager
{

    protected $entity;
    protected $rules;

    abstract function getRules();

    function __construct($entity, $input)
    {
        $this->entity = $entity;
        $this->rules = $this->getRules();
        $this->data = array_only($input, array_keys($this->rules));
    }

    public function save()
    {
        $project = $this->entity->fill($this->data);
        $project->save();
    }

    public function isValid()
    {
        $validation = \Validator::make($this->data, $this->rules);

        if ($validation->fails()) {
            throw new ValidationException('Validation failed', $validation->messages());
        }

    }

} 