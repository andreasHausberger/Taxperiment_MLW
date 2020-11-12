<?php

$array = ["False", "True", "Do not know"];
$numberOfQuestions = 8;

global $db, $qb;
$participant = $_GET['pid'];

$expData = $db->selectQuery("SELECT exp_condition FROM experiment e WHERE e.participant = ?", "s", ...[$participant]);

$condition = $expData["exp_condition"];

if ($condition == 4) {
    $numberOfQuestions = 3;
}

if(!$condition) {
    echo "Warning: Condition could not be read! Default to 1";
    $condition = 1;
}

if (sizeof($_POST) >= $numberOfQuestions) {
   $man1 = postParamValue("man1");
   $man2 = postParamValue("man2");
   $man3 = postParamValue("man3");
   $man4 = postParamValue("man4");
   $man5 = postParamValue("man5");
   $man6 = postParamValue("man6");
   $man7 = postParamValue("man7");
   $man8 = postParamValue("man8");


    $qb->addString("man1", $man1);
    $qb->addString("man2", $man2);
    $qb->addString("man3", $man3);
    $qb->addString("man4", $man4);
    $qb->addString("man5", $man5);
    $qb->addString("man6", $man6);
    $qb->addString("man7", $man7);
    $qb->addString("man8", $man8);

    $query = $qb->buildInsert("WHERE pid = $participant", true);

    if ($db->insertQuery($query)) {
        console_log("EXP data inserted successfully!");

        $host  = $_SERVER['HTTP_HOST'];

        header("Location: http://$host/public/include/questionnaire/index.php?expid=$experimentId&pid=$participant&page=$nextPageIndex");
    }
}
?>

<script>
    $(document).ready( function() {
        numberOfQuestions = 8;

        let condition = <?php echo $condition ?>;

        if(condition && condition == 4) {
            numberOfQuestions = 3;

            let elements = document.getElementsByClassName("conditional");

            for (let i = 0; i < elements.length; i++) {
                elements[i].style.display = "none";

            }

            console.log(elements);
        }
    });

</script>
<script src="/public/js/questionnaire.js"></script>

<div>
    <p>To conclude the study, you will be asked some questions about your personal opinions and impressions of the study.
    </p>
</div>

<p>
<b>
    Think back to the instructions of the second part and answer whether the following statements are true or not.
</b>
</p>

<form method="post">
    <div class="item conditional">
        <p class="questionText">
        <b>
            The safe outcome of the tax decision in the experiment indicates the remaining amount after paying the tax.
        </b>
        </p>
        <div class="radioDisplayHorizontal">
            <?php echo createLikert(3, "man1", $array); ?>
        </div>
    </div>
    <div class="item">
        <p class="questionText">
        <b>
            The audit probability indicates the probability of a tax inspection taking place in the respective round.
        </b>
        </p>
        <div class="radioDisplayHorizontal">
            <?php echo createLikert(3, "man2", $array); ?>
        </div>
    </div>
    <div class="item conditional">
        <p class="questionText">
        <b>
            The expected value of evasion represents the average outcome of choosing tax evasion.
        </b>
        </p>
        <div class="radioDisplayHorizontal">
            <?php echo createLikert(3, "man3", $array); ?>
        </div>
    </div>
    <div class="item">
        <p class="questionText">
        <b>
            If the tax rate is 50% on an income of 1000 ECU, the resulting tax is 300 ECU.
        </b>
        </p>
        <div class="radioDisplayHorizontal">
            <?php echo createLikert(3, "man4", $array); ?>
        </div>
    </div>
    <div class="item conditional">
        <p class="questionText">
        <b>
            The comparison of the safe outcome with the expected value of choosing evasion is helpful
            if a purely mathematically optimal decision is to be made.
        </b>
        </p>
        <div class="radioDisplayHorizontal">
            <?php echo createLikert(3, "man5", $array); ?>
        </div>
    </div>
    <div class="item conditional">
        <p class="questionText">
        <b>
            The expected value of choosing evasion describes exactly how much money you have left in the
            respective round when you do not pay the tax.
        </b>
        </p>
        <div class="radioDisplayHorizontal">
            <?php echo createLikert(3, "man6", $array); ?>
        </div>
    </div>
    <div class="item">
        <p class="questionText">
        <b>
            The fine consists of paying back the unpaid tax plus an additional fine.
        </b>
        </p>
        <div class="radioDisplayHorizontal">
            <?php echo createLikert(3, "man7", $array); ?>
        </div>
    </div>
    <div class="item conditional">
        <p class="questionText">
        <b>
            If the safe outcome is lower than the expected value of choosing evasion, from a mathematical point of
            view, it pays off to pay the tax.
        </b>
        </p>
        <div class="radioDisplayHorizontal">
            <?php echo createLikert(3, "man8", $array); ?>
        </div>
    </div>
    <input id="submitButton" type="submit" value="Next Page" disabled="disabled">
</form>