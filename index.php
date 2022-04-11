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
        <title>Test</title>
    </head>
    <body>
        <div class="menu"><a href="list.php">Zur Liste</a> | <a href="lesson.php?lesson=1">Zur Lektion 1</a></div>
        <div class="wordspanel">
            <?php
            $i = 0;
            $a = rand(0, 1);
            $b = $a ? 0 : 1;
            $randomWords = $units->getRandomWords(12);
            $selectedWord = $randomWords[rand(0, 11)];
            echo '<div class="selected">Was heisst <span>' . $selectedWord->getMeaning($a)->toString() . '</span>?</div><div style="display: none" id="selected">' . $selectedWord->getMeaning($b)->toString() . '</div>';
            echo '<table>';
            foreach ($randomWords as $vocable) {
                if ($i % 2 == 0) {
                    echo '<tr>';
                }
                $anId = "t" . ($i + 1);
                echo '<td id="t' . ($i + 1) . '" class="word' . ($selectedWord->equals($vocable) ? ' hit' : '') . '" onclick="resolve(' . $anId . ')">' . $vocable->getMeaning($b)->toString() . '</td>';
                if ($i % 2 == 1) {
                    echo '</tr>';
                }
                $i++;
            }

            echo '</table>';
            ?>
        </div>
        <script>
            function resolve(id) {
                var text = $(id).html();
                var selected = $("#selected").html();
                if (text === selected) {
                    $(id).css("color", "white");
                    $(id).css("background-color", "#52c76f");
                    $(id).fadeOut(1000, function () {
                        location.reload()
                    })
                } else {
                    $(id).css("color", "black");
                    $(id).css("background-color", "#c75652");


                    $(".hit").css("color", "white");
                    $(".hit").css("background-color", "#52c76f");
                    
                    setTimeout(
                            function () {
                               location.reload();
                            }, 2000);
                }
            }
        </script>
    </body>
</html>
