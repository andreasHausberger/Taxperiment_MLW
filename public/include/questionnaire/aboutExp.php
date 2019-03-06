<?php
/**
 * Created by PhpStorm.
 * User: andreas
 * Date: 06.03.19
 * Time: 13:46
 */

include "../../../resources/config.php";

if (sizeof($_POST) > 0) {

    $exp1 = $_POST["exp1"];
    $exp2 = $_POST["exp2"];
    $exp3 = $_POST["exp3"];
    $exp4 = $_POST["exp4"];
    $exp5 = $_POST["exp5"];


    $participant = $_GET['sname'];

    $updateQuery = "UPDATE questionnaire SET exp1 = $exp1, exp2 = $exp2, exp3 = $exp3, exp4 = $exp4, exp5 = $exp5  WHERE pid = $participant";
    if (isset($connection)) {
        if ($connection->query($updateQuery)) {
            console_log("EXP data inserted successfully!");

            $host  = $_SERVER['HTTP_HOST'];

            header("Location: http://$host/public/include/questionnaire/index.php?sname=$participant&page=3");
        }
        else {
            echo "Problem: " . $connection->error();
        }
    }
}
?>

<h1>About The Experiment</h1>

<p>
    Please rate the following statements. 1 = do not agree at all, 7 = fully agree.
</p>

<form method="post">
    <div class="item">
        <p class="questionText"> 1. The timing of feedback on whether I was audited was unfair
        </p>
        <div class="radioDisplayHorizontal">
            <?php echo createLikert(7, "exp1"); ?>

        </div>
    </div>
    <div class="item">
        <p class="questionText"> 2. I was fairly treated by the tax authorities in the experiment
        </p>
        <div class="radioDisplayHorizontal">
            <?php echo createLikert(7, "exp2"); ?>

        </div>
    </div>
    <div class="item">
        <p class="questionText"> 3. During the experiment I felt fearful waiting for audits
        </p>
        <div class="radioDisplayHorizontal">
            <?php echo createLikert(7, "exp3"); ?>

        </div>
    </div>

    <div class="item">
        <p class="questionText"> 4. During the experiment I felt angry waiting for audits
        </p>
        <div class="radioDisplayHorizontal">
            <?php echo createLikert(7, "exp4"); ?>

        </div>
    </div>

    <div class="item">
        <p class="questionText"> 5. During the experiment, I felt uncertain about my decisions to pay my taxes honestly or not
        </p>
        <div class="radioDisplayHorizontal">
            <?php echo createLikert(7, "exp5"); ?>

        </div>
    </div>

    <input type="submit" value="Next Page">


</form>
