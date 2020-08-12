<?php
/**
 * Created by PhpStorm.
 * User: andreas
 * Date: 03.01.19
 * Time: 15:26
 */

/*
 * This should be called everytime experiment/index.php is called, to re-fetch the round data.
 * Thus, the actuality of data is ensured.
 *
 * THIS FILE DOES NOT SAVE ANYTHING.
 */

// require("../resources/config.php"); // establishes connection, just in case

$conditionQuery = $connection->prepare("SELECT * FROM exp_condition AS c WHERE c.id = (?)");
$conditionQuery->bind_param('s', $_GET['condition']);
$conditionData; $tutorial;

if ($conditionQuery->execute()) {
    console_log( "executed conditionQuery");
    if($conditionQuery->bind_result($condition, $order, $feedback, $presentation, $tutorial)) {
        console_log("loaded condition data successfully!");

        while ($conditionQuery->fetch()) {
            $conditionData = array(0 => $condition, 1 => $order, 2 => $feedback, 3 => $presentation, 4 => $tutorial);
        }

    }
    else {
        console_log("[ERROR] Could not bind condition result to variables!");
    }
    console_log("condition data for condition " . $condition . " loaded successfully");
}
else {
    echo "Connection error while retrieving condition: " . $connection->error;
}

$experimentQuery = $connection->prepare("SELECT * FROM experiment WHERE id = (?)");

$experimentQuery->bind_param("i", $experimentID);

if ($experimentQuery->execute()) {
    console_log("loaded experiment data successfully");
    $experimentQuery->bind_result($temp_eid, $temp_pid, $temp_cid);

    while ($experimentQuery->fetch()) {
        $experimentData = array(0 => $temp_eid, 1 => $temp_pid, 2 => $temp_cid);
    }
}
else {
    echo "Connection error while retrieving experiment: " . $connection->error;
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
    "pname" => $_GET['sname'],
    "pid" => $participantID,
    "expID" => $experimentID,
    "condition" => $conditionData[0],
    "feedback" => $conditionData[2],
    "order" => $conditionData[1],
    "presentation" => $conditionData[3]
);


$data = http_build_query(array('data' => $dataArray));
$roundData = http_build_query(array('data' => $expRounds));