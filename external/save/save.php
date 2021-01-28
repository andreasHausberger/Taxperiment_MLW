<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/code/requirements_all.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/code/code.php");

$action = postParamValue("action");
$db = new Database();
$qb = new QueryBuilder("audit");

switch ($action) {
    case "ajax_slider":
        $score = postParamValue("score");
        $participantID = postParamValue("id");
        $round = postParamValue("round");
        echo json_encode(["score" => $score, "participant_id" => $participantID]);
    default:
        break;
}