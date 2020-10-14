<?php
/**
 * Created by PhpStorm.
 * User: andreas
 * Date: 10.12.18
 * Time: 09:28
 */

require_once( $_SERVER['DOCUMENT_ROOT'] . '/resources/code/code.php' );
require_once( $_SERVER['DOCUMENT_ROOT'] . '/resources/config.php');

$index = isset($_GET['page']) ? $_GET['page'] : -1;
$condition = isset($_GET['condition']) ? $_GET['condition'] : -1;
$participant = isset($_GET['sname']) ? $_GET['sname'] : "";


$pages = array(
    -1 => "error.html",
    1 => "tut_info.php",
    2 => "tut_agreement.php",
    3 => "tut_incentivization.php",
    4 => "tut_risk_aversion_task.php",
    5 => "tut_explanation_cond_1.php",
    6 => "tut_definitions.php", //this varies depending on the condition
    7 => "tut_explanation_mlw_exam1.php",
    8 => "tut_exam2.php",
    9 => "tut_reminder.php"
);

$page = $pages[$index];

if ($condition == -1) {
    echo "Something went wrong: Index is " . $index . " and condition is " . $condition;
}

else {

    if ($index == 4 || $index == 7 || $index == 8) {
        //risk aversion has its own Next button (submit, save, & redirect).
        //exams 1 and 2 have tax evade/pay buttons, which work as "Next" Buttons.

        require_once ("../../templates/header.php");

        include($page);

        require_once ("../../templates/footer.php");

    }
    else if ($index == 9) {
        require_once ("../../templates/header.php");

        include($page);
        include("../../templates/redirect.php");

        require_once ("../../templates/footer.php");
    }
    else {
        require_once ("../../templates/header.php");

        include($page);

        include("../../templates/continue.php");

        require_once ("../../templates/footer.php");
    }
}



?>