<?php
/**
 * Created by PhpStorm.
 * User: perseus
 * Date: 15/10/14
 * Time: 10:38 AM
 */

namespace HPCFront\Entities;


interface EntityInterface {
    public function getCreatedAtAttribute($created_at);
    public function getUpdatedAtAttribute($updated_at);
} 