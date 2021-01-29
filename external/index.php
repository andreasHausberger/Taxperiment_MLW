<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/code/requirements_all.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/public/templates/head.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/code/code.php");

$db = new Database();
$qb = new QueryBuilder("participant");

$participantName = getParamValue("i");
$action = getParamValue("action");
$page = getParamValue("page");
$round = getParamValue("round", -1);

if ($participantName != "") {
    $existingParticipants = $db->selectQuery("SELECT p.name FROM participant p WHERE p.name = ?", "s", $participantName);
    $size = $existingParticipants ? sizeof($existingParticipants) : 0;
    if ($size == 0) {
        //add new participant
        if (createNewParticipant($participantName, $db, $qb)) {
            $idResult = $db->selectQuery("SELECT p.id FROM participant p WHERE p.name = ?", "s", $participantName);
            $participantID = $idResult["id"];
            createNewExperiment($participantID, 1, $db, $qb);
        }
    }
    else if ($size > 1) {
        //display warning instead of content page!
        echo createWarningHTML("Database Warning", "Could not create new participant. Name already in database!");

        die();
    }
}

$idResult = $db->selectQuery("SELECT p.id FROM participant p WHERE p.name = ?", "s", $participantName);
$participantID = $idResult["id"];

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


