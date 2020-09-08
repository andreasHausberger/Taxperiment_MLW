<?php
/**
 * Created by PhpStorm.
 * User: andreas
 * Date: 08.03.19
 * Time: 14:21
 */

include "../../../resources/config.php";

if (sizeof($_POST) >= 2) {

    $rsk1 = $_POST['rsk1'];
    $rsk2 = $_POST['rsk2'];

    $participant = $_GET['pid'];

    $updateQuery = "UPDATE questionnaire SET tru1 = $rsk1, tru2 = $rsk2 WHERE pid = $participant";

    if (isset($connection)) {
        if ($connection->query($updateQuery)) {
            console_log("EXP data inserted successfully!");

            $host  = $_SERVER['HTTP_HOST'];

            header("Location: http://$host/public/include/questionnaire/index.php?expid=$experimentId&pid=$participant&page=6");
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
        validateAndActiateButton(2);
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
        <p class="questionText"> 1. The UK Tax Office is trustworthy. (1 = Strongly disagree , 7 = Strongly agree)


        <div class="radioDisplayHorizontal">
            <?php echo createLikert(7, "rsk1"); ?>

        </div>
    </div>

    <div class="item">
        <p class="questionText"> 2. The UK Tax Office has extensive means to force citizens to be honest about tax. (1 = Strongly disagree , 7 = Strongly agree)

        </p>
        <div class="radioDisplayHorizontal">
            <?php echo createLikert(7, "rsk2"); ?>

        </div>
    </div>

 

    <input id="submitButton" type="submit" value="Next Page" disabled="true">

</form>
