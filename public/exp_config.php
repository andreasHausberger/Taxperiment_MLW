<?php
/**
 * Created by PhpStorm.
 * User: andreas
 * Date: 05.12.18
 * Time: 10:38
 */

$condition = $_GET['condition'];
$participantName = $_GET['sname'];

require_once ('../resources/config.php');
require_once ("./templates/header.php");

$participantQuery = $connection->prepare("INSERT INTO participant (name) VALUES (?)");

$participantQuery->bind_param("s", $participantName);

$participantID = -1;
$experimentID = -1;

if ($participantQuery->execute()) {
    $participantID = $connection->insert_id;
    echo "Participant with id " . $participantID . " saved successfully";
}
else {
    echo "Error saving participant: " . $connection->error;
}

$experimentQuery = $connection->prepare("INSERT INTO experiment (exp_condition, participant) VALUES (?, ?)");

$experimentQuery->bind_param("ii", $condition, $participantID);

echo " trying to execute exp query...";
if ($experimentQuery->execute()) {
    $experimentID = $connection->insert_id;
    echo "Experiment data with ID " . $experimentID . "saved successfully! \n";

}
else {
    echo "Error saving experiment data: " . $connection->error . "\n";
}

$conditionQuery = "SELECT * FROM exp_condition AS c WHERE c.id = " . $condition;

$conditionResult = $connection->query($conditionQuery);

$feedback = -1; $order = -1; $presentation = -1;

if ($conditionResult->num_rows > 0) {
    while ($row = $conditionResult->fetch_assoc()) {
         $feedback = $row['feedback'];
         $order = $row['order'];
         $presentation = $row['presentation'];
    }
}
else {
    echo "Connection error: " . $connection->error;
}

$roundQueryAsc = "SELECT * FROM round ORDER BY id ASC";
$roundQueryDesc = "SELECT * FROM round ORDER BY id DESC";

$roundsResult = $connection->query($order == 1 ? $roundQueryAsc : $roundQueryDesc);
global $expRounds;

if ($roundsResult->num_rows > 0) {
    while ($row = $roundsResult->fetch_assoc()) {

        $expRounds[] = $row;
    }
    echo "loaded rounds in order " . ($order == 1 ? 'standard' : 'reverse') . " \n";
}
else {
    echo "Connection error: " . $connection->error;
}

$roundNr = 1;
$dataArray = array(
        "test" => "test",
        "pname" => $participantName,
        "pid" => $participantID,
        "condition" => $condition,
        "feedback" => $feedback,
        "order" => $order,
        "presentation" => $presentation
);

$data = http_build_query(array('data' => $dataArray));



?>
<br>


<a href= <?php echo "include/intro/index.php?data=" . $data . "&roundnr=" . $roundNr . "&page=1" ?> > Weiter </a>

<?php require_once ('./templates/footer.php');