<?php

namespace App\Traits;

trait RegisterVariableTrait{

    protected $register_global;
    public function setRegister($register){
        $this->register_global = $register;

    }
    public function getRegister(){
        return $this->register_global;
    }
}