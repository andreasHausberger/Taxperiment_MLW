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
$condition = $_GET['condition'];
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
        let reportedTax = parseInt(document.getElementById("inputValue").value); //self reported tax
        document.getElementById("tax").value = <?php echo $mostRecentScore * $taxRate ?>;
        let actualIncome = <?php echo $mostRecentScore?> ; //before tax

        let netIncome = 0; //what the participant earns after tax

        let probability = <?php echo $auditProbability?>;
        let actualTax = <?php echo $mostRecentScore * $taxRate ?>; //actual income
        let taxRate = <?php echo $taxRate ?>;

        let honesty = actualTax == reportedTax; //true or false, depending on the declaration

        let randomNr = Math.random();
        let audit = (randomNr <= probability);

        let fine = 0;



        console.log("testing " + randomNr + " against probability " + probability);

        if (audit) {


            fine = startAudit(actualTax, reportedTax);

            netIncome = actualIncome - fine;

            if (netIncome < 0) { netIncome = 0; }


            document.getElementById("wasAudited").value = "true";

        }
        else {
            netIncome = actualIncome - reportedTax;


            document.getElementById("wasAudited").value = false;

            console.log("No Audit");
        }

        document.getElementById("reported_tax").value = "" + reportedTax;
        document.getElementById("actual_income").value = "" + actualIncome;
        document.getElementById("net_income").value = "" + netIncome;
        document.getElementById("wasHonest").value = honesty;



        let feedbackIsDelayed = <?php echo $delayFeedback ?> ;

        if (feedbackIsDelayed == 0) {
            displayInformation(audit, actualIncome, netIncome, fine, taxRate);
        }
        else {
            collapseInformation("submit", "submit", "submit");
           // window.location.href = "  <?php echo "index.php?round=" . ($_GET['round'] + 1) . "&mode=1&expid=$experimentID&pid=$participantID&feedback=$feedback&order=$order&presentation=$presentation"; ?>";
        }


        // document.getElementById("submitButton").disabled = false;
        //timefunction(txt1, txt2, txt3);


    }

    function displayInformation(audit, income, reportedIncome, fine, taxRate) {

        let paidTaxAmount = income - reportedIncome;
        let actualTaxAmount = Math.floor(income * taxRate);
        let taxDiscrepancy = actualTaxAmount - paidTaxAmount;

        let totalFineAmount = audit ? fine : 0;
        document.getElementById("earnedIncomeCell").innerText = income;
        document.getElementById("declaredIncomeCell").innerText = reportedIncome;
        document.getElementById("taxDueCell").innerText = Math.floor(income * taxRate);
        document.getElementById("paidTaxCell").innerText = paidTaxAmount;
        document.getElementById("netIncomeCell").innerText = reportedIncome;

        if (audit) {
            document.getElementById("missingTaxCell").innerText = totalFineAmount;
            document.getElementById("missingTaxRow").style.display = "table-row";
            document.getElementById("auditText").innerHTML = "You were <b> audited! </b> "
            document.getElementById("paidTaxRow").style.display = "none";
            document.getElementById("declaredIncomeRow").style.display = "none";
        }
        else {
            document.getElementById("missingTaxRow").style.display = "none";
            document.getElementById("auditText").innerHTML = "You were <b> not audited! </b> "

        }


        document.getElementById("overlay").style.width = "100%";
    }

    function collapseInformation(txt1, txt2, txt3) {
        document.getElementById('overlay').style.width = '0';
        timefunction(txt1, txt2, txt3);
    }

    //checks the input value in case of an audit, and calculates a fine if needed. Returns 0 (in case of honest input) or else the amount of the fine in int.
    function startAudit(actualTax, reportedTax) {
        let fineRate = <?php echo $fineRate; ?>;

        if (reportedTax < actualTax) {
            //find the difference between the taxes, and multiply it with the fine rate.

            let discrepancy = actualTax - reportedTax;

            let fine = discrepancy + (actualTax * fineRate);

            console.log("Participant was audited! Declared " + reportedTax + " vs. actual amount " + actualTax );

            return fine;
        }

        return 0;
    }

    function validateInput() {
        document.getElementById("submitButton").disabled = true;
        let input = document.getElementById("inputValue").value;
        let taxAmount = <?php echo $mostRecentScore * $taxRate; ?> ;
        let inputInt = parseInt(input);

        if (isNaN(inputInt)) {
            document.getElementById("inputFeedback").innerText = "Please enter numbers only!";


        }

        else if (inputInt < 0 || inputInt > taxAmount) {
            document.getElementById("inputFeedback").innerText = "Please enter values greater than 0 and smaller than or equal to the actual tax amount!";


        }
        else {
            console.log("valid input... " + inputInt);

            document.getElementById("inputFeedback").innerText = "";
            document.getElementById("submitButton").disabled = false;
        }
    }


</script>



<form action=<?php
$condition = $_GET['condition'];
echo "index.php?round=" . ($_GET['round'] + 1) . "&mode=1&expid=$experimentID&pid=$participantID&condition=$condition&feedback=$feedback&order=$order&presentation=$presentation" ?> method="post">


    <div id="taxInputContainer">
        <label for="inputValue">Please indicate the amount of tax you decide to pay: </label>
        <input type="text" id="inputValue" onkeyup="validateInput()"> <div id="inputFeedback"></div>
    </div>

    <br>

    <input id="submitButton" type= <?php echo($feedback == "0" ? "button" : "submit"); ?>
           class="formButton" name="Continue" value="Continue" onclick="performAudit()" disabled="true">

    <div id="overlay">
        <div class="feedbackContainer">
            <table>
                <tbody>
                <tr>
                    <p>Please review the info below. If you were audited, you will also see whether you had to pay a fine.   </p>
                    <p id="auditText"></p>
                </tr>
                <tr>
                    <td>
                        Earned Income:
                    </td>
                    <td id="earnedIncomeCell">

                    </td>
                </tr>
                <tr id="declaredIncomeRow" style="display: none;">
                    <td>
                        Declared Income:
                    </td>
                    <td id="declaredIncomeCell">

                    </td>
                </tr>
                <tr>
                    <td>
                        Tax due (in ECU):
                    </td>
                    <td id="taxDueCell">

                    </td>
                </tr>

                <tr id="paidTaxRow">
                    <td>
                        Paid Tax:
                    </td>
                    <td id="paidTaxCell">

                    </td>
                </tr>
                <tr id="missingTaxRow">
                    <td>
                        Missing Tax plus fine:
                    </td>
                    <td id="missingTaxCell">

                    </td>
                </tr>

                <tr>
                    <td>
                        Net Income:
                    </td>
                    <td id="netIncomeCell">

                    </td>
                </tr>
                </tbody>
            </table>
             <input type="submit" value="Close Box & Continue" onclick="collapseInformation('submit','submit','submit')">
        </div>
    </div>
</form>



