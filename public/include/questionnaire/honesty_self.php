<?php
/**
 * Created by PhpStorm.
 * User: andreas
 * Date: 08.03.19
 * Time: 14:16
 */


include "../../../resources/config.php";

if (sizeof($_POST) >= 3) {
    $cog1 = $_POST["cog1"];
    $cog2 = $_POST["cog2"];
    $cog3 = $_POST["cog3"];


    $participant = $_GET['pid'];

    $updateQuery = "UPDATE questionnaire SET hs1 = $cog1, hs2 = $cog2, hs3 = $cog3  WHERE pid = $participant";

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
        <p class="questionText"> 1. Do you think you should honestly declare cash earnings on your tax return? (1 = No, 5 = Yes)
        </p>
        <div class="radioDisplayHorizontal">
            <?php echo createLikert(5, "cog1"); ?>

        </div>
    </div>
    <div class="item">
        <p class="questionText"> 2. Do you think it is acceptable to overstate tax deductions on your tax return? (1 = No, 5 = Yes)
        </p>
        <div class="radioDisplayHorizontal">
            <?php echo createLikert(5, "cog2"); ?>

        </div>
    </div>
    <div class="item">
        <p class="questionText"> 3. Do you think working for cash-in-hand payments without paying tax is a trivial offence? (1 = No, 5 = Yes)

        </p>
        <div class="radioDisplayHorizontal">
            <?php echo createLikert(5, "cog3"); ?>

        </div>
    </div>
    

    <input id="submitButton" type="submit" value="Next Page" disabled="true">

</form>
