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

        if ($score != "" && $participantID != "" && $round != "") {
            $result = saveSliderData($score, $round, $participantID);
            $resultArray = [
                "status" => $result ? 201 : 400,
                "score" => $score,
                "participantID" => $participantID,
                "round" => $round
            ];
            echo json_encode($resultArray);
        }
        else {
            $resultArray = [
                "status" => 404,
                "message" => "Could not complete Operation. Parameters missing!"
            ];
            echo json_encode($resultArray);
        }


    default:
        break;
}