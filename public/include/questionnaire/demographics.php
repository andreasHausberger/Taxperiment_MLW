<?php
/**
 * Created by PhpStorm.
 * User: andreas
 * Date: 08.03.19
 * Time: 15:13
 */

$numberOfQuestions = 5;

if (sizeof($_POST) >= $numberOfQuestions) {
    $age = postParamValue("age");
    $gender = postParamValue("gender");
    $participation = postParamValue("participation");
    $care = postParamValue("care");
    $english = postParamValue("english");

    $participant = $_GET['pid'];

    $qb->addString("age", $age);
    $qb->addString("gender", $gender);
    $qb->addString("participation", $participation);
    $qb->addString("care", $care);
    $qb->addString("english", $english);

    $query = $qb->buildInsert("WHERE pid = $participant", true);

    if ($db->insertQuery($query)) {
        console_log("EXP data inserted successfully!");

        $host = $_SERVER['HTTP_HOST'];

        header("Location: http://$host/public/include/questionnaire/index.php?expid=$experimentId&pid=$participant&page=9");
    }


}

?>

<script>
   const numberOfQuestions = 5;
</script>
<script src="/public/js/questionnaire.js"></script>


<form method="post">

    <div class="item">
        <p class="questionText"> <b> What is your age in years? </b>
        </p>
        <div class="radioDisplayHorizontal">
            <input type="text" name="age" onblur="addToArray('age')">

        </div>
    </div>

    <div class="item">
        <p class="questionText"> <b> What is your gender? </b>
        </p>
        <div class="radioDisplayHorizontal">
            <input type="radio" name="gender" value="0" onclick="addToArray('gender')"> <p>Male</p>
            <input type="radio" name="gender" value="1" onclick="addToArray('gender')"> <p>Female</p>
            <input type="radio" name="gender" value="2" onclick="addToArray('gender')"> <p>Other</p>

        </div>
    </div>

    <div class="item">
        <p class="questionText"> <b> Have you participated in a study on tax compliance before? </b>
        </p>
        <div class="radioDisplayHorizontal">
            <input type="radio" name="participation" value="0" onclick="addToArray('participation')"> <p>Yes</p>
            <input type="radio" name="participation" value="1" onclick="addToArray('participation')"> <p>No</p>
        </div>
    </div>

    <div class="item">
        <p class="questionText"> <b> Did you carefully read all the information that was given? </b> <br> 
        (1: No, not at all; 7: Yes, completely)
        </p>
        <div class="radioDisplayHorizontal">
            <?php echo createLikert(7, "care"); ?>

        </div>
    </div>

    <div class="item">
        <p class="questionText"> <b> How would you rate your English language skills? </b> <br> 
        (1: Very Low; 7: Very High)
        </p>
        <div class="radioDisplayHorizontal">
            <?php echo createLikert(7, "english"); ?>

        </div>
    </div>

    <input id="submitButton" type="submit" value="Next Page" disabled="false">


</form>
