<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/code/requirements_all.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/public/templates/head.php");


$participantID = getParamValue("i");
$action = getParamValue("action");
$page = getParamValue("page");
$round = getParamValue("round", -1);

switch ($page) {
    case "slider":
        include("page/slider.php");
        break;
    case "audit":
        include("page/audit.php");
        //audit
        break;
    case "feedback":
        //feedback
        include("page/feedback.php");
        break;
    default:
        include("page/explanation.php");
        break;

}


