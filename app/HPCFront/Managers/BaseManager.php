<?php namespace HPCFront\Managers;

use Illuminate\Http\Request as Input;
use HPCFront\Entities\EntityInterface;

abstract class BaseManager
{

    private $entity;
    private $data;
    protected $project_path;


    abstract function getRules();

    function __construct(EntityInterface $entity, Input $input)
    {
        $this->setEntity($entity);
        $this->setData($input->all());
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
        $validation = \Validator::make($this->data, $this->getRules());
        if ($validation->fails()) {
            throw new ValidationException('Validation failed', $validation->messages());
        }

    }

    protected function setData(Array $data)
    {
        $this->data = array_only($data, array_keys($this->getRules()));
    }

    /**
     * @return mixed
     */
    protected function getData()
    {
        return $this->data;
    }

    /**
     * @return mixed
     */
    public function getEntity()
    {
        return $this->entity;
    }

    /**
     * @param mixed $entity
     */
    protected function setEntity( EntityInterface $entity)
    {
        $this->entity = $entity;
    }



} 