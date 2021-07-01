<?php

//get relevant data
$db = new Database();
$ecuToGBP = 500;
$participantID = $db->selectQuery("SELECT id FROM participant WHERE name = ?", "s", $participantName);
$expId = getExperimentIDForParticipantID($participantID['id']);
$rounds = $db->selectQuery("SELECT * FROM audit WHERE exp_id = $expId");

//finish experiment
$db->insertQuery("UPDATE experiment SET finished_experiment = NOW() WHERE id = ?", "i", $expId);

//select random Round
$randomIndex = rand(0, count($rounds) -1);

$randomRoundInfo = $rounds[$randomIndex];

$selectedRound = $randomRoundInfo['round'];

$income = $randomRoundInfo['net_income'];
$declaredTax = $randomRoundInfo['declared_tax'];
$fine = $randomRoundInfo['fine'];
$incomeAfterTax = $income - $declaredTax - $fine;

$poundString = formatCurrency($incomeAfterTax / $ecuToGBP);
$showUpFeeInPounds = 3;

$totalPayment = doubleval($poundString) + $showUpFeeInPounds;

//set random round to selected
$selectionResult = $db->insertQuery("UPDATE audit SET selected = 1 WHERE exp_id = ? AND round = ?", "ii", ...[$expId, $selectedRound]);

$resultText = "";
if ($selectionResult != 0) {
    $resultText = "WARNING: The selected could not be saved. Please let the test supervisor know.";
}
else {
    $resultText = "The information about your payment has been saved. It is now safe to proceed.";
}


?>
<h1> Thank you for your participation!</h1>

<br>

<p class="text-body tutorialText">
    This is the last page. Thank you for your participation in this study.
</p>
<p class="text-body tutorialText">
    Round <?php echo $randomIndex + 1 ?> was randomly chosen.
    In this round, you earned a net income of <b><?php echo $incomeAfterTax ?> ECU</b>.
    This amounts to <b>£<?php echo $poundString ?></b> (<?php echo $ecuToGBP ?> ECU = £1.00).
</p>

<p class="text-body tutorialText">
    Together with the show-up fee of £3.00, your payment for participating in this study is £<?php echo $totalPayment; ?>.
</p>
<p class="text-body tutorialText">
    <?php echo $resultText; ?>
</p>

