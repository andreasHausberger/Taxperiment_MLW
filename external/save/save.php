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
                "status" => $result,
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
            $status = 0;
            if ($result >= 0) {
                $status = 201;
            }
            else if ($result == -1) {
                $status == 400; //could not save due to missing values
            }
            else if ($result == -2) {
                $status = 409; //conflict - round data already exists
            }
            $resultArray = [
                "status" => $status,
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
        $condition = postParamValue('condition');

        $result = saveMlwebData($paraExperimentID, $participantID, '', $condition, $choice, $round, $procData);
        $resultArray = [];
        if ($result != -1) {
            $resultArray = [
                "status" => 201,
                "participantID" => $participantID,
                "round" => $round,
                "message" => "Saved MLWEB data successfully!"
            ];
        }
        else {
            $resultArray = [
                "status" => 400,
                "message" => "Could not complete Operation. An Error occurred!"
            ];
        }
        echo json_encode($resultArray);
        break;
    default:
        break;
}