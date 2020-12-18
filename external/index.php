<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/code/requirements_all.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/public/templates/head.php");


$participantID = getParamValue("i");
$action = getParamValue("action");
$page = getParamValue("page");

switch ($page) {
    case "slider":
        include("page/slider.php");
        break;
    case "audit":
        //audit
        break;
    case "feedback":
        //feedback
        break;
    default:
        include("page/explanation.php");
        break;

}


