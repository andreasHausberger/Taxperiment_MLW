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

$updateString = "UPDATE audit SET selected = 1 WHERE pid = $participant AND round = $randomRound";


$results = $connection->query($selectString);

$updated = $connection->query($updateString);

if (!$updated) {
    echo "Could not update selected round!";
}

$rows = $results->fetch_all();

$income = $rows[0][2];

$euros = round($income / 300, 2);



?>

<h1> Thank you for your participation!</h1>

<br>

<b> This is the last page. Thank you for your participation in this study.</b>

<br>
<p>
    Round <?php echo $randomRound ?> was randomly chosen.
    In this round, you earned a net income of <?php echo $income ?> ECU.
    This amounts to <?php echo $euros ?> Euros (300 ECU = 1 Euros).
    Together with the show-up fee of 1 Euros, your payment for participating in this study is <?php echo ($euros + 1) ?> Euros.
</p>
<br>
<p>
    Please tell the experimenter that you are finished and you will be paid the amount.
</p>

<b style="color: darkred">
    DO NOT CLOSE OR RELOAD THIS PAGE!
</b>
<p> If you close or reload this page, you cannot be paid. </p>

