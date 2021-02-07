<?php

//get relevant data
$db = new Database();
$ecuToGBP = 350;
$participantID = $db->selectQuery("SELECT id FROM participant WHERE name = ?", "s", $participantName);
$expId = getExperimentIDForParticipantID($participantID['id']);
$rounds = $db->selectQuery("SELECT * FROM audit WHERE exp_id = $expId");

//finish experiment
$db->insertQuery("UPDATE experiment SET finished_experiment = NOW() WHERE id = ?", "i", $expId);

//select random Round
$randomIndex = rand(0, count($rounds) -1);

$randomlySelectedRound = $rounds[$randomIndex];

$income = $randomlySelectedRound['net_income'];
$poundString = formatCurrency($income / $ecuToGBP);
?>
<h1> Thank you for your participation!</h1>

<br>

<h3> This is the last page. Thank you for your participation in this study.
</h3>

<br>
Round <?php echo $randomIndex + 1 ?> was randomly chosen.
In this round, you earned a net income of <b><?php echo $income ?> ECU</b>.
This amounts to <b>£<?php echo $poundString ?></b> (<?php echo $ecuToGBP ?> ECU = £1.00).

<br>