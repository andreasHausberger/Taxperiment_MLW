<?php
/**
 * Created by PhpStorm.
 * User: andreas
 * Date: 08.03.19
 * Time: 15:04
 */

include "../../../resources/config.php";

if (sizeof($_POST) >= 7) {

    $dgs1 = $_POST['dgs1'];
    $dgs2 = $_POST['dgs2'];
    $dgs3 = $_POST['dgs3'];
    $dgs4 = $_POST['dgs4'];
    $dgs5 = $_POST['dgs5'];
    $dgs6 = $_POST['dgs6'];
    $dgs7 = $_POST['dgs7'];

    $participant = $_GET['pid'];

    $updateQuery = "UPDATE questionnaire SET gre1 = $dgs1, gre2 = $dgs2, gre3 = $dgs3, gre4 = $dgs4, gre5 = $dgs5, gre6 = $dgs6, gre7 = $dgs7 WHERE pid = $participant";


    if (isset($connection)) {
        if ($connection->query($updateQuery)) {
            console_log("EXP data inserted successfully!");

            $host  = $_SERVER['HTTP_HOST'];

            header("Location: http://$host/public/include/questionnaire/index.php?expid=$experimentId&pid=$participant&page=8");
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
        validateAndActiateButton(7);
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
        <p class="questionText"> 1. I always want more. (1 = Strongly disagree, 5 = Strongly agree)

        </p>
        <div class="radioDisplayHorizontal">
            <?php echo createLikert(5, "dgs1"); ?>

        </div>
    </div>
    <div class="item">
        <p class="questionText"> 2. Actually, I’m kind of greedy. (1 = Strongly disagree, 5 = Strongly agree)

        </p>
        <div class="radioDisplayHorizontal">
            <?php echo createLikert(5, "dgs2"); ?>

        </div>
    </div>

    <div class="item">
        <p class="questionText"> 3. One can never have too much money. (1 = Strongly disagree, 5 = Strongly agree)
        </p>
        <div class="radioDisplayHorizontal">
            <?php echo createLikert(5, "dgs3"); ?>

        </div>
    </div>

    <div class="item">
        <p class="questionText"> 4. As soon as I have acquired something. I start to think about the next thing I want. (1 = Strongly disagree, 5 = Strongly agree)
        </p>
        <div class="radioDisplayHorizontal">
            <?php echo createLikert(5, "dgs4"); ?>

        </div>
    </div>

    <div class="item">
        <p class="questionText"> 5. It doesn’t matter how much I have. I’m never completely satisfied. (1 = Strongly disagree, 5 = Strongly agree)
        </p>
        <div class="radioDisplayHorizontal">
            <?php echo createLikert(5, "dgs5"); ?>

        </div>
    </div>

    <div class="item">
        <p class="questionText"> 6. My life motto is “more is better". (1 = Strongly disagree, 5 = Strongly agree)
        </p>
        <div class="radioDisplayHorizontal">
            <?php echo createLikert(5, "dgs6"); ?>

        </div>
    </div>

    <div class="item">
        <p class="questionText"> 7. I can’t imagine having too many things. (1 = Strongly disagree, 5 = Strongly agree)
        </p>
        <div class="radioDisplayHorizontal">
            <?php echo createLikert(5, "dgs7"); ?>

        </div>
    </div>

    <input id="submitButton" type="submit" value="Next Page" disabled="true">


</form>
