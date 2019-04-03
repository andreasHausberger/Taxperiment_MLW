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

    $updateQuery = "UPDATE questionnaire SET num1 = $num1, num2 = $num2, num3 = $num1 WHERE pid = $participant";

    if (isset($connection)) {
        if ($connection->query($updateQuery)) {
            console_log("NUM data inserted successfully!");

            $host = $_SERVER['HTTP_HOST'];

            header("Location: http://$host/public/include/questionnaire/index.php?pid=$participant&page=4");

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
        <p class="questionText"> 1. Concerning general mathematical abilities, how good are you at working with fractions? (1 = not good at all to 7 = extremely good)</p>
        <div class="radioDisplayHorizontal">
            <?php echo createLikert(7, "num1"); ?>
        </div>
    </div>

    <div class="item">
        <p class="questionText"> 2. How good are you at figuring out how much a shirt will cost if you get a discount of 25%? (1 = not good at all, 7 = extremely good)</p>
        <div class="radioDisplayHorizontal">
            <?php echo createLikert(7, "num2"); ?>
        </div>
    </div>

    <div class="item">
        <p class="questionText"> 3. How often do you find numerical information to be useful? (1 = never to 7 = very often). </p>
        <div class="radioDisplayHorizontal">
            <?php echo createLikert(7, "num3"); ?>
        </div>
    </div>

    <input id="submitButton" type="submit" value="Next Page" disabled="true">

</form>
