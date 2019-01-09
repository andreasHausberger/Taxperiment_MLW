<script>


</script>

<div>
    <div>
        <h1> Audit with most recent score: <?php echo $mostRecentScore; ?> </h1>
    </div>
</div>

<?php
$expRoundArray = $expRounds['data'];
$currentRound = $expRoundArray[$_GET['round'] - 1];

$taxRate = $currentRound['tax_rate'];
$auditProbability = $currentRound['audit_probability'];
$fineRate = $currentRound['fine_rate'];

$subjectID = $dataArray['pid'];
var_dump($subjectID);
$experimentID = $_GET['expid'];
$participantID = $_GET['pid'];
$currentRound = $_GET['round'];


include ("../../../resources/templates/presentation1.php");
?>

<form action=<?php echo "index.php?round=" . ($_GET['round'] + 1) . "&mode=1&expid=$experimentID&pid=$participantID" ?> method="post">

    <label for="inputValue">Value: </label>
    <input type="text" id="inputValue">
    <br>

    <input type="submit" class="formButton" name="Continue" value="Continue" onclick="timefunction('submit','submit','submit')">
</form>