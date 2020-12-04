<?php
?>
<div class="pageContainer">

    <div style="text-align: center; margin: 25px;">
        <table class="riskAversionTable comprehensionTable" style="margin: auto">
            <tr>
                <td> Income <br> 1000 ECU</td>
                <td> Tax Rate <br> 300 (30%)</td>
            </tr>
            <tr>
                <td> Audit Probability <br> 10%</td>
                <td> Fine <br> 600 ECU</td>
            </tr>
        </table>
    </div>
    <br>
    <p class="tutorialText">
        <b>
            Please solve the following tasks in relation to the example above to test your understanding of
            the instructions.
        </b> <br>
        <i>
            Please use only whole numbers to answer the questions.

        </i>
    </p>
    <form method="post" action="/public/include/intro/index.php?action=save_comprehension&condition=<?php echo $_GET['condition'] ?>&sname=<?php echo $participant?>&prolificPID=<?php echo $prolificPID?>&studyID=<?php echo $studyID?>&sessionID=<?php echo $sessionID?>&page=9">
        <p class="tutorialText">
            <b>
                How much would your remaining income be, if you choose "don't pay" and there is no audit? <br>
            </b>
            <input type="text" name="comp1" id="comp1" onblur="addToArray('comp1')">
        </p>

        <p class="tutorialText">
            <b>
                How much would your remaining income be if you choose "pay"? <br>
            </b>
            <input type="text" name="comp2" id="comp2" onblur="addToArray('comp2')">
        </p>

        <p class="tutorialText">
            <b>
                If you had to make this decision 10 times, how often could you expect to be audited? <br>
            </b>
            <input type="text" name="comp3" id="comp3" onblur="addToArray('comp3')">
        </p>

        <p class="tutorialText">
            <b>
                How much would your remaining income be if you choose "do not pay" and you get audited? <br>
            </b>
            <input type="text" name="comp4" id="comp4" onblur="addToArray('comp4')">
        </p>
        <br>
        <input type="submit" value="Next" id="continueButton">
    </form>


</div>

<script>
    $(document).ready( function() {
        document.getElementById("continueButton").disabled = true;

    });

    let items = [];
    let numberOfQuestions = 4;

    function addToArray(element) {

        if (!items.includes(element)) {
            items.push(element);
            console.log("Added " + element + " to array!");
        }
        else {
            console.log("Did not add " + element + " to the array, already in it!");
        }
        validateAndActiateButton(numberOfQuestions); //number of required items
    }

    function checkAnswer(element) {
        let value = document.getElementById(element).value;

        value = parseInt(value);
        isCorrect = false;

        switch (element) {
            case "comp1":
                isCorrect =  value === 1000;
                break;
            case "comp2":
                isCorrect = value === 700;
                break;
            case "comp3":
                isCorrect = value === 1;
                break;
            case "comp4":
                isCorrect = value === 400;
                break;
        }
        return isCorrect
    }

    function validateAndActiateButton(numberOfRequiredElements) {
        if (items.length === numberOfRequiredElements) {
            document.getElementById("continueButton").disabled = false;
            console.log("Disabled Continue Button")
        }
    }



</script>
