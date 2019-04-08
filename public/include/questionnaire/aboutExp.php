<?php
/**
 * Created by PhpStorm.
 * User: andreas
 * Date: 06.03.19
 * Time: 13:46
 */

include "../../../resources/config.php";

if (sizeof($_POST) >= 5) {

    $exp1 = $_POST["exp1"];
    $exp2 = $_POST["exp2"];
    $exp3 = $_POST["exp3"];
    $exp4 = $_POST["exp4"];
    $exp5 = $_POST["exp5"];
    $exp6 = $_POST["exp6"];


    $participant = $_GET['pid'];

    $updateQuery = "UPDATE questionnaire SET exp1 = $exp1, exp2 = $exp2, exp3 = $exp3, exp4 = $exp4, exp5 = $exp5, exp6 = $exp6  WHERE pid = $participant";
    if (isset($connection)) {
        if ($connection->query($updateQuery)) {
            console_log("EXP data inserted successfully!");

            $host  = $_SERVER['HTTP_HOST'];

            header("Location: http://$host/public/include/questionnaire/index.php?expid=$experimentId&pid=$participant&page=3");
        }
        else {
            echo "Problem: " . $connection->error();
        }
    }
}
else {
    echo "Please fill out every question on the page!";
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
        validateAndActiateButton(6); //number of required items
    }

    function validateAndActiateButton(numberOfRequiredElements) {
        if (items.length == numberOfRequiredElements) {
            document.getElementById("submitButton").disabled = false;
            console.log("Disabled Continue Button")
        }
    }
</script>



<form method="post">
    <div class="item">
        <p class="questionText"> 1. The timing of feedback on whether I was audited was unfair. (1 = do not agree at all, 7 = fully agree)
        </p>
        <div class="radioDisplayHorizontal">
            <?php echo createLikert(7, "exp1"); ?>

        </div>
    </div>
    <div class="item">
        <p class="questionText"> 2. I was fairly treated by the tax authorities in the experiment. (1 = do not agree at all, 7 = fully agree)
        </p>
        <div class="radioDisplayHorizontal">
            <?php echo createLikert(7, "exp2"); ?>

        </div>
    </div>
    <div class="item">
        <p class="questionText"> 3. During the experiment I felt fearful waiting for feedback whether I was audited or not. (1 = do not agree at all, 7 = fully agree)
        </p>
        <div class="radioDisplayHorizontal">
            <?php echo createLikert(7, "exp3"); ?>

        </div>
    </div>

    <div class="item">
        <p class="questionText"> 4. During the experiment I felt angry waiting for feedback whether I was audited or not. (1 = do not agree at all, 7 = fully agree)
        </p>
        <div class="radioDisplayHorizontal">
            <?php echo createLikert(7, "exp4"); ?>

        </div>
    </div>

    <div class="item">
        <p class="questionText"> 5. During the experiment, I felt uncertain about my decisions to pay my taxes honestly or not. (1 = do not agree at all, 7 = fully agree)
        </p>
        <div class="radioDisplayHorizontal">
            <?php echo createLikert(7, "exp5"); ?>

        </div>
    </div>

    <div class="item">
        <p class="questionText"> 6. The probability of detection of tax evasion in the experiment was high. (1 = do not agree at all, 7 = fully agree)
        </p>
        <div class="radioDisplayHorizontal">
            <?php echo createLikert(7, "exp6"); ?>

        </div>
    </div>

    <input id="submitButton" type="submit" value="Next Page" disabled="disabled">


</form>
