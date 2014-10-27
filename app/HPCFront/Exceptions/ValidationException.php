<?php namespace HPCFront\Exceptions;


class ValidationException extends \Exception {

    protected $errors;

    public function __construct($message, $errors)
    {
        $this->errors = $errors;
        parent::__construct($message);
    }

    public function getErrors()
    {
        dd($this->errors);
        return $this->errors;
    }

} 