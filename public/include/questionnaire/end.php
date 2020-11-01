<?php
/**
 * Created by PhpStorm.
 * User: andreas
 * Date: 08.03.19
 * Time: 15:35
 */

include "../../../resources/config.php";

$experimentId = $_GET['expid'];

if (!isset($experimentId)) {
    echo "WARNING: COULD NOT READ EXPERIMENT ID!";
}

$dateString = "UPDATE experiment SET finished_questionnaire = NOW() WHERE id = $experimentId";

if ($connection->query($dateString)) {
    console_log("Added finished_questionnaire for experiment $experimentId");
}

$participant = $_GET['pid'];

if (!isset($participant)) {
    echo "WARNING: COULD NOT READ PARTICIPANT!";
}

$randomRound = rand(1, 18);

if ($participant == 123) { $participant = 181; echo "<b style='color: red'> WARNING! You are in Test Mode. If you are a participant and see this message, please let the test supervisor know. </b>"; }
$selectString = "SELECT pid, round, net_income FROM audit WHERE pid = $participant and round = $randomRound";

$updateString = "UPDATE audit SET selected = 1  WHERE pid = $participant AND round = $randomRound";


$results = $connection->query($selectString);

$updated = $connection->query($updateString);

if (!$updated) {
    echo "Could not update selected round!";
}

$rows = $results->fetch_all();

$income = $rows[0][2];

$pounds = round($income / 400, 2);



?>

<h1> Thank you for your participation!</h1>

<br>

<b> This is the last page. Thank you for your participation in this experiment.
</b>

<br>
<p>
    Round <?php echo $randomRound ?> was chosen randomly.
    In this round you have earned an income of <?php echo $income ?> ECU.
    That means that you will receive £ <?php echo $pounds ?> (400 ECU = £1) for this round. .
    Including your showup fee of £ 1, you will be paid a total of £ <?php echo ($pounds + 1) ?>.
</p>
<br>
<p>

</p>

<?php
if (!$updated) {
    echo "<b style=\"color: darkred\">
    While saving the round an error occurred. Please let the test supervisor know to make sure you will receive the amount specified. 
</b>";
}
else {
    echo "<b> The information about the round chosen for payment was saved successfully. </b> <br> You can now leave this page.";
}?>
<br>
<br>
<a href="#">Please click the link to continue. </a>

