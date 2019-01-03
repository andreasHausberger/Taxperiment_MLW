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

$conditionQuery = $connection->prepare("SELECT * FROM exp_condition AS c WHERE c.id = (?)");
$conditionQuery->bind_param('s', $_GET['condition']);

if ($conditionQuery->execute()) {
    console_log( "executed conditionQuery");
    if($conditionQuery->bind_result($condition, $order, $feedback, $presentation)) {
        console_log("loaded condition data successfully!");

        while ($conditionQuery->fetch()) {
            $conditionData = array(0 => $condition, 1 => $order, 2 => $feedback, 3 => $presentation);
        }

    }
    console_log("condition data for condition " . $condition . " loaded successfully");
}
else {
    echo "Connection error while retrieving condition: " . $connection->error;
}

$roundQueryAsc = "SELECT * FROM exp_round ORDER BY id ASC";
$roundQueryDesc = "SELECT * FROM exp_round ORDER BY id DESC";

$roundsResult = $connection->query($conditionData[1] == 0 ? $roundQueryAsc : $roundQueryDesc);
global $expRounds, $dataArray;

if ($roundsResult->num_rows > 0) {
    while ($row = $roundsResult->fetch_assoc()) {

        $expRounds[] = $row;
    }
    console_log("loaded rounds in order " . ($conditionData[1] == 0 ? 'standard' : 'reverse') . " \n");
}
else {
    echo "Connection error: " . $connection->error;
}

$roundNr = 1;
$dataArray = array(
        "test" => "test",
        "pname" => $_GET,
        "pid" => $participantID,
        "expID" => $experimentID,
        "condition" => $conditionData[0],
        "feedback" => $conditionData[2],
        "order" => $conditionData[1],
        "presentation" => $conditionData[3]
);

$data = http_build_query(array('data' => $dataArray));

header("Location: include/experiment/index.php?round=1&mode=1&data=" . $data);
die();
