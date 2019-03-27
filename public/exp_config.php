<?php
/**
 * Created by PhpStorm.
 * User: andreas
 * Date: 05.12.18
 * Time: 10:38
 */

require_once($_SERVER['DOCUMENT_ROOT'] . '/resources/config.php');

// include ("./templates/header.php");



$participantQuery = $connection->prepare("INSERT INTO participant (name, testweek) VALUES (?, ?)");

$participantQuery->bind_param("si", $_GET['sname'], $_GET['tw']);

$participantID = -1;
$experimentID = -1;

if ($participantQuery->execute()) {
    $participantID = $connection->insert_id;
    console_log(" Participant with id " . $participantID . " saved successfully");
}
else {
    echo "Error saving participant: " . $connection->error;
    var_dump($participantQuery);
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

$condition = $dataArray['condition'];
$feedback = $dataArray['feedback'];
$order = $dataArray['order'];
$presentation = $dataArray['presentation'];


include ("./templates/header.php");
echo ("
   <form action='include/experiment/index.php?round=1&mode=1&expid=$experimentID&pid=$participantID&condition=$condition&feedback=$feedback&order=$order&presentation=$presentation' method='post'>
   <input type='hidden' value='$data' id='data' name='data' >
   <input type='hidden' value='$roundData' id='roundData' name='roundData'>
   <label></label>
   <input type='submit' value='Start Experiment!'>
</form>
");
include ("./templates/footer.php");