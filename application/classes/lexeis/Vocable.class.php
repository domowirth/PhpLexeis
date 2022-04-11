<?php
class Vocable {
    
    private $firstMeaning;
    private $secondMeaning;
    private $hint;
    
    public function __construct() {
        $this->firstMeaning = new Meaning();
        $this->secondMeaning = new Meaning();
    } 
    
    public function getFirstMeaning() {
        return $this->firstMeaning;
    }
    
    public function getSecondMeaning() {
        return $this->secondMeaning;
    }
    
    public function getHint() {
        return $this->hint;
    }
    
    public function setFirstMeaning($firstMeaning) {
        $this->firstMeaning = $firstMeaning;
    }
    
    public function setSecondMeaning($secondMeaning) {
        $this->secondMeaning = $secondMeaning;
    }
    
    public function setHint($hint) {
        $this->hint = $hint;
    }
    
    public function getSearchTerm() {
        return preg_replace("/ο |η |το |οι |τα /", "", $this->secondMeaning->toString());
    }
    
    public function getMeaning($n) {
        switch($n) {
            case 0:
                return $this->firstMeaning;
            default:
                return $this->secondMeaning;
        }
    }
    
    public function equals($vocable) {
        return $this->getFirstMeaning()->toString() == $vocable->getFirstMeaning()->toString();
    }
    
}
