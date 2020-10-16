<?php

$array = ["False", "True", "Do not know"];
$numberOfQuestions = 8;

if (sizeof($_POST) >= $numberOfQuestions) {
   $man1 = postParamValue("man1");
   $man2 = postParamValue("man2");
   $man3 = postParamValue("man3");
   $man4 = postParamValue("man4");
   $man5 = postParamValue("man5");
   $man6 = postParamValue("man6");
   $man7 = postParamValue("man7");
   $man8 = postParamValue("man8");

    $participant = $_GET['pid'];

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

        header("Location: http://$host/public/include/questionnaire/index.php?expid=$experimentId&pid=$participant&page=3");
    }
}
?>

<script>

    let items = [];
    function addToArray(element) {
        if (!items.includes(element)) {
            items.push(element);
            console.log("Added " + element + " to array!");
        }
        else {
            console.log("Did not add " + element + " to the array, already in it!");
        }
        validateAndActiateButton(8); //number of required items
    }

    function validateAndActiateButton(numberOfRequiredElements) {
        if (items.length === numberOfRequiredElements) {
            document.getElementById("submitButton").disabled = false;
            console.log("Disabled Continue Button")
        }
    }
</script>

<div>
    <h3>Info</h3>
    <p>To conclude the study, you will be asked some questions about your personal opinions and impressions of the study.
    </p>
</div>

<h3>Questions
</h3>
<p>
    Think back to the instructions of the second part and answer whether the following statements are true or not.
</p>

<form method="post">
    <div class="item">
        <p class="questionText">
            1. The safe outcome of the tax decision in the experiment indicates the remaining amount after paying the tax.
        </p>
        <div class="radioDisplayHorizontal">
            <?php echo createLikert(3, "man1", $array); ?>
        </div>
    </div>
    <div class="item">
        <p class="questionText">
            2. The audit probability indicates the probability of a tax inspection taking place in the respective round.
        </p>
        <div class="radioDisplayHorizontal">
            <?php echo createLikert(3, "man2", $array); ?>
        </div>
    </div>
    <div class="item">
        <p class="questionText">
            3. The expected value of evasion represents the average outcome of choosing tax evasion.
        </p>
        <div class="radioDisplayHorizontal">
            <?php echo createLikert(3, "man3", $array); ?>
        </div>
    </div>
    <div class="item">
        <p class="questionText">
            4. If the tax rate is 50% on an income of 1000 ECU, the resulting tax is 300 ECU.
        </p>
        <div class="radioDisplayHorizontal">
            <?php echo createLikert(3, "man4", $array); ?>
        </div>
    </div>
    <div class="item">
        <p class="questionText">
            5. The comparison of the safe outcome with the expected value of choosing evasion is helpful
            if a purely mathematically optimal decision is to be made.
        </p>
        <div class="radioDisplayHorizontal">
            <?php echo createLikert(3, "man5", $array); ?>
        </div>
    </div>
    <div class="item">
        <p class="questionText">
            6.The expected value of choosing evasion describes exactly how much money you have left in the
            respective round when you do not pay the tax.
        </p>
        <div class="radioDisplayHorizontal">
            <?php echo createLikert(3, "man6", $array); ?>
        </div>
    </div>
    <div class="item">
        <p class="questionText">
            7. The fine consists of paying back the unpaid tax plus an additional fine.
        </p>
        <div class="radioDisplayHorizontal">
            <?php echo createLikert(3, "man7", $array); ?>
        </div>
    </div>
    <div class="item">
        <p class="questionText">
            8. If the safe outcome is lower than the expected value of choosing evasion, from a mathematical point of
            view it pays off to pay the tax.
        </p>
        <div class="radioDisplayHorizontal">
            <?php echo createLikert(3, "man8", $array); ?>
        </div>
    </div>
    <input id="submitButton" type="submit" value="Next Page" disabled="disabled">
</form>