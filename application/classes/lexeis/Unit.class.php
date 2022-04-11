<?php

class Unit {
    
    private $title;
    
    private $vocables;
    
    public function __construct() {
        $this->vocables = array();
    }
    
    public function getTitle() {
        return $this->title;
    }
    
    public function getVocables() {
        return $this->vocables;
    }
    
    public function setTitle($title) {
        $this->title = $title;
    }

    public function addVocable($vocable) {
        array_push($this->vocables, $vocable);
    }
    
}