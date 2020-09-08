<?php
/**
 * Created by PhpStorm.
 * User: andreas
 * Date: 06.03.19
 * Time: 14:14
 */


include "../../../resources/config.php";

if (sizeof($_POST) >= 3) {
    $num1 = $_POST["num1"];
    $num2 = $_POST["num2"];
    $num3 = $_POST["num3"];

    $participant = $_GET["pid"];

    $updateQuery = "UPDATE questionnaire SET ho1 = $num1, ho2 = $num2, ho3 = $num3 WHERE pid = $participant";

    if (isset($connection)) {
        if ($connection->query($updateQuery)) {
            console_log("NUM data inserted successfully!");

            $host = $_SERVER['HTTP_HOST'];

            header("Location: http://$host/public/include/questionnaire/index.php?expid=$experimentId&pid=$participant&page=4");

        }
        else {
            echo "Could not connect! " + $connection->error();
        }
    }
    else {
        echo "Could not find connection!";
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
        <p class="questionText"> 1. Do most UK citizens think they should honestly declare cash earnings on their tax return? (1 = No, 5 = Yes)
</p>
        <div class="radioDisplayHorizontal">
            <?php echo createLikert(5, "num1"); ?>
        </div>
    </div>

    <div class="item">
        <p class="questionText"> 2. Do most UK citizens think it is acceptable to overstate tax deductions on their tax return? (1 = No, 5 = Yes)
</p>
        <div class="radioDisplayHorizontal">
            <?php echo createLikert(5, "num2"); ?>
        </div>
    </div>

    <div class="item">
        <p class="questionText"> 3. Do most UK citizens think working for cash-in-hand payments without paying tax is a trivial offence? (1 = No, 5 = Yes)
 </p>
        <div class="radioDisplayHorizontal">
            <?php echo createLikert(5, "num3"); ?>
        </div>
    </div>

    <input id="submitButton" type="submit" value="Next Page" disabled="true">

</form>
