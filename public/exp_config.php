<?php
/**
 * Created by PhpStorm.
 * User: andreas
 * Date: 05.12.18
 * Time: 10:38
 */

require_once($_SERVER['DOCUMENT_ROOT'] . "/code/Database.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/code/QueryBuilder.php");

$db = new Database();

// include ("./templates/header.php");

$prolificPID = getParamValue('prolificPID');
$studyID = getParamValue('studyID');
$sessionID = getParamValue('sessionID');
$condition = getParamValue('condition');
$userAgent = $_SERVER['HTTP_USER_AGENT'];
$height = postParamValue("screen_height");
$width = postParamValue("screen_width");

$resolution = $width . "x" . $height;

if (!isset($connection)) {
    $connection = new mysqli(DB_Host, DB_User, DB_Password, DB_Name);
    //echo "Reestablished connection";
}

$subjectName = getParamValue("sname");
$participantResult = $db->selectQuery("SELECT id FROM participant WHERE name = ? ORDER BY id DESC", "s", $subjectName);
$participantID = $participantResult["id"];

$experimentID = $db->insertQuery("INSERT INTO experiment (exp_condition, participant, prolific_pid, study_id, session_id, device_type, resolution) VALUES (?, ?, ?, ?, ?, ?, ?)", "iisssss", ...[$condition, $participantID, $prolificPID, $studyID, $sessionID, $userAgent, $resolution]);

$db->insertQuery("UPDATE experiment SET start = NOW() WHERE id = ?", "i", $experimentID);

$randomArray = getRandomOrder($connection, $experimentID);

$randomRoundOrder = getRandomOrder($connection, $experimentID)['roundOrder'];
$randomConditionOrder = getRandomOrder($connection, $experimentID)['conditionOrder'];

include ("dataLoader.php");

$condition = $dataArray['conditionData']["id"];
$feedback = $dataArray['conditionData']['feedback'];
$order = $dataArray['conditionData']['round_order'];
$presentation = $dataArray['conditionData']['presentation'];

header("Location: " . "include/experiment/index.php?round=1&mode=1&expid=$experimentID&pid=$participantID&condition=$condition&feedback=$feedback&order=$order&presentation=$presentation");