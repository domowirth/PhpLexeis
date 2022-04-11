<?php

class Units {

    private $units;
    private $excludedUnits;

    public function __construct($excludedUnits) {
        $this->units = array();
        $this->excludedUnits = $excludedUnits;
    }

    public function addUnit($unit) {
        if (!in_array($unit->getTitle(), $this->excludedUnits)) {
            array_push($this->units, $unit);
        }
    }

    public function getUnits() {
        return $this->units;
    }

    public function getRandomWords($amount) {
        $randomList = array();
        foreach ($this->units as $unit) {
            foreach ($unit->getVocables() as $vocable) {
                array_push($randomList, $vocable);
            }
        }
        shuffle($randomList);
        return array_slice($randomList, 0, $amount);
    }

    public function getLesson($name, $ordered) {
        $list = array();
        foreach ($this->units as $unit) {
            if($name == $unit->getTitle()) {
                foreach ($unit->getVocables() as $vocable) {
                    array_push($list, $vocable);
                }
            }
        }
        if($ordered) {
            usort($list, function($a, $b) {
                return strcmp(strtolower($a->getFirstMeaning()->toString()), strtolower($b->getFirstMeaning()->toString()));                
            });
        }
        return $list;
    }

}
