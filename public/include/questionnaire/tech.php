<?php

include "../../../resources/config.php";

if (sizeof($_POST) >= 2) {
    $tech1 = "'" . $_POST["tech1"] . "'";
    $tech2 = "'" . $_POST["tech2"] . "'";
    $tech3 = "'" . addslashes($_POST["tech3"]) . "'";

    $updateQuery = "UPDATE questionnaire SET tech1 = $tech1, tech2 = $tech2, problems = $tech3, created = NOW() WHERE pid = $participant";

    if (isset($connection)) {
        if ($connection->query($updateQuery)) {
            console_log("EXP data inserted successfully!");

            $host  = $_SERVER['HTTP_HOST'];

            header("Location: http://$host/public/include/questionnaire/index.php?expid=$experimentId&pid=$participant&page=10");
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
        validateAndActiateButton(2);
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
        <p class="questionText textSpan"> What type of device did you use for this study?
        </p>
        <div class="radioDisplayVertical">
                <div>
                    <input type="radio" value="phone" name="tech1" onclick="addToArray('tech1')">Mobile Phone</option>
                </div>
                <div>
                    <input type="radio" value="tablet" name="tech1" onclick="addToArray('tech1')">Tablet</option>
                </div>
                <div>
                    <input type="radio" value="desktop" name="tech1" onclick="addToArray('tech1')">Desktop / Laptop Computer</option>
                </div>
        </div>
    </div>

    <div class="item">
        <p class="questionText textSpan"> What kind of input device did you use?
        </p>
        <div class="radioDisplayVertical">
            <div>
                <input type="radio" value="touchscreen" name="tech2" onclick="addToArray('tech2')">Touchscreen</option>
            </div>
            <div>
                <input type="radio" value="trackpad" name="tech2" onclick="addToArray('tech2')">Trackpad</option>
            </div>
            <div>
                <input type="radio" value="mouse" name="tech2" onclick="addToArray('tech2')">External Mouse</option>
            </div>
        </div>
    </div>

    <div class="item">
        <p class="questionText textSpan">
            Did you face any technical difficulties? If yes, please explain in the following box.
        </p>
        <input type="text" style="margin-bottom: 32px" name="tech3">

    </div>

    <input id="submitButton" type="submit" value="Finish the Questionnaire!" disabled="false">


</form>
