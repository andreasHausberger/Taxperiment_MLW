<?php
 $numberOfQuestions = 4;

 if (sizeof($_POST) >= $numberOfQuestions) {
     $eff1 = postParamValue("eff1");
     $eff2 = postParamValue("eff2");
     $eff3 = postParamValue("eff3");
     $eff4 = postParamValue("eff4");

     $participant = $_GET["pid"];

     $qb->addString("eff1", $eff1);
     $qb->addString("eff2", $eff2);
     $qb->addString("eff3", $eff3);
     $qb->addString("eff4", $eff4);

     $query = $qb->buildInsert("WHERE pid = $participant", true);

     if ($db->insertQuery($query)) {
         console_log("EXP data inserted successfully!");

         $host = $_SERVER['HTTP_HOST'];

         header("Location: http://$host/public/include/questionnaire/index.php?expid=$experimentId&pid=$participant&page=5");
     }
 }

?>

<script>
    const numberOfQuestions = 4;
</script>
<script src="/public/js/questionnaire.js"></script>
<div>
    <p>
    <b>
        Please think back of the process of acquiring information to pay or not pay tax. Please state your agreement
        with the following statements. </b><br>
        (1 = Fully Disagree; 5 = Fully Agree)
    </p>
</div>
<form method="post">
    <div class="item">
        <p class="questionText">
        <b>
            1. The process was annoying.
        </b>
        </p>
        <div class="radioDisplayHorizontal">
            <?php echo createLikert(5, "eff1"); ?>
        </div>
    </div>

    <div class="item">
        <p class="questionText">
        <b>
            2. The process was difficult.
        </b>
        </p>
        <div class="radioDisplayHorizontal">
            <?php echo createLikert(5, "eff2"); ?>
        </div>
    </div>

    <div class="item">
        <p class="questionText">
        <b>
            3. I had to concentrate a lot during this process.
        </b>
        </p>
        <div class="radioDisplayHorizontal">
            <?php echo createLikert(5, "eff3"); ?>
        </div>
    </div>

    <div class="item">
        <p class="questionText">
        <b>
            4. The process was tiring.
        </b>
        </p>
        <div class="radioDisplayHorizontal">
            <?php echo createLikert(5, "eff4"); ?>
        </div>
    </div>
    <input id="submitButton" type="submit" value="Next Page" disabled="disabled">
</form>