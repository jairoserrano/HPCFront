<?php namespace HPCFront\Managers;

use Illuminate\Http\Request as Input;
use Illuminate\Filesystem\Filesystem as File;
use HPCFront\Entities\EntityInterface;

abstract class BaseManager
{

    private $entity;
    private $data;
    private $input;
    protected $file;
    protected $project_path;


    abstract function getRules();

    function __construct(EntityInterface $entity, Input $input)
    {
        $this->file = New File();
        $this->setEntity($entity);
        $this->setInput($input);
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

    public function getInput(){
        return $this->input;
    }

    /**
     * @param mixed $entity
     */
    protected function setEntity( EntityInterface $entity)
    {
        $this->entity = $entity;
    }

    protected function setInput(Input $input){
        $this->input = $input;
    }
    protected function setNewData($name, $content){
        $this->data[$name] = $content;
    }
}
