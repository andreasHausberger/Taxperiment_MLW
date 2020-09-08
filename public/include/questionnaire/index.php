<?php
/**
 * Created by PhpStorm.
 * User: andreas
 * Date: 10.12.18
 * Time: 09:28
 */

$index = isset($_GET['page']) ? $_GET['page'] : -1;
$participant = isset($_GET['pid']) ? $_GET['pid'] : "";

$experimentId = $_GET["expid"];


if ($participant == "" || !isset($participant)) {
    echo "Problem: No participant ID is found!";
}

$pages = array(
    -1 => "error.html",
    1 => "memAttn.php",
    2 => "patriotism.php",
    3 => "honesty_other.php",
    4 => "honesty_self.php",
    5 => "trust.php",
    6 => "risk.php",
    7 => "greed.php",
    8 => "demographics.php",
    9 => "tech.php",
    10 => "end.php"
);

$page = $pages[$index];
if (!function_exists("createLikert")) {
    function createLikert($number, $name)
    {
        $html = "";


        $count = 1;
        while ($count <= $number) {
            $html = $html . " <div class=\"radioItemFlex\" >
                    <input type=\"radio\" name=\"$name\" value=\"$count\" onclick=\"addToArray('$name')\"}>
                    <p> $count </p>
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