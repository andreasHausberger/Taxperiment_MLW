<?php
/**
 * Created by PhpStorm.
 * User: andreas
 * Date: 08.03.19
 * Time: 15:13
 */

include "../../../resources/config.php";

if (sizeof($_POST) >= 6) {
    $age = $_POST['age'];
    if (!intval($age) || intval($age) < 16 || intval($age) > 99) {
        $age = 0;
    }
    $gender = $_POST['gender'];
    $participation = $_POST['participation'];
    $care = $_POST['care'];
    $understanding = $_POST['understanding'];
    $english = $_POST['about'];
    $participant = $_GET['pid'];
    $about = $_POST['about'];
    $about = "'". addslashes($about) . "'";

    $updateQuery = "UPDATE questionnaire SET age = $age, gender = $gender, participation_before = $participation, care = $care, understanding = $understanding, about = $about WHERE pid = $participant";

    if (isset($connection)) {
        if ($connection->query($updateQuery)) {
            console_log("EXP data inserted successfully!");

            $host  = $_SERVER['HTTP_HOST'];

            header("Location: http://$host/public/include/questionnaire/index.php?expid=$experimentId&pid=$participant&page=9");
        }
        else {
            echo "Problem: " . $connection->error();
        }
    }
}

?>

<script>
    let items =[];

    function validateNumberAndAdd(element, min, max) {
        let value = document.getElementById(element).value;

        let intVal = parseInt(value);

        if (intVal && intVal >= min && intVal <= max) {
           addToArray(element);
        }
        else
        {
            alert("Please enter a valid number between 16 and 99 for your age!");
        }
    }

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
            console.log("Disabled Continue Button");
        }
    }
</script>


<form method="post">

    <div class="item">
        <p class="questionText"> What is your age in years?
        </p>
        <div class="radioDisplayHorizontal">
            <input type="text" name="age" id="age" onblur="validateNumberAndAdd('age', 16, 99)">

        </div>
    </div>

    <div class="item">
        <p class="questionText"> What is your gender?
        </p>
        <div class="radioDisplayHorizontal">
            <input type="radio" name="gender" value="0" onclick="addToArray('gender')"> <p>Man</p>
            <input type="radio" name="gender" value="1" onclick="addToArray('gender')"> <p>Woman</p>
            <input type="radio" name="gender" value="2" onclick="addToArray('gender')"> <p>Other</p>

        </div>
    </div>


    <div class="item">
        <p class="questionText"> Have you participated in a study on tax compliance before?
        </p>
        <div class="radioDisplayHorizontal">
            <input type="radio" name="participation" value="0" onclick="addToArray('participation')"> <p>Yes</p>
            <input type="radio" name="participation" value="1" onclick="addToArray('participation')"> <p>No</p>
        </div>
    </div>

    <div class="item">
        <p class="questionText"> Did you carefully read all the information that was given? (1: No, not at all; 7: Yes, completely)

        </p>
        <div class="radioDisplayHorizontal">
            <?php echo createLikert(7, "care"); ?>

        </div>
    </div>

    <div class="item">
        <p class="questionText"> Did you understand all of the information? (1: No, not at all; 7: Yes, completely)

        </p>
        <div class="radioDisplayHorizontal">
            <?php echo createLikert(7, "understanding"); ?>

        </div>
    </div>

    <div class="item">
        <p class="questionText"> What do you think this study was about exactly?
        </p>
        <div class="radioDisplayHorizontal">
            <input type="text" name="about" onblur="addToArray('about')">
        </div>
    </div>

    <input id="submitButton" type="submit" value="Next Page" disabled="false">


</form>
