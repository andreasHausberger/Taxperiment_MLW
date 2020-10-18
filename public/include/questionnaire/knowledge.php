<?php
$numberOfQuestions = 9;

if(sizeof($_POST) >= $numberOfQuestions) {

    $participant = $_GET['pid'];

    $kno1 = postParamValue("kno1");
    $kno2 = postParamValue("kno2");
    $kno3 = postParamValue("kno3");
    $kno4 = postParamValue("kno4");
    $kno5 = postParamValue("kno5");
    $kno6 = postParamValue("kno6");
    $kno7 = postParamValue("kno7");
    $kno8 = postParamValue("kno8");
    $kno9 = postParamValue("kno9");

    $qb->addString("kno1", $kno1);
    $qb->addString("kno2", $kno2);
    $qb->addString("kno3", $kno3);
    $qb->addString("kno4", $kno4);
    $qb->addString("kno5", $kno5);
    $qb->addString("kno6", $kno6);
    $qb->addString("kno7", $kno7);
    $qb->addString("kno8", $kno8);
    $qb->addString("kno9", $kno9);

    $query = $qb->buildInsert("WHERE pid = $participant", true);

    if($db->insertQuery($query)) {
        console_log("EXP data inserted successfully!");

        $host = $_SERVER['HTTP_HOST'];

        header("Location: http://$host/public/include/questionnaire/index.php?expid=$experimentId&pid=$participant&page=4");
    }
}
?>


<script>
    const numberOfQuestions = 9;
</script>
<script src="/public/js/questionnaire.js"></script>

<form method="post">
    <div class="item">
        <p class="questionText">
            1. Do you know what an expected value is?
        </p>
        <div>
            <?php echo createLikert(2, "kno1", ["Yes", "No"]); ?>
        </div>
    </div>
    <div class="item">
        <p class="questionText">
            2. Please try to explain in your own words what an expected value is!
        </p>
        <div>
            <input type="text" name="kno2" style="width: 200px; margin-left: 12px;" onblur="addToArray('kno2')">
        </div>
    </div>
    <p>
        How much do you agree with the following statements about the expected value information? <br>
        (1 = Fully disagree - 7 = Fully agree)
    </p>
    <div class="item">
        <p class="questionText">
            3. It was difficult to understand the expected value information.
        </p>
        <div class="radioDisplayHorizontal">
            <?php echo createLikert(7, "kno3"); ?>
        </div>
    </div>
    <div class="item">
        <p class="questionText">
            4. I based my decision purely on the expected value information.
        </p>
        <div class="radioDisplayHorizontal">
            <?php echo createLikert(7, "kno4"); ?>
        </div>
    </div>
    <div class="item">
        <p class="questionText">
            5. I was trying to make the best rational decision, based on the expected value information.

        </p>
        <div class="radioDisplayHorizontal">
            <?php echo createLikert(7, "kno5"); ?>
        </div>
    </div>
    <div class="item">
        <p class="questionText">
            6. It was difficult to understand the expected value information.
        </p>
        <div class="radioDisplayHorizontal">
            <?php echo createLikert(7, "kno6"); ?>
        </div>
    </div>
    <div class="item">
        <p class="questionText">
            7. My moral principles concerning tax paying were more important to me than making decisions based on the
            expected value information.

        </p>
        <div class="radioDisplayHorizontal">
            <?php echo createLikert(7, "kno7"); ?>
        </div>
    </div>
    <div class="item">
        <p class="questionText">
            8. The expected value is negligible as a guideline for tax decisions.
        </p>
        <div class="radioDisplayHorizontal">
            <?php echo createLikert(7, "kno8"); ?>
        </div>
    </div>
    <div class="item">
        <p class="questionText">
            9. I did not let myself be influenced by the expected value in my decision.

        </p>
        <div class="radioDisplayHorizontal">
            <?php echo createLikert(7, "kno9"); ?>
        </div>
    </div>
    <input id="submitButton" type="submit" value="Next Page" disabled="disabled">
</form>