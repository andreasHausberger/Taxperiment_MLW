<?php
/**
 * Created by PhpStorm.
 * User: andreas
 * Date: 06.03.19
 * Time: 13:46
 */

include "../../../resources/config.php";

if (sizeof($_POST) >= 2) {

    $exp1 = $_POST["exp1"];
    $exp2 = $_POST["exp2"];



    $participant = $_GET['pid'];

    $updateQuery = "UPDATE questionnaire SET pat1 = $exp1, pat2 = $exp2 WHERE pid = $participant";
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
        validateAndActiateButton(2); //number of required items
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
        <p class="questionText"> 1. Being a member of the community of UK citizens is important to me. (1 = do not agree at all, 7 = agree completely)

        </p>
        <div class="radioDisplayHorizontal">
            <?php echo createLikert(7, "exp1"); ?>

        </div>
    </div>
    <div class="item">
        <p class="questionText"> 2. I feel a sense of pride in being a member of the community of UK citizens. (1 = do not agree at all, 7 = agree completely)
        </p>
        <div class="radioDisplayHorizontal">
            <?php echo createLikert(7, "exp2"); ?>

        </div>
    </div>
   

    <input id="submitButton" type="submit" value="Next Page" disabled="disabled">


</form>
