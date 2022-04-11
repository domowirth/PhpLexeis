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
    
    $parser = new LexeisParser();
    $units = $parser->parse("backup.xml");
    
?><!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="js/jquery-3.1.1.min.js"></script>
        <link rel="stylesheet" type="text/css" href="css/phplexeis.css"> 
        <script type="text/javascript">
            function show(id) {
                $("#" + id).css("color", "#fff");
            }

            function hide(id) {
                $("#" + id).css("color", "#666");
            }
        </script>
        <title>Liste</title>
    </head>
    <body>
        <div class="menu"><a href="index.php">Zum Test</a></div>
        <div class="wordspanel">
            <?php
            echo '<table>';
            $id = 1;
            $randomWords = $units->getRandomWords(12);
            foreach ($randomWords as $vocable) {
                echo '<tr><td class="word">';
                if (rand() % 2 == 0) {
                    echo $vocable->getFirstMeaning()->toString() . '</td><td id="' . $id . '" class="word covered" onmouseover="show(' . $id . ')" onmouseout="hide(' . $id . ')">' . $vocable->getSecondMeaning()->toString();
                } else {
                    echo $vocable->getSecondMeaning()->toString() . '</td><td id="' . $id . '" class="word covered" onmouseover="show(' . $id . ')" onmouseout="hide(' . $id . ')">' . $vocable->getFirstMeaning()->toString();
                }
                echo '</td><td class="link"><a href="http://www.greek-language.gr/greekLang/modern_greek/tools/lexica/triantafyllides/search.html?loptall=true&lq=' . $vocable->getSearchTerm() . '">?</a></td></tr>';
                $id++;
            }
            echo '<tr><td class="navi" colspan="3"><a href="#" onclick="location.reload();">Neue Auswahl</a></td</tr>';
            echo '</table>';
            ?>
        </div>
    </body>
</html>
