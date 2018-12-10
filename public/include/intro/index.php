<?php
/**
 * Created by PhpStorm.
 * User: andreas
 * Date: 10.12.18
 * Time: 09:28
 */

$index = isset($_GET['page']) ? $_GET['page'] : -1;

$pages = array(
    -1 => "error.html",
    1 => "tutorial1.php",
    2 => "tutorial2.php",
    3 => "tutorial3.php",
    4 => "tutorial4.php",
    5 => "tutorial5.php",
    6 => "sliderTutorial1.php",
    7 => "tutorial6.php",
    8 => "exam1.php"
);

$page = $pages[$index];

require_once ("../../templates/header.php");

include($page);
include("../../templates/continue.php");


require_once ("../../templates/footer.php");

?>