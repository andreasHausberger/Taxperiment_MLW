<?php
 $numberOfQuestions = 2;

 if(sizeof($_POST) >= $numberOfQuestions) {
    global $db, $qb;

    $con1 = postParamValue("con1");
    $con2 = postParamValue("con2");

    $participant = $_GET["pid"];

    $qb->addString("con1", $con1);
    $qb->addString("con2", $con2);

    $query = $qb->buildInsert("WHERE pid = $participant", true);

    if ($db->insertQuery($query)) {
        $host = $_SERVER["HTTP_HOST"];
        header("Location: http://$host/public/include/questionnaire/index.php?expid=$experimentId&pid=$participant&page=$nextPageIndex");
    }
 }

 ?>


<script>
    const numberOfQuestions = 2;
</script>
<script src="/public/js/questionnaire.js"></script>
<div>
    <p>
        <b>
            Please respond to the following two items. We guarantee that your responses will not affect your approval.
        <br>
    </p>
</div>

<form method="post">
    <div class="item">
        <p class="questionText">
            <b>
                Was your participation disturbed by surrounding circumstances like loud noise, a ringing phone, other people etc.?
            </b>
        </p>
        <?php echo createLikert(2, "con1", ["No", "Yes"]); ?>
    </div>

    <div class="item">
        <p class="questionText">
            <b>
                To what extent could you concentrate on the instructions and decision tasks?
            </b> <br>
            (1 = "Not At All", 7 = "Fully")
        </p>
        <div class="radioDisplayHorizontal">
            <?php echo createLikert(7, "con2"); ?>
        </div>
        <input id="submitButton" type="submit" value="Next Page" disabled="disabled">
    </div>
</form>