<?php

class Meaning {
    
    private $values;
    
    public function __construct() {
        $this->values = array();
    }
    
    public function addValue($value) {
        array_push($this->values, $value);
    }
    
    public function toString() {
        return implode(" / ", $this->values);
    }
}
