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
$showUpFee = 3.00;

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

$pounds = round($income / $ecuToGBP, 2);

//Risk Calculation
$randomRiskRound = rand(1, 10);
$riskQueryBuilder->addString("chosen_round", $randomRiskRound);
$riskRoundName = "r" . $randomRiskRound;
$results = $db->selectQuery("SELECT " . $riskRoundName .  " FROM risk_aversion WHERE subject_id = ?", "i", ...[$participant]);

if($results && sizeof($results) > 0) {
    $chosenAnswer = $results[$riskRoundName];

    echo "Answer is $chosenAnswer, round is $randomRiskRound";

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

        $riskPayment = round(doubleval($riskResult) / doubleval($ecuToGBP), 2);

        $message = "In this round, you chose Answer $chosenAnswer. You have received $riskResult ECU ($probability in 100 chance). <br>";
        $message .= "That means, for your decision, you will receive an additional £$riskPayment as payment.";

        $riskAversionQuery = $riskQueryBuilder->buildInsert("WHERE subject_id = ?", true);

        $db->insertQuery($riskAversionQuery, "i", ...[$participant]);
    }
}
else {
    echo "Warning: Could not retrieve answer for Risk Task!";
}




?>

<h1> Thank you for your participation!</h1>

<br>

<b> This is the last page. Thank you for your participation in this experiment.
</b>

<br>
<p>
    Round <?php echo $randomRound ?> was chosen randomly.
    In this round you have earned an income of <?php echo $income ?> ECU.
    That means that you will receive £<?php echo $pounds ?> (<?php echo $ecuToGBP ?> ECU = £1.00) for this round. .
</p>

<p>
    For the Risk Task, Round <?php echo $randomRiskRound ?> was chosen randomly. <br>
    <?php echo $message ?>
</p>
<p>
    Including your showup fee of £<?php echo $showUpFee?>, you will be paid a total of £<?php echo ($pounds + $riskPayment + $showUpFee) ?>.
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

