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
        break;
    case "ajax_audit":
        $postArray = $_POST;
        $participantID = postParamValue('id');
        $round = postParamValue('round');

        if ($participantID != "" && $round != "" && sizeof($postArray) > 0) {
            $result = saveAuditData($round, $participantID, $postArray);
            $resultArray = [
                "status" => $result ? 201 : 400,
                "participantID" => $participantID,
                "round" => $round
            ];
            echo json_encode($resultArray);
        }
        else {
            $resultArray = [
                "status" => 404,
                "message" => "Could not complete Operation. Parameters missing"
            ];
            echo json_encode($resultArray);
        }
        break;
    case 'ajax_mlweb':
        //save mouselab data for round and participant.
        $participantID = postParamValue('subject_id');
        $paraExperimentID = postParamValue('experiment_id');
        $round = postParamValue('round');
        $procData = postParamValue('procdata');
        $choice = postParamValue('choice');

        saveMlwebData($paraExperimentID, $participantID, '', '1', $choice, $round, $procData);

        break;
    default:
        break;
}