<?php namespace HPCFront\Repositories;

interface RepositoryInterface {

    public function all();

    public function find($id);
} 