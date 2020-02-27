<?php
/**
 * Created by PhpStorm.
 * User: andreas
 * Date: 03.01.19
 * Time: 15:26
 */

/*
 * This should be called every time experiment/index.php is called, to re-fetch the round data.
 * Thus, the actuality of data is ensured.
 *
 * THIS FILE DOES NOT SAVE ANYTHING.
 */

$conditionQuery = $connection->prepare("SELECT * FROM exp_condition AS c WHERE c.id = (?)");
$conditionQuery->bind_param('s', $_GET['condition']);
$conditionData;

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
global $expRounds, $dataArray;

$roundQueryAsc = "SELECT * FROM exp_round";

$roundsResult = $connection->query($roundQueryAsc);
global $expRounds, $dataArray;

if ($roundsResult->num_rows > 0) {
    while ($row = $roundsResult->fetch_assoc()) {
        $expRounds[] = $row;
    }
}
else {
    echo "Connection error: " . $connection->error;
}

$test = getRandomOrder($connection, $experimentID);

$roundOrder = getRandomOrder($connection, $experimentID)["roundArray"];
$conditionOrder = getRandomOrder($connection, $experimentID)["conditionArray"];

$roundNr = 1;
$dataArray = array(
    "test" => "test",
    "pname" => $_GET['sname'],
    "pid" => $participantID,
    "expID" => $experimentID,
    "condition" => $conditionData[0],
    "feedback" => $conditionData[2],
    "order" => $conditionData[1],
    "presentation" => $conditionData[3],
    "roundOrder" => $roundOrder,
    "conditionOrder" => $conditionOrder
);


$data = http_build_query(array('data' => $dataArray));
$roundData = http_build_query(array('data' => $expRounds));