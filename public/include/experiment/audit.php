<?php
$expRoundArray = $expRounds['data'];
$currentRound = $expRoundArray[$_GET['round'] - 1];

$taxRate = $currentRound['tax_rate'];
$auditProbability = $currentRound['audit_probability'];
$fineRate = $currentRound['fine_rate'];

$subjectID = $dataArray['pid'];
//var_dump($subjectID);
$experimentID = $_GET['expid'];
$participantID = $_GET['pid'];
$currentRound = $_GET['round'];
?>








<?php

if (isset($_GET['feedback'])) {
    $delayFeedback = $_GET['feedback'];
    echo "Dev Notes: Checking feedback mode: " . ($delayFeedback == "0" ? "Immediate" : "Delayed");
    echo "<br>";

}
else {
    echo "WARNING: Could not find feedback information!";
}
if (isset($_GET['presentation'])) {
    $presentationBool = $_GET['presentation'];
    echo "Dev Notes: Checking presentation mode: " . ($presentation == "0" ? "Presentation 1" : "Presentation 2");
    $mlwUrl = $presentationBool == "0" ? "../../../resources/templates/presentation1.php" : "../../../resources/templates/presentation2.php";
    include($mlwUrl);
}
else {
    echo "Could not load MLW table!";
}



//include ("../../../resources/templates/presentation1.php");


?>

<script>



    //is always called after the button is pushed.
    function performAudit() {
        let reportedIncome = parseInt(document.getElementById("inputValue").value); //self reported income
        document.getElementById("reportedIncome").value = reportedIncome;

        let netIncome = 0;

        let probability = <?php echo $auditProbability?>;
        let income = <?php echo $mostRecentScore ?>; //actual income
        let taxRate = <?php echo $taxRate ?>;

        let honesty = income == reportedIncome;

        let randomNr = Math.random();
        let audit = (randomNr <= probability);

        let fine = 0



        console.log("testing " + randomNr + " against probability " + probability);

        if (audit) {


            fine = startAudit(income, reportedIncome, taxRate);

            netIncome = income - fine;


            document.getElementById("income").value = "" + netIncome;

            document.getElementById("wasAudited").value = "true";

            document.getElementById("wasHonest").value = honesty;


        }
        else {

            let taxAmount = Math.floor(reportedIncome * taxRate);
            netIncome = income - taxAmount;

            document.getElementById("income").value = "" + income;

            document.getElementById("wasAudited").value = false;

            document.getElementById("wasHonest").value = honesty;

            console.log("No Audit");
        }

        let feedbackIsDelayed = <?php echo $delayFeedback ?> ;

        if (feedbackIsDelayed == 0) {
            displayInformation(audit, income, netIncome, fine);
        }
        else {
            collapseInformation("submit", "submit", "submit");
            window.location.href = "  <?php echo "index.php?round=" . ($_GET['round'] + 1) . "&mode=1&expid=$experimentID&pid=$participantID&feedback=$feedback&order=$order&presentation=$presentation"; ?>";
        }


        // document.getElementById("submitButton").disabled = false;
        //timefunction(txt1, txt2, txt3);


    }

    function displayInformation(audit, income, reportedIncome, fine) {

        document.getElementById("auditCell").innerText = audit ? "You were audited" : "You were not audited";
        document.getElementById("incomeCell").innerText = income;
        document.getElementById("reportedIncomeCell").innerText = reportedIncome;
        document.getElementById("fineCell").innerText = fine;


        document.getElementById("overlay").style.width = "100%";
    }

    function collapseInformation(txt1, txt2, txt3) {
        document.getElementById('overlay').style.width = '0';
        timefunction(txt1, txt2, txt3);
    }

    //checks the input value in case of an audit, and calculates a fine if needed. Returns 0 (in case of honest input) or else the amount of the fine in int.
    function startAudit(income, reported, taxRate) {
        let fineRate = <?php echo $fineRate; ?>;

        if (reported < income) {
            //find the difference between the taxes, and multiply it with the fine rate.

            let discrepancy = (income * taxRate) - (reported * taxRate);

            let fine = discrepancy * fineRate;

            console.log("Participant was audited! Declared " + reported + " vs. actual amount " + income );

            return fine;
        }

        return 0;
    }

    function validateInput() {
        let input = document.getElementById("inputValue").value;
        let income = <?php echo $mostRecentScore; ?> ;
        let inputInt = parseInt(input);

        if (isNaN(inputInt)) {
            document.getElementById("inputFeedback").innerText = "Please enter numbers only!";
            document.getElementById("submitButton").disabled = true;

        }

        if (inputInt < 0 || inputInt > income) {
            document.getElementById("inputFeedback").innerText = "Please enter values greater than 0 and smaller than your actual income!";
            document.getElementById("submitButton").disabled = true;

        }
        else {
            console.log("valid input... " + inputInt);

            document.getElementById("inputFeedback").innerText = "";
            document.getElementById("submitButton").disabled = false;
        }
    }


</script>



<form action=<?php echo "index.php?round=" . ($_GET['round'] + 1) . "&mode=1&expid=$experimentID&pid=$participantID&feedback=$feedback&order=$order&presentation=$presentation" ?> method="post">


    <label for="inputValue">Income Declaration: </label>
    <input type="text" id="inputValue" onblur="validateInput()"> <div id="inputFeedback"></div>
    <br>

    <input id="submitButton" type="button"
           class="formButton" name="Continue" value="Continue" onclick="performAudit()" disabled="true">

    <div id="overlay">
        <div class="feedbackContainer">
            <table>
                <tbody>
                <tr>
                    <p>Please review the info below. "Audit" displays whether you were audited. "Income" is the total income of your last slider round.
                        "Reported Income" is the value you declared. "Net Income" is amount you declared after taxes (minus a possible fine).   </p>

                </tr>
                <tr>
                    <td>
                        Audit:
                    </td>
                    <td id="auditCell">

                    </td>
                </tr>
                <tr>
                    <td>
                        Fine:
                    </td>
                    <td id="fineCell">

                    </td>
                </tr>
                <tr>
                    <td>
                        Income:
                    </td>
                    <td id="incomeCell">

                    </td>
                </tr>

                <tr>
                    <td>
                        Net Income:
                    </td>
                    <td id="reportedIncomeCell">

                    </td>
                </tr>
                </tbody>
            </table>
             <input type="submit" value="Close Box & Continue" onclick="collapseInformation('submit','submit','submit')">
        </div>
    </div>
</form>



