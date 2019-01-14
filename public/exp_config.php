<?php
/**
 * Created by PhpStorm.
 * User: andreas
 * Date: 05.12.18
 * Time: 10:38
 */

require_once($_SERVER['DOCUMENT_ROOT'] . '/resources/config.php');

// include ("./templates/header.php");



$participantQuery = $connection->prepare("INSERT INTO participant (name) VALUES (?)");

$participantQuery->bind_param("s", $_GET['sname']);

$participantID = -1;
$experimentID = -1;

if ($participantQuery->execute()) {
    $participantID = $connection->insert_id;
    console_log(" Participant with id " . $participantID . " saved successfully");
}
else {
    echo "Error saving participant: " . $connection->error;
}

$experimentQuery = $connection->prepare("INSERT INTO experiment (exp_condition, participant) VALUES (?, ?)");

$experimentQuery->bind_param("ii", $condition, $participantID);

if ($experimentQuery->execute()) {
    $experimentID = $connection->insert_id;

    console_log(" Experiment data with ID " . $experimentID . " saved successfully! \n");


}
else {
    echo "Error saving experiment data: " . $connection->error . "\n";
}

include ("dataLoader.php");
//header("Location: include/experiment/index.php?round=1&mode=1&data=" . $data);

echo ("
   <form action='include/experiment/index.php?round=1&mode=1&expid=$experimentID&pid=$participantID' method='post'>
   <input type='hidden' value='$data' id='data' name='data' >
   <input type='hidden' value='$roundData' id='roundData' name='roundData'>
   <input type='submit' value='Start Experiment!'>
</form>
");