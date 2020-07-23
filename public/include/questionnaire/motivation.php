<?php
/**
 * Created by PhpStorm.
 * User: andreas
 * Date: 08.03.19
 * Time: 14:54
 */

include "../../../resources/config.php";


if (sizeof($_POST) >= 6) {
    $com1 = $_POST['com1'];
    $com2 = $_POST['com2'];
    $com3 = $_POST['com3'];
    $com4 = $_POST['com4'];
    $com5 = $_POST['com5'];
    $com6 = $_POST['com6'];


    $participant = $_GET['pid'];

    $updateQuery = "UPDATE questionnaire SET com1 = $com1, com2 = $com2, com3 = $com3, com4 = $com4, com5 = $com5, com6 = $com6 WHERE pid = $participant";

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
        validateAndActiateButton(6);
    }

    function validateAndActiateButton(numberOfRequiredElements) {
        if (items.length == numberOfRequiredElements) {
            document.getElementById("submitButton").disabled = false;
            console.log("Disabled Continue Button")
        }
    }
</script>

<p>
     For each of the following statements, please indicate the likelihood that you would engage in the described activity or behaviour if you were to find yourself in that situation. 
</p>


<form method="post">
    <div class="item">
        <p class="questionText"> 1. Betting a day’s income at the horse races. (1 = extremely unlikely, 7 = extremely likely)

        </p>
        <div class="radioDisplayHorizontal">
            <?php echo createLikert(7, "com1"); ?>

        </div>
    </div>
    <div class="item">
        <p class="questionText"> 2. Investing 10% of your annual income in a moderate growth mutual fund. (1 = extremely unlikely, 7 = extremely likely)


        </p>
        <div class="radioDisplayHorizontal">
            <?php echo createLikert(7, "com2"); ?>

        </div>
    </div>

    <div class="item">
        <p class="questionText"> 3. Betting a day’s income at a high-stake poker game. (1 = extremely unlikely, 7 = extremely likely)
        </p>
        <div class="radioDisplayHorizontal">
            <?php echo createLikert(7, "com3"); ?>

        </div>
    </div>

    <div class="item">
        <p class="questionText"> 4. Investing 5% of your annual income in a very speculative stock. (1 = extremely unlikely, 7 = extremely likely)
        </p>
        <div class="radioDisplayHorizontal">
            <?php echo createLikert(7, "com4"); ?>

        </div>
    </div>

    <div class="item">
        <p class="questionText"> 5. Betting a day’s income on the outcome of a sporting event. (1 = extremely unlikely, 7 = extremely likely)
        </p>
        <div class="radioDisplayHorizontal">
            <?php echo createLikert(7, "com5"); ?>

        </div>
    </div>

    <div class="item">
        <p class="questionText"> 6. Investing 10% of your annual income in a new business venture. (1 = extremely unlikely, 7 = extremely likely)
        </p>
        <div class="radioDisplayHorizontal">
            <?php echo createLikert(7, "com6"); ?>

        </div>
    </div>


    <input id="submitButton" type="submit" value="Next Page" disabled="true">


</form>

