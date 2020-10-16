<?php
/**
 * Created by PhpStorm.
 * User: andreas
 * Date: 10.12.18
 * Time: 09:28
 */

require_once($_SERVER['DOCUMENT_ROOT'] . "/code/Database.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/code/QueryBuilder.php");

$db = new Database();
$qb = new QueryBuilder("questionnaire");

$index = isset($_GET['page']) ? $_GET['page'] : -1;
$participant = isset($_GET['pid']) ? $_GET['pid'] : "";

$experimentId = $_GET["expid"];


if ($participant == "" || !isset($participant)) {
    echo "Problem: No participant ID is found!";
}

$pages = array(
    -1 => "error.html",
    1 => "manipulation.php",
    2 => "recall.php",
    3 => "knowledge.php",
    4 => "effort.php",
    5 => "numeracy.php",
    6 => "motivation.php",
    7 => "demographics.php",
    8 => "technical.php",
    9 => "end.php"
//    1 => "memAttn.php",
//    2 => "aboutExp.php",
//    3 => "numeracy.php",
//    4 => "cognitive.php",
//    5 => "risk.php",
//    6 => "motivation.php",
//    7 => "greed.php",
//    8 => "demographics.php",
//    9 => "end.php"
);

$page = $pages[$index];
if (!function_exists("createLikert")) {
    function createLikert($number, $name,  $labels = null)
    {
        $html = "";


        $count = 1;

        while ($count <= $number) {
            if ($labels && sizeof($labels) == $number) {
                $label = $labels[$count - 1];
            }
            else {
                $label = $count;
            }

            $html = $html . " <div class=\"radioItemFlex\" >
                    <input type=\"radio\" name=\"$name\" value=\"$count\" onclick=\"addToArray('$name')\"}>
                    <p> $label </p>
                   </div>";

            $count++;
        }

        return $html;
    }
}

if ($condition == -1) {
    echo "Something went wrong: Index is " . $index . " and condition is " . $condition;
}
else {

    require_once("../../templates/header.php");

    include($page);


    require_once("../../templates/footer.php");


}


?>