<?php
$expRoundArray = $expRounds['data'];
$randomisedRoundOrderArray = json_decode($roundOrder);
$randomisedConditionArray = json_decode($conditionOrder);
$currentRoundIndex = $_GET['round'] - 1;
$currentRound = $expRoundArray[$randomisedRoundOrderArray[$currentRoundIndex]];
$currentCondition = $randomisedConditionArray[$currentRoundIndex];

$taxRate = $currentRound['tax_rate'];
$auditProbability = $currentRound['audit_probability'];
$fineRate = $currentRound['fine_rate'];
$sureGain = $currentRound['honest_gain'];
$evEvasion = $currentRound['ev_evasion'];
$income = $currentRound['income'];
$angle = $currentRound['angle'];

$subjectID = $dataArray['pid'];
//var_dump($subjectID);
$experimentID = $_GET['expid'];
$participantID = $_GET['pid'];
$currentRound = $_GET['round'];
$condition = $_GET['condition'];
$nextRound = $_GET['round'] + 1;
$nextMode = $_GET['mode'] == 2 ? 1 : 2;
?>

<div id="auditContentContainer" style="margin-top: 5vh">
    <?php

    if (isset($_GET['feedback'])) {
        $delayFeedback = $_GET['feedback'];
    }
    else {
        echo "WARNING: Could not find feedback information!";
    }
    if (isset($_GET['condition'])) {

        if ($condition == 1 || $condition == 2) {
            include("../../../resources/templates/group1.php");
        }
        elseif ($condition == 3 || $condition == 4) {
            include("../../../resources/templates/group2.php");
        }
        else {
            echo "Could not read condition!";
        }
    }
    else {
        echo "Could not load MLW table!";
    }

    ?>

</div>


<script>

    $(function() {

        let condition = <?php echo $condition ?>;

        let sureGain = <?php echo $sureGain ?>;

        let signContainer = $(".signContainer");
        let cueContainer = $("#cue_container");


        let randomCondition = <?php echo $currentCondition ?>;

        let angle = <?php echo $angle ?>;

        if (condition == 2) {
            $("#c0Container").hide();
            $("#c1Container").hide();
        }
        else if(condition == 1) {
            signContainer.hide();
            cueContainer.hide();
        }

        signContainer.mouseenter( function(e) {
            console.log("Mouse Over Sign Container!");
            let value = displayContentForSignContainer(condition, randomCondition, angle, true);
            ShowCont('box', e, true, value);
        });

        signContainer.mouseleave( function(e) {
            console.log("Mouse Leave Sign Container!");
            displayContentForSignContainer(condition, randomCondition, angle, false);
            HideCont('box', e, true);
        });



        //no sign box for condition 1!


        let income = <?php echo $income ?>;
        let taxRate = <?php echo $taxRate ?>;
        $("#complyButton").click(function() {
            console.log("Comply Button clicked");
            let taxAmount = income * taxRate;
            performAudit(taxAmount, true);
        });

        $("#evadeButton").click(function() {
            console.log("Evade Button clicked");
            performAudit(0, false);
        });
    });

    $('form').on('keydown', function(event) {
        var x = event.which;
        if (x === 13) {
            event.preventDefault();
            console.log("Prevented Enter");
        }
    });

    function displayContentForSignContainer(condition, randomCondition, angle, mouseIsOver = false) {
        if (mouseIsOver) {
            showRotatedIndicator(angle);
        }
        else
        {
            $('#signContainerInner').hide();
        }
    }

    function showRotatedIndicator(angle) {
        $('#signContainerInner').show();
        let rotation = 'rotate(' + angle + 'deg)';
        document.getElementById("cue_arrow").style.transform = rotation;
    }

    //is always called after the button is pushed.
    function performAudit(paraTaxAmount, paraHonesty = true) {
        let reportedTax = parseInt(paraTaxAmount) //parseInt(document.getElementById("inputValue").value); //self reported tax
        document.getElementById("tax").value = <?php echo $income * $taxRate ?>;
        let actualIncome = <?php echo $income ?>

        let netIncome = 0; //what the participant earns after tax

        let probability = <?php echo $auditProbability?>;
        let actualTax = <?php echo $income * $taxRate ?>; //actual income
        let taxRate = <?php echo $taxRate ?>;

        let honesty = paraHonesty; //true or false, depending on the declaration

        let randomNr = Math.random();
        let audit = (randomNr <= probability);

        let fine = 0;

        netIncome = actualIncome - reportedTax;


        console.log("testing " + randomNr + " against probability " + probability);

        if (audit) {
            fine = startAudit(actualTax, reportedTax);

            if (fine !== 0) {
                netIncome = netIncome - fine;
            }

            if (netIncome < 0) { netIncome = 0; }
            document.getElementById("wasAudited").value = "true";

        }
        else {
            document.getElementById("wasAudited").value = false;

            console.log("No Audit");
        }

        document.getElementById("reported_tax").value = "" + reportedTax;
        document.getElementById("actual_income").value = "" + actualIncome;
        document.getElementById("net_income").value = "" + netIncome;
        document.getElementById("wasHonest").value = honesty;
        document.getElementById("fine").value = "" + fine;


        submitInformation("submit", "submit", "submit");

        //let feedbackIsDelayed = <?php //echo $delayFeedback ?>// ;
        //
        //
        //
        //if (feedbackIsDelayed == 0) {
        //    displayInformation(audit, actualIncome, netIncome, fine, taxRate, reportedTax);
        //}
        //else {
        //    collapseInformation("submit", "submit", "submit");
        //   // window.location.href = "  <?php //echo "index.php?round=" . ($_GET['round'] + 1) . "&mode=1&expid=$experimentID&pid=$participantID&feedback=$feedback&order=$order&presentation=$presentation"; ?>//";
        //}


    }

    function displayInformation(audit, income, reportedIncome, fine, taxRate, reportedTax) {

        let paidTaxAmount = income - reportedIncome;
        let actualTaxAmount = Math.floor(income * taxRate);
        let taxDiscrepancy = actualTaxAmount - reportedTax;

        let totalFineAmount = audit ?  fine : taxDiscrepancy;
        document.getElementById("earnedIncomeCell").innerText = income;
        document.getElementById("declaredIncomeCell").innerText = reportedIncome;
        document.getElementById("taxDueCell").innerText = Math.floor(income * taxRate);
        document.getElementById("paidTaxCell").innerText = reportedTax;
        document.getElementById("netIncomeCell").innerText = reportedIncome;
        document.getElementById("missingTaxCell").innerText = totalFineAmount;


        if (audit) {
            document.getElementById("missingTaxRow").style.display = "table-row";
            document.getElementById("auditText").innerHTML = "You were <b> audited! </b> "
            // document.getElementById("paidTaxRow").style.display = "none";
            // document.getElementById("declaredIncomeRow").style.display = "none";
        }
        else {
            document.getElementById("auditText").innerHTML = "You were <b> not audited! </b> "
            document.getElementById("missingTaxRow").style.display = "none";

        }
        console.log("finished calculations, now displaying...");


        document.getElementById("feedbackOverlay").style.width = "100%";
        document.getElementById("feedbackOverlay").style.display = "block";
    }

    function submitInformation(txt1, txt2, txt3) {

        document.getElementById('feedbackOverlay').style.width = '0';
        timefunction(txt1, txt2, txt3);
        // document.getElementById("mlwebform").submit();
    }

    //checks the input value in case of an audit, and calculates a fine if needed. Returns 0 (in case of honest input) or else the amount of the fine in int.
    function startAudit(actualTax, reportedTax) {
        let fineRate = <?php echo $fineRate; ?>;

        if (reportedTax < actualTax) {
            //find the difference between the taxes, and multiply it with the fine rate.

            let discrepancy = actualTax - reportedTax;

            let fine = discrepancy + (discrepancy * fineRate); // fine is the amount of evaded tax + fine rate * the amount of evaded tax

            console.log("Participant was audited! Declared " + reportedTax + " vs. actual amount " + actualTax );

            return fine;
        }

        return 0;
    }

    function validateInput() {
        document.getElementById("submitButton").disabled = true;
        let input = document.getElementById("inputValue").value;
        let taxAmount = <?php echo $income * $taxRate; ?> ;
        let inputInt = parseInt(input);

        if (isNaN(inputInt)) {
            document.getElementById("inputFeedback").innerText = "Please enter numbers only!";

        }

        else if (inputInt < 0 || inputInt > taxAmount) {
            document.getElementById("inputFeedback").innerText = "Please enter values of a minimum of 0 and a maximum of the amount of tax due!";
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
$link = "index.php?round=$nextRound&mode=1&expid=$experimentID&pid=$participantID&condition=$condition&feedback=$feedback&order=$order&presentation=$presentation";
echo $link?> method="post">


    <div id="taxInputContainer">
<!--        <label for="inputValue">Please choose whether to pay the taxes stated above or to evade completely: </label>-->
<!--        <input class="noEnter" type="text" id="inputValue" onkeyup="validateInput()" autocomplete="off"> <div id="inputFeedback"></div>-->
        <br>
        <?php
        $buttonsShouldBeMirrored = $currentCondition == 7;
        getAuditButtons($buttonsShouldBeMirrored); ?>


    </div>

    <br>
<!---->
<!--    <input id="submitButton" type= --><?php //echo($feedback == "0" ? "button" : "submit"); ?>
<!--           class="formButton" name="Continue" value="Continue" onclick="performAudit()" disabled="true">-->

    <div class="overlay" id="feedbackOverlay">
        <div class="feedbackContainer">
            <table>
                <tbody>
                <tr>
                    <p>Please review the info below. If you were audited, you will also see whether you had to pay a fine.   </p>
                    <p id="auditText"></p>
                </tr>
                <tr>
                    <td>
                        Earned income:
                    </td>
                    <td id="earnedIncomeCell">

                    </td>
                </tr>
                <tr id="declaredIncomeRow" style="display: none;">
                    <td>
                        Declared income:
                    </td>
                    <td id="declaredIncomeCell">

                    </td>
                </tr>
                <tr>
                    <td>
                        Tax due:
                    </td>
                    <td id="taxDueCell">

                    </td>
                </tr>

                <tr id="paidTaxRow">
                    <td>
                        Paid tax:
                    </td>
                    <td id="paidTaxCell">

                    </td>
                </tr>
                <tr id="missingTaxRow">
                    <td>
                        Fine + payback:
                    </td>
                    <td id="missingTaxCell">

                    </td>
                </tr>

                <tr>
                    <td>
                        Net income:
                    </td>
                    <td id="netIncomeCell">

                    </td>
                </tr>
                </tbody>
            </table>
             <input type="submit" value="Close Box & Continue" onclick="submitInformation('submit','submit','submit')">
        </div>
    </div>
</form>



