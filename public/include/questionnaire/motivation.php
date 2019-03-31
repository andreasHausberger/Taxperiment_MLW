<?php
/**
 * Created by PhpStorm.
 * User: andreas
 * Date: 08.03.19
 * Time: 14:54
 */

include "../../../resources/config.php";


if (sizeof($_POST) >= 8) {
    $com1 = $_POST['com1'];
    $com2 = $_POST['com2'];
    $com3 = $_POST['com3'];
    $com4 = $_POST['com4'];
    $com5 = $_POST['com5'];
    $com6 = $_POST['com6'];
    $com7 = $_POST['com7'];
    $com8 = $_POST['com8'];

    $participant = $_GET['pid'];

    $updateQuery = "UPDATE questionnaire SET com1 = $com1, com2 = $com2, com3 = $com3, com4 = $com4, com5 = $com5, com6 = $com6, com7 = $com7, com8 = $com8 WHERE pid = $participant";

    if (isset($connection)) {
        if ($connection->query($updateQuery)) {
            console_log("EXP data inserted successfully!");

            $host  = $_SERVER['HTTP_HOST'];

            header("Location: http://$host/public/include/questionnaire/index.php?pid=$participant&page=7");
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
        validateAndActiateButton(8);
    }

    function validateAndActiateButton(numberOfRequiredElements) {
        if (items.length == numberOfRequiredElements) {
            document.getElementById("submitButton").disabled = false;
            console.log("Disabled Continue Button")
        }
    }
</script>




<p>
    Please rate the following statements. (1 = do not agree at all, 7 = fully agree)
</p>

<form method="post">
    <div class="item">
        <p class="questionText"> 1. Paying tax is the right thing to do. (1 = do not agree at all, 7 = fully agree)

        </p>
        <div class="radioDisplayHorizontal">
            <?php echo createLikert(7, "com1"); ?>

        </div>
    </div>
    <div class="item">
        <p class="questionText"> 2. Paying tax is a responsibility that should be willingly accepted by all citizens. (1 = do not agree at all, 7 = fully agree)

        </p>
        <div class="radioDisplayHorizontal">
            <?php echo createLikert(7, "com2"); ?>

        </div>
    </div>

    <div class="item">
        <p class="questionText"> 3. I feel a moral obligation to pay my tax. (1 = do not agree at all, 7 = fully agree)
        </p>
        <div class="radioDisplayHorizontal">
            <?php echo createLikert(7, "com3"); ?>

        </div>
    </div>

    <div class="item">
        <p class="questionText"> 4. Paying my tax ultimately advantages everyone. (1 = do not agree at all, 7 = fully agree)
        </p>
        <div class="radioDisplayHorizontal">
            <?php echo createLikert(7, "com4"); ?>

        </div>
    </div>

    <div class="item">
        <p class="questionText"> 5. I think of tax paying as helping the government do worthwhile things. (1 = do not agree at all, 7 = fully agree)
        </p>
        <div class="radioDisplayHorizontal">
            <?php echo createLikert(7, "com5"); ?>

        </div>
    </div>

    <div class="item">
        <p class="questionText"> 6. Overall, I pay my tax with good will. (1 = do not agree at all, 7 = fully agree)
        </p>
        <div class="radioDisplayHorizontal">
            <?php echo createLikert(7, "com6"); ?>

        </div>
    </div>

    <div class="item">
        <p class="questionText"> 7. I resent paying tax. (1 = do not agree at all, 7 = fully agree)
        </p>
        <div class="radioDisplayHorizontal">
            <?php echo createLikert(7, "com7"); ?>

        </div>
    </div>

    <div class="item">
        <p class="questionText"> 8. I accept responsibility for paying my fair share of tax. (1 = do not agree at all, 7 = fully agree)
        </p>
        <div class="radioDisplayHorizontal">
            <?php echo createLikert(7, "com8"); ?>

        </div>
    </div>

    <input id="submitButton" type="submit" value="Next Page" disabled="true">


</form>

