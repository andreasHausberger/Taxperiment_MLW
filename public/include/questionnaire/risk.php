<?php
/**
 * Created by PhpStorm.
 * User: andreas
 * Date: 08.03.19
 * Time: 14:54
 */

include "../../../resources/config.php";


if (sizeof($_POST) >= 1) {
    $com1 = $_POST['com1'];


    $participant = $_GET['pid'];

    $updateQuery = "UPDATE questionnaire SET ris1 = $com1 WHERE pid = $participant";

    if (isset($connection)) {
        if ($connection->query($updateQuery)) {
            console_log("EXP data inserted successfully!");

            $host  = $_SERVER['HTTP_HOST'];

            header("Location: http://$host/public/include/questionnaire/index.php?expid=$experimentId&pid=$participant&page=7");
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
        <p class="questionText"> How do you see yourself: are you generally a person who is fully prepared to take risks or do you try to avoid taking risks? (1 = Definitely avoiding risks, 7 = Fully prepared to take risks)

        </p>
        <div class="radioDisplayHorizontal">
            <?php echo createLikert(7, "com1"); ?>

        </div>
    </div>


    <input id="submitButton" type="submit" value="Next Page" disabled="true">


</form>

