<?php
/**
 * Created by PhpStorm.
 * User: andreas
 * Date: 08.03.19
 * Time: 14:16
 */

include "../../../resources/config.php";

if (sizeof($_POST) >= 1) {
    $cog1 = $_POST["cog1"];

    $participant = $_GET['pid'];

    $updateQuery = "UPDATE questionnaire SET cog1 = $cog1 WHERE pid = $participant";

    if (isset($connection)) {
        if ($connection->query($updateQuery)) {
            echo("EXP data inserted successfully!");

            $host  = $_SERVER['HTTP_HOST'];

            header("Location: http://$host/public/include/questionnaire/index.php?expid=$experimentId&pid=$participant&page=5");
        }
        else {
            echo "Problem: " . $connection->error();
        }
    }
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
        validateAndActiateButton(1);
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
        <p class="questionText"> 1. I feel relief rather than satisfaction after completing a task that required a lot of mental effort.  (1 = do not agree at all, 7 = fully agree)
        </p>
        <div class="radioDisplayHorizontal">
            <?php echo createLikert(7, "cog1"); ?>

        </div>
    </div>

    <input id="submitButton" type="submit" value="Next Page" disabled="true">

</form>
