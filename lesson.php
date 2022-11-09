<?php
header('Content-Type: text/html; charset=UTF-8');
error_reporting(E_ALL);
ini_set('display_errors', '1');
setlocale(LC_ALL, 'de_CH');

require_once 'application/classes/lexeis/Vocable.class.php';
require_once 'application/classes/lexeis/Meaning.class.php';
require_once 'application/classes/lexeis/Unit.class.php';
require_once 'application/classes/lexeis/Units.class.php';
require_once 'application/classes/lexeis/LexeisParser.class.php';
require_once 'application/classes/lexeis/Session.class.php';

$session = new Session();
$fileName = $session->retrieveFileName();
$parser = new LexeisParser();
$units = $parser->parse($fileName);
?><!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="js/jquery-3.1.1.min.js"></script>
        <link rel="stylesheet" type="text/css" href="css/phplexeis.css"> 

        <title>Lektion <?= $_REQUEST['lesson'] ?> (<?= $fileName ?>)</title>
    </head>
    <body>
        <div class="menu"><a href="index.php">Zum Test</a> | <a href="list.php">Zur Zufallsliste</a></div>
        <div class="wordspanel">
            <?php
            echo '<table>';
            $id = 1;
            $words = $units->getLesson($_REQUEST['lesson'], true);
            foreach ($words as $vocable) {
                echo '<tr><td class="word">';
                echo $vocable->getFirstMeaning()->toString() . '</td><td id="' . $id . '" class="word">' . $vocable->getSecondMeaning()->toString();
                echo '</td><td class="link"><a href="http://www.greek-language.gr/greekLang/modern_greek/tools/lexica/triantafyllides/search.html?loptall=true&lq=' . $vocable->getSearchTerm() . '">?</a></td></tr>';
                $id++;
            }
            echo '</table>';
            ?>
        </div>
    </body>
</html>
