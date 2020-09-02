<?php
/**
 * Created by PhpStorm.
 * User: andreas
 * Date: 10.12.18
 * Time: 09:28
 */


$index = isset($_GET['page']) ? $_GET['page'] : -1;
$condition = isset($_GET['condition']) ? $_GET['condition'] : -1;
$participant = isset($_GET['sname']) ? $_GET['sname'] : "";

$prolificPID = isset($_GET['prolificPID']) ? $_GET['prolificPID'] : "";
$studyID = isset($_GET['studyID']) ? $_GET['studyID'] : "";
$sessionID = isset($_GET['sessionID']) ? $_GET['sessionID'] : "";



$pages = array(
    -1 => "error.html",
    1 => "tutorial2.php",
    2 => "tutorial3.php",
    3 => "tutorial5.php",
    4 => "sliderTutorial1.php",
    5 => "tutorial6.php",
    6 => "exam1.php",
    7 => "tutorial_end.php"
);

$page = $pages[$index];

if ($condition == -1) {
    echo "Something went wrong: Index is " . $index . " and condition is " . $condition;
}
else {
    if ($index == 8) {
        require_once ("../../templates/header.php");

        include($page);
        include("../../templates/redirect.php");


        require_once ("../../templates/footer.php");}

    else {
        require_once ("../../templates/header.php");

        include($page);

        include("../../templates/continue.php");


        require_once ("../../templates/footer.php");

    }
}


?>