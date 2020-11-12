<?php
/**
 * Created by PhpStorm.
 * User: andreas
 * Date: 08.03.19
 * Time: 14:54
 */

$numberOfQuestions = 6;

if (sizeof($_POST) >= $numberOfQuestions) {
    $mot1 = postParamValue("mot1");
    $mot2 = postParamValue("mot2");
    $mot3 = postParamValue("mot3");
    $mot4 = postParamValue("mot4");
    $mot5 = postParamValue("mot5");
    $mot6 = postParamValue("mot6");

    $participant = $_GET["pid"];

    $qb->addString("mot1", $mot1);
    $qb->addString("mot2", $mot2);
    $qb->addString("mot3", $mot3);
    $qb->addString("mot4", $mot4);
    $qb->addString("mot5", $mot5);
    $qb->addString("mot6", $mot6);

    $query = $qb->buildInsert("WHERE pid = $participant", true);

    if ($db->insertQuery($query)) {
        console_log("EXP data inserted successfully!");

        $host = $_SERVER['HTTP_HOST'];

        header("Location: http://$host/public/include/questionnaire/index.php?expid=$experimentId&pid=$participant&page=$nextPageIndex");
    }
}

?>
<script>
    const numberOfQuestions = 6; 
</script>
<script src="/public/js/questionnaire.js"></script>

<p>
    <b>Please indicate to what extent you agree with the following statements. </b> <br>
    Note that these statements refer to the society you live in. <br>
    (1 = Completely Disagree; 5 = Completely Agree)
</p>


<form method="post">
    <div class="item">
        <p class="questionText"> <b> 1. Paying tax is the right thing to do. </b>

        </p>
        <div class="radioDisplayHorizontal">
            <?php echo createLikert(5, "mot1"); ?>

        </div>
    </div>
    <div class="item">
        <p class="questionText"> <b> 2. Paying my tax ultimately advantages everyone. </b>
        </p>
        <div class="radioDisplayHorizontal">
            <?php echo createLikert(5, "mot2"); ?>

        </div>
    </div>

    <div class="item">
        <p class="questionText"> <b> 3. I think of tax paying as helping the government do worthwhile things. </b>
        </p>
        <div class="radioDisplayHorizontal">
            <?php echo createLikert(5, "mot3"); ?>

        </div>
    </div>

    <div class="item">
        <p class="questionText"> <b> 4. I like to talk with friends about the gaps and loopholes in the tax system. </b>
        </p>
        <div class="radioDisplayHorizontal">
            <?php echo createLikert(5, "mot4"); ?>

        </div>
    </div>

    <div class="item">
        <p class="questionText"> <b> 5. I enjoy exploring the gaps and barriers of tax law. </b>
        </p>
        <div class="radioDisplayHorizontal">
            <?php echo createLikert(5, "mot5"); ?>

        </div>
    </div>

    <div class="item">
        <p class="questionText"> <b> 6. I find pleasure in finding a way to minimize my tax payments. </b>
        </p>
        <div class="radioDisplayHorizontal">
            <?php echo createLikert(5, "mot6"); ?>

        </div>
    </div>

    <input id="submitButton" type="submit" value="Next Page" disabled="true">


</form>

