<?php
/**
 * Created by PhpStorm.
 * User: andreas
 * Date: 08.03.19
 * Time: 15:35
 */

require_once($_SERVER["DOCUMENT_ROOT"] . "/resources/templateConfig.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/code/code.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/code/Database.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/code/QueryBuilder.php");
$experimentId = $_GET['expid'];

global $db;

$riskQueryBuilder = new QueryBuilder("risk_aversion");

$ecuToGBP = 350;
$showUpFeeNumber = 3.00;

$showUpFee = formatCurrency($showUpFeeNumber);

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


if ($participant == 123) {
    $participant = 181;
    echo "<b style='color: #ff0000'> WARNING! You are in Test Mode. If you are a participant and see this message, 
            please let the test supervisor know. Any values displayed here may not be accurate.</b>"; }
$selectString = "SELECT pid, round, net_income FROM audit WHERE pid = $participant and round = $randomRound";

$updateString = "UPDATE audit SET selected = 1  WHERE pid = $participant AND round = $randomRound";


$results = $connection->query($selectString);

$updated = $connection->query($updateString);

if (!$updated) {
    echo "Could not update selected round!";
}

$rows = $results->fetch_all();

$income = $rows[0][2];
$incomeString = formatCurrency($income);

if($participant == 181) {
    $income = 500;
}

$pounds = round($income / $ecuToGBP, 2);
$poundString = formatCurrency($pounds);



//Risk Calculation
$randomRiskRound = rand(1, 10);
$riskQueryBuilder->addString("chosen_round", $randomRiskRound);
$riskRoundName = "r" . $randomRiskRound;
$results = $db->selectQuery("SELECT " . $riskRoundName .  " FROM risk_aversion WHERE subject_id = ?", "i", ...[$participant]);

if($results && sizeof($results) > 0) {
    $chosenAnswer = $results[$riskRoundName];
    $roundData = $riskTaskArray[$randomRiskRound - 1];
    $isError = false;

    switch ($chosenAnswer) {
        case "A":
            $probability = $roundData["probA1"];
            $rewardSuccess = $roundData["ecuA1"];
            $rewardFailure = $roundData["ecuA2"];
            break;
        case "B":
            $probability = $roundData["probB1"];
            $rewardSuccess = $roundData["ecuB1"];
            $rewardFailure = $roundData["ecuB2"];
            break;
        default:
            $isError = true;
            break;
    }

    if (!$isError) {
        $riskResult = evaluateRiskTask($probability, $rewardSuccess, $rewardFailure);
        $riskPayment = round($riskResult / $ecuToGBP, 2);
        $riskPaymentString = formatCurrency($riskPayment);
        $riskAversionQuery = $riskQueryBuilder->buildInsert("WHERE subject_id = ?", true);
        $db->insertQuery($riskAversionQuery, "i", ...[$participant]);
    }
}
else {
    echo "Warning: Could not retrieve answer for Risk Task!";
}

//total calculation
$total = formatCurrency($pounds + $riskPayment + $showUpFeeNumber);




?>

<h1> Thank you for your participation!</h1>

<br>

<h3> This is the last page. Thank you for your participation in this study.
</h3>
<br>

<p class="tutorialText">
    For the first part of the study Lottery pair (row) <?php echo $randomRiskRound ?> was randomly chosen. 
    You choose Option <?php echo $chosenAnswer ?> and earned <b><?php echo $riskResult ?> ECU</b>.
    This amounts to <b>£<?php echo $riskPaymentString ?></b> (<?php echo $ecuToGBP ?> ECU = £1.00).
<br>   
    For the second part of the study Round <?php echo $randomRound ?> was randomly chosen. 
    In this round, you earned a net income of <b><?php echo $income ?> ECU</b>.
    This amounts to <b>£<?php echo $poundString ?></b> (<?php echo $ecuToGBP ?> ECU = £1.00).
</p>

<p class="tutorialText">
  Including your showup fee of £<?php echo $showUpFee?>, you will be paid a total of <b>£<?php echo ($total) ?></b>.
</p>

<p class="tutorialText">
The purpose of this study was to investigate how factors like income, tax due, audit probability, fine, 
or expected value information influence tax honesty and which information is attended in making the decision 
whether to pay the tax due or to evade taxes.
<br> 
If you have more questions you can contact the researchers involved in this study: Martin Müller (<a href="mailto:martin.mueller82@univie.ac.at">martin.mueller82@univie.ac.at</a>)

</p>
   
<br>
<?php
if (!$updated) {
    echo "<b style=\"color: darkred\">
    While saving the round an error occurred. Please let the test supervisor know to make sure you will receive the amount specified. 
</b>";
}
else {
    echo "<p class='tutorialText'> <b>The information about the round chosen for payment was saved successfully. </b> <br> You can now leave this page.</p>";
}?>
<br>
<br>
<a href="https://app.prolific.co/submissions/complete?cc=4B5739EA">Please click here to return to prolific. </a>

