<?php

class LexeisParser {

    private $parser;
    private $units;
    private $unit;
    private $vocable;
    private $meaning;
    private $target;
    private $chars;

    public function __construct() {
        $this->parser = xml_parser_create();

        $this->units = null;
        $this->unit = null;
        $this->vocable = null;
        $this->meaning = null;
        $this->target = "";
        $this->chars = "";

        xml_set_element_handler($this->parser, array($this, 'startElement'), array($this, 'endElement'));
        xml_set_character_data_handler($this->parser, array($this, 'characters'));
    }

    private function startElement($parser, $element_name, $element_attrs) {

        switch ($element_name) {
            case "UNITS":
                $this->units = new Units(array("13", "14"));
                break;
            case "UNIT":
                $this->unit = new Unit();                
                break;
            case "TITLE":
                $this->target = "T";
                break;
            case "VOCABLES":
                break;
            case "VOCABLE":
                $this->vocable = new Vocable();
                $this->unit->addVocable($this->vocable);
                break;
            case "FIRST_MEANING":
                $this->meaning = $this->vocable->getFirstMeaning();
                break;
            case "SECOND_MEANING":
                $this->meaning = $this->vocable->getSecondMeaning();
                break;
            case "VALUE":
                $this->target = "V";
                break;
            case "HINT":
                $this->target = "H";
                break;
        }
    }

    private function endElement($parser, $element_name) {

        $trimmed = trim($this->chars);
        switch ($this->target) {
            case "T":
                $this->unit->setTitle($trimmed);
                $this->units->addUnit($this->unit);
                break;
            case "V":
                $this->meaning->addValue($trimmed);
                break;
            case "H":
                $this->vocable->setHint($trimmed);
                break;
        }
        $this->chars = "";
        $this->target = "";
    }

    private function characters($parser, $data) {

        $this->chars .= $data;
    }

    public function parse($filePath) {
        $fp = fopen($filePath, "r");
        $firstChunk = true;
        while ($data = fread($fp, 4096)) {
            if ($firstChunk) {
                $data = str_replace("UTF-16", "UTF-8", $data);
            }
            xml_parse($this->parser, $data, feof($fp)) or
                    die(sprintf("XML Error: %s at line %d", xml_error_string(xml_get_error_code($this->parser)), xml_get_current_line_number($this->parser)));
            $firstChunk = false;
        }
        xml_parser_free($this->parser);
        fclose($fp);

        return $this->units;
    }

}
