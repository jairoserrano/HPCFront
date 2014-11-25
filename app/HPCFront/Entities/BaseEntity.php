<?php namespace HPCFront\Entities;

use Carbon\Carbon;

abstract class BaseEntity extends \Eloquent{

    protected $publicDateFormat = 'd F Y H:i';
    protected $serverDateFormat = 'Y-m-d H:i:s';

    public function getCreatedAtAttribute($created_at) {

        return $this->isDateZero($created_at) ? "" : Carbon::createFromFormat($this->serverDateFormat, $created_at)->format($this->publicDateFormat);
    }

    public function getUpdatedAtAttribute($updated_at) {

        return $this->isDateZero($updated_at) ? "" : Carbon::createFromFormat($this->serverDateFormat, $updated_at)->format($this->publicDateFormat);
    }

    protected function isDateZero($date){
        return $date == "0000-00-00 00:00:00" || $date == ""  ? true : false ;
    }

    protected function isEmptyField($field){
        return is_null($field) || empty($field) || $field == '' ? true :false;
    }
} 