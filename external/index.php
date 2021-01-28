<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/code/requirements_all.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/public/templates/head.php");

$db = new Database();
$qb = new QueryBuilder("participant");

$participantName = getParamValue("i");
$action = getParamValue("action");
$page = getParamValue("page");
$round = getParamValue("round", -1);

if ($participantName != "") {
    $existingParticipants = $db->selectQuery("SELECT * FROM participant p WHERE p.name = ?", "s", $participantName);
    $size = $existingParticipants ? sizeof($existingParticipants) : 0;
    if ($size == 0) {
        //add new participant
        $qb->addString("name", $participantName);
        $insert = $qb->buildInsert("");
        $db->insertQuery($insert, ['s']);
    }
    else if ($size > 1) {
        //TODO: Make this more graceful!
        echo "Could not save participant - duplicate names!";
        die();
    }
}

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


