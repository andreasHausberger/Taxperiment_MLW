<?php
/**
 * Created by PhpStorm.
 * User: andreas
 * Date: 05.12.18
 * Time: 10:38
 */

$condition = $_GET['condition'];
$subjectName = $_GET['sname'];

require_once ('../resources/config.php');


$sqlquery = "SELECT * FROM exp_condition AS c WHERE c.id = " . $condition;

$conditionResult = $connection->query($sqlquery);

if ($conditionResult->num_rows > 0) {
    while ($row = $conditionResult->fetch_assoc()) {
        global $feedback, $order, $presentation;
         $feedback = $row['feedback'];
         $order = $row['order'];
         $presentation = $row['presentation'];
        echo " id: " . $row['id'] . " - Feedback: " . $row['feedback'] . " - Order: " . $row['order'] . " - Presentation: " . $row['presentation'];
    }
}
else {
    echo "Connection error: " . $connection->error;
}

$roundQueryAsc = "SELECT * FROM round ORDER BY id ASC";
$roundQueryDesc = "SELECT * FROM round ORDER BY id DESC";

$roundsResult = $connection->query($order == 1 ? $roundQueryAsc : $roundQueryDesc);

if ($roundsResult->num_rows > 0) {
    while ($row = $roundsResult->fetch_assoc()) {
        echo " " . $row['id'];
    }
}
else {
    echo "Connection error: " . $connection->error;
}