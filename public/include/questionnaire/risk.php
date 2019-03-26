<?php
/**
 * Created by PhpStorm.
 * User: andreas
 * Date: 08.03.19
 * Time: 14:21
 */

include "../../../resources/config.php";

if (sizeof($_POST) >= 3) {

    $rsk1 = $_POST['rsk1'];
    $rsk2 = $_POST['rsk3'];
    $rsk3 = $_POST['rsk3'];

    $participant = $_GET['pid'];

    $updateQuery = "UPDATE questionnaire SET rsk1 = $rsk1, rsk2 = $rsk2, rsk3 = $rsk3 WHERE pid = $participant";

    if (isset($connection)) {
        if ($connection->query($updateQuery)) {
            console_log("EXP data inserted successfully!");

            $host  = $_SERVER['HTTP_HOST'];

            header("Location: http://$host/public/include/questionnaire/index.php?pid=$participant&page=6");
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
    let items =[];

    function addToArray(element) {
        if (!items.includes(element)) {
            items.push(element);
            console.log("Added " + element + " to array!");
        }
        else {
            console.log("Did not add " + element + " to the array, already in it!");
        }
        validateAndActiateButton(3);
    }

    function validateAndActiateButton(numberOfRequiredElements) {
        if (items.length == numberOfRequiredElements) {
            document.getElementById("submitButton").disabled = false;
            console.log("Disabled Continue Button")
        }
    }
</script>

<h1>Risk Taking</h1>

<p>
    For each of the following statements, provide an answer on a scale ranging from 1 (= extremely risk-averse) to 7 (= extremely risk-seeking)
</p>
<form method="post">
    <div class="item">
        <p class="questionText"> 1. Would you describe yourself as a risk-averse or a risk-seeking person?
        </p>
        <div class="radioDisplayHorizontal">
            <?php echo createLikert(7, "rsk1"); ?>

        </div>
    </div>

    <div class="item">
        <p class="questionText"> 2. How would you describe your risk-related behavior in financial decisions?
        </p>
        <div class="radioDisplayHorizontal">
            <?php echo createLikert(7, "rsk2"); ?>

        </div>
    </div>

    <div class="item">
        <p class="questionText"> 3. How would you describe your risk-related behavior in situations involving tax payments?
        </p>
        <div class="radioDisplayHorizontal">
            <?php echo createLikert(7, "rsk3"); ?>

        </div>
    </div>

    <input id="submitButton" type="submit" value="Next Page" disabled="true">

</form>
