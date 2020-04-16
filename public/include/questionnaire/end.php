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

$euros = round($income / 300, 2);



?>

<h1> Danke für die Teilnahme!</h1>

<br>

<b> Das ist die letzte Seite. Danke für Ihre Teilnahme an diesem Experiment. </b>

<br>
<p>
    Runde <?php echo $randomRound ?> wurde zufällig ausgewählt. .
    In dieser Runde haben Sie ein Einkommen von <?php echo $income ?> ECU verdient.
    Daraus ergeben sich <?php echo $euros ?> Euro (300 ECU = 1 Euro).
    Gemeinsam mit der Show-Up-Fee von 1 Euro, beträgt Ihre Bezahlung für die Teilnahme an diesem Experiment <?php echo ($euros + 1) ?> Euro.
</p>
<br>
<p>

</p>

<?php
if (!$updated) {
    echo "<b style=\"color: darkred\">
    Beim Speichern der Runde trat ein Fehler auf. Um Ihre Bezahlung zu erhalten, ...
</b>";
}
else {
    echo "<b> Die Information über die Runde, die zur Bezahlung ausgewählt wurde, wurde erfolgreich gespeichert. </b> <br> Sie können diese Seite nun verlassen.";
}?>
<br>
<br>
<a href="#">Klicken Sie auf diesen Link, um weiterzumachen. </a>

