<?php
/**
 * Created by PhpStorm.
 * User: andreas
 * Date: 05.12.18
 * Time: 10:38
 */

require_once($_SERVER['DOCUMENT_ROOT'] . '/resources/config.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/resources/code/code.php');



// include ("./templates/header.php");

$prolificPID = getParamValue('prolificPID');
$studyID = getParamValue('studyID');
$sessionID = getParamValue('sessionID');
$userAgent = $_SERVER['HTTP_USER_AGENT'];
if (!isset($connection)) {
    $connection = new mysqli(DB_Host, DB_User, DB_Password, DB_Name);
    //echo "Reestablished connection";
}

$subjectName = $_GET['sname'];

$participantQuery = $connection->prepare("INSERT INTO participant (name) VALUES (?)");

$participantQuery->bind_param("s", $subjectName);

$participantID = -1;
$experimentID = -1;

if ($participantQuery->execute()) {
    $participantID = $connection->insert_id;
    console_log(" Participant with id " . $participantID . " saved successfully");
}
else {
    echo "Error saving participant: " . $connection->error;
    var_dump($participantQuery);
    die;
}

$riskAversionQuery = $connection->prepare("UPDATE risk_aversion SET subject_id = (?) WHERE subject_name = (?)");

$riskAversionQuery->bind_param('is', $participantID, $subjectName);

$experimentQuery = $connection->prepare("INSERT INTO experiment (exp_condition, participant, prolific_pid, study_id, session_id, device_type) VALUES (?, ?, ?, ?, ?, ?)");

$experimentQuery->bind_param("iissss", $condition, $participantID, $prolificPID, $studyID, $sessionID, $userAgent);

if ($experimentQuery->execute()) {
    $experimentID = $connection->insert_id;

    console_log(" Experiment data with ID " . $experimentID . " saved successfully! \n");
}
else {
    echo "Error saving experiment data: " . $connection->error . "\n";
}

$dateQuery = $connection->prepare("UPDATE experiment SET start = NOW() WHERE id = ?");
$dateQuery->bind_param("i", $experimentID);

if ($dateQuery->execute()) {
    console_log("Added start date for Experiment $experimentID");
}
else {
    echo "Error setting start date for experiment $experimentID: $connection->error";
}

$randomArray = getRandomOrder($connection, $experimentID);

$randomRoundOrder = getRandomOrder($connection, $experimentID)['roundOrder'];
$randomConditionOrder = getRandomOrder($connection, $experimentID)['conditionOrder'];

include ("dataLoader.php");

$condition = $dataArray['condition'];
$feedback = $dataArray['feedback'];
$order = $dataArray['order'];
$presentation = $dataArray['presentation'];


include ("./templates/header.php");


        $condition = $_GET['condition'];
        if (!isset($condition) || $condition <= 0) {
            echo "WARNING: COULD NOT READ CONDITION!";
        }
        else {
            include ("include/intro/tut_reminder.php");
        }

echo ("
   <form action='include/experiment/index.php?round=1&mode=1&expid=$experimentID&pid=$participantID&condition=$condition&feedback=$feedback&order=$order&presentation=$presentation' method='post'>
   <input type='hidden' value='$data' id='data' name='data' >
   <input type='hidden' value='$roundData' id='roundData' name='roundData'>
   <label></label>
   <input type='submit' value='Experiment starten'>
</form>
");
include ("./templates/footer.php");