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

$pound = round($income / 400, 2);



?>

<h1> Thank you for your participation!</h1>

<br>

<b> This is the last page. Thank you for your participation in this study.</b>

<br>
<p>
    Round <?php echo $randomRound ?> was randomly chosen.
    In this round, you earned a net income of <?php echo $income ?> ECU.
    This amounts to £ <?php echo $pound ?> (400 ECU = 1 £).
    Together with the show-up fee of £ 3.50, your payment for participating in this study is £ <?php echo ($pound + 3.50) ?>.
</p>
<br>
<p>
    The purpose of this study was to investigate how factors like social norms, audit probability, fine level, or tax rate influence tax honesty and which information is attended in making the decision whether to pay the tax due or to evade taxes.
</p>

<p>
    If you have more questions you can contact the researchers involved in this study: Christoph Kogler (c.kogler@tilburguniversity.edu)
</p>

<p>
    Your study data has been saved successfully. <br>
    You can safely click the following button to continue:
    <br>
    <a href="https://app.prolific.co/submissions/complete?cc=6C150B1E"> <button> Back to Prolific </button> </a>
</p>


