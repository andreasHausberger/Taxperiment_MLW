<?php
/**
 * Created by PhpStorm.
 * User: andreas
 * Date: 06.03.19
 * Time: 14:14
 */

$numberOfQuestions = 3;

if (sizeof($_POST) >= $numberOfQuestions) {
    $num1 = postParamValue("num1");
    $num2 = postParamValue("num2");
    $num3 = postParamValue("num3");

    $participant = $_GET["pid"];

    $qb->addString("num1", $num1);
    $qb->addString("num2", $num2);
    $qb->addString("num3", $num3);

    $query = $qb->buildInsert("WHERE pid = $participant", true);

    if ($db->insertQuery($query)) {
        console_log("EXP data inserted successfully!");

        $host = $_SERVER['HTTP_HOST'];

        header("Location: http://$host/public/include/questionnaire/index.php?expid=$experimentId&pid=$participant&page=7");
    }
}

?>


<script>
    const numberOfQuestions = 3;
</script>
<script src="/public/js/questionnaire.js"></script>

<form method="post">
    <div class="item">
        <p class="questionText"> <b>1. Out of 1,000 people in a small town 500 are members of a choir. Out of these 500
            members in the choir 100 are men. Out of the 500 inhabitants that are not in the choir 300 are men. What is
            the probability that a randomly drawn man is a member of the choir? <br>
            Please indicate the probability in percent. </b>
        </p>
        <div>
            <input type="text" name="num1" onblur="addToArray('num1')">
        </div>
    </div>

    <div class="item">
        <p class="questionText"> <b> 2. Imagine we are throwing a five-sided die 50 times. On average, out of these 50
            throws how many times would this five-sided die show an odd number (1, 3 or 5)? </b>
        </p>
        <div>
            <input type="text" name="num2" onblur="addToArray('num2')"> <p class="tutorialText">...out of 50 throws.</p>
        </div>
    </div>

    <div class="item" style="margin-bottom: 12px; ">
        <p class="questionText"> <b> 3. In a forest 20% of mushrooms are red, 50% brown and 30% white. A red mushroom is
            poisonous with a probability of 20%. A mushroom that is not red is poisonous with a probability of 5%. <br>
            What is the probability that a poisonous mushroom in the forest is red? </b>
        </p>
        <div>
            <input type="text" name="num3" onblur="addToArray('num3')">
        </div>
    </div>

    <input id="submitButton" type="submit" value="Next Page" disabled="true">

</form>
