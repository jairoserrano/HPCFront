<?php namespace HPCFront\Managers;


abstract class BaseManager {

    protected $entity;
    protected $rules;

    abstract function getRules();

    function __construct($entity, $input)
    {
        $this->entity = $entity;
        $this->rules = $this->getRules();
        $this->data = array_only($input, array_keys($this->rules));
    }

    public function save(){

        if($this->isValid()){

            $project = $this->entity->fill($this->data);
            $project->save();

            return true;

        }else{

            return false;
        }
    }

    public function isValid(){
        $validation = \Validator::make($this->data, $this->rules);

        if($validation->fails()){
            $this->setErrors($validation->messages());
            return false;
        }else{
            return true;
        }


    }

    /**
     * @return mixed
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @param mixed $errors
     */
    protected function setErrors($errors)
    {
        $this->errors = $errors;
    }

} 