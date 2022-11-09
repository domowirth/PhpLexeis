<?php

class Session {

    public function retrieveFileName() {
        session_start();
        $fileName = filter_input(INPUT_GET, "file");
        if (empty($fileName)) {
            if (isset($_SESSION["file"])) {
                $fileName = $_SESSION["file"];
            } else {
                $fileName = "backup.xml";
            }
        } else {
            $_SESSION["file"] = $fileName;
        }
        return $fileName;
    }

}
