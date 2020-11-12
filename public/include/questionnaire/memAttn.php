<?php
/**
 * Created by PhpStorm.
 * User: andreas
 * Date: 06.03.19
 * Time: 11:27
 */

include "../../../resources/config.php";

$herokuURL = getenv('HEROKU_URL');


if (sizeof($_POST) >= 3) {

    $ma1 = $_POST["ma1"];
    $ma2 = $_POST["ma2"];
    $ma3 = $_POST["ma3"];

    $participant = $_GET["pid"];


    $insertQuery = "INSERT INTO questionnaire (pid, ma1, ma2, ma3, created) VALUES ($participant, $ma1, $ma2, $ma3, NOW())";

    if (isset($connection)) {
        if ($connection->query($insertQuery)) {

            $host  = $_SERVER['HTTP_HOST'];

            header("Location: http://$host/public/include/questionnaire/index.php?expid=$experimentId&pid=$participant&page=2");


        }
        else {
            echo "Problem! " . $connection->error();
        }
    }
    else {
        echo "Could not connect to database!";
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
        validateAndActiateButton(3);
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
        <div class="radioDisplayVertical">
            <p> What were the tax rates in the tax experiment?</p>
            <div class="radioItemFlex">
                <input type="radio" name="ma1" value="0" onclick="addToArray('ma1')">
                <p> 20% and 40%</p>
            </div>

            <div class="radioItemFlex">
                <input type="radio" name="ma1" value="1" onclick="addToArray('ma1')">
                <p> 20% and 30% </p>
            </div>

            <div class="radioItemFlex">
                <input type="radio" name="ma1" value="2" onclick="addToArray('ma1')">
                <p> 10% and 20%</p>
            </div>

        </div>
    </div>

    <div class="item">
        <div class="radioDisplayVertical">
            <p> What were the audit probabilities in the tax experiment?</p>
            <div class="radioItemFlex">
                <input type="radio" name="ma2" value="0" onclick="addToArray('ma2')">
                <p> 5%, 15%, and 25%</p>
            </div>


            <div class="radioItemFlex">
                <input type="radio" name="ma2" value="1" onclick="addToArray('ma2')">
                <p> 10%, 20%, and 30%</p>
            </div>

            <div class="radioItemFlex">
                <input type="radio" name="ma2" value="2" onclick="addToArray('ma2')">
                <p> 10%, 30%, and 50%</p>
            </div>

        </div>
    </div>

    <div class="item">
        <div class="radioDisplayVertical">
            <p> What were the fine levels in the tax experiment?</p>
            <div class="radioItemFlex">
                <input type="radio" name="ma3" value="0" onclick="addToArray('ma3')">
                <p>Payback + 100%, 200%, or 300% of the evaded amount</p>
            </div>


            <div class="radioItemFlex">
                <input type="radio" name="ma3" value="1" onclick="addToArray('ma3')">
                <p>Payback + 200%, 300%, or 400% of the evaded amount</p>
            </div>

            <div class="radioItemFlex">
                <input type="radio" name="ma3" value="2" onclick="addToArray('ma3')">
                <p>Payback + 200%, 400%, or 600% of the evaded amount</p>
            </div>

        </div>
    </div>

    <input id="submitButton" type="submit" value="Next Page" disabled="true">

</form>
