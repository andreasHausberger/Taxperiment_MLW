<?php

$numberOfQuestions = 2;

if (sizeof($_POST) >= $numberOfQuestions) {
    $rec1 = postParamValue("rec1");
    $rec2 = postParamValue("rec2");

    $participant = $_GET["pid"];

    $qb->addString("rec1", $rec1);
    $qb->addString("rec2", $rec2);

    $query = $qb->buildInsert("WHERE pid = $participant", true);

    if ($db->insertQuery($query)) {
        console_log("EXP data inserted successfully!");

        $host = $_SERVER['HTTP_HOST'];

        header("Location: http://$host/public/include/questionnaire/index.php?expid=$experimentId&pid=$participant&page=$nextPageIndex");
    }
}
?>
<script>
    var numberOfQuestions = 2;
</script>
<script src="/public/js/questionnaire.js"></script>

<form method="post">
    <div class="item">
        <p class="questionText">
        <b>
            1. Which tax rates were used over the repeated decisions in the second part?
        </b>
        </p>
        <div>
            <?php echo createLikert(3, "rec1", ["25% and 40%", "20% and 30%", "10% and 20%"]); ?>
        </div>
    </div>

    <div class="item">
        <p class="questionText">
        <b>
            2. Which audit probabilities were used over the repeated decisions in the second part?
        </b>
        </p>
        <div>
            <?php echo createLikert(3, "rec2", ["5%, 15%, and 25%", "10%, 30%, and 50%", "10%, 20%, and 30%"]); ?>
        </div>
    </div>
    <input id="submitButton" type="submit" value="Next Page" disabled="disabled">
</form>

