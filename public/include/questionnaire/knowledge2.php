<?php
$numberOfQuestions = 2;

global $db, $qb;

if (sizeof($_POST) >= $numberOfQuestions) {

    $participant = $_GET['pid'];

    $kno2 = postParamValue("kno2");
    $kno3 = postParamValue("kno3");

    $qb->addString("kno2", $kno2);
    $qb->addString("kno3", $kno3);


    $query = $qb->buildInsert("WHERE pid = $participant", true);
     if ($db->insertQuery($query)) {
         console_log("EXP data inserted successfully!");

         $host = $_SERVER['HTTP_HOST'];

         header("Location: http://$host/public/include/questionnaire/index.php?expid=$experimentId&pid=$participant&page=5");
     }

}

?>

<script>
    numberOfQuestions = 2;
</script>

<script src="/public/js/questionnaire.js"></script>

<form method="post">
    <div class="item">
        <p class="questionText">
            <b>
                Please try to explain in your own words what an expected value is! (open question)
            </b>
        </p>
        <div>
            <input type="text" id="kno_input" name="kno2" style="width: 350px; height: 40px; margin-left: 12px;" onblur="addToArray('kno2')" value=" ">
        </div>
    </div>

    <div class="item">
        <p class="questionText">
            Did you make use of the expected value when making a decision?
        </p>
        <div class="radioDisplayHorizontal">
            <?php echo createLikert(2, "kno3", ["No", "Yes"]); ?>
        </div>
    </div>
    <input id="submitButton" type="submit" value="Next Page" disabled="disabled">
</form>