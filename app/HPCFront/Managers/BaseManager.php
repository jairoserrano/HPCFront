<?php namespace HPCFront\Managers;


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
        $this->isValid();
        $this->entity->fill($this->data);
        $this->entity->save();

        return true;
    }

    public function isValid()
    {
        $validation = \Validator::make($this->data, $this->rules);
        if ($validation->fails()) {
            throw new ValidationException('Validation failed', $validation->messages());
        }

    }

} 