<?php
$saveURL =  "../external/save/save.php";
$roundData = loadMouselabTableData($round, $participantID);

//Prepare Data
$conditionParameter = intval(getParamValue("condition", "1"));

if ($conditionParameter == 0) {
    $conditionParameter = 1;
}
$currentRoundIndex = 1;
$condition = $conditionParameter;
$currentCondition = $conditionParameter;
$feedback = 0;

$expRoundArray = $expRounds['data'];
$randomisedRoundOrderArray = json_decode($roundOrder);
//$randomisedConditionArray = json_decode($conditionOrder);
//$currentRoundIndex = $_GET['round'] - 1;
$currentRound = $expRoundArray[$randomisedRoundOrderArray[$currentRoundIndex]];

$taxRate = $roundData["tax_rate"];
$auditProbability = $roundData["audit_probability"];
$fineRate = $roundData["fine_rate"];
$income = $roundData["income"] + 1000;

$subjectID = $dataArray['pid'];
//var_dump($subjectID);
$experimentID = $_GET['expid'];
$currentRound = $_GET['round'];
//$condition = $_GET['condition'];
$nextRound = $_GET['round'] + 1;
$nextMode = $_GET['mode'] == 2 ? 1 : 2;
?>

<script>

    //prevents entry with Enter key.
    $(document).keypress(
        function(event){
            if (event.which == '13') {
                event.preventDefault();
            }
        });

    $(document).ready( () => {
        $("#submitButton").click( (e) => {
            console.log("prefiled tax: ");
            let button = e.target;
            if (!button.disabled) {
                let input = document.getElementById("incomeInput");
                input.disabled = true;
                button.classList.add("disabled_button");
            }
        });

        $(window).on('beforeunload', () => {
            let auditIsComplete = document.getElementById("auditComplete").value;
            let taxAmount = document.getElementById("reported_tax").value;
            console.log("declared tax: " + taxAmount);
            console.log("audit complete: " + auditIsComplete);

            if (taxAmount != null && auditIsComplete != 1) {
                performAudit(taxAmount, true, false);
                document.getElementById("auditComplete").value = 1
                button.disabled = true
            }

        })
    });

    function saveProcessData(url, subjectID, experimentID, round, choice, condition, procdata) {
        $.ajax({
            url: url,
            type: "post",
            data: {
                action: "ajax_mlweb",
                subject_id: subjectID,
                experiment_id: experimentID,
                condition: condition,
                round: round,
                choice: choice,
                procdata: procdata
            },
            success: (response) => {
                globalIsDisabled = true
                console.log(response);
            }

        })
        .done( (response) => {
            globalIsDisabled = true

        })
        .fail( () => {
            globalIsDisabled = false
        })
    }

    function saveAuditData(url, netIncome, taxDue, declaredTax, actualTax, honesty, audit, fine, isPrefiled) {
        let pid = <?php echo $participantID; ?>;
        let round = <?php echo $round; ?>;
        $.ajax({
            url: url,
            type: "post",
            data: {
                action: "ajax_audit",
                id: pid,
                round: round,
                actual_income: income,
                net_income: netIncome,
                tax_due: taxDue,
                declared_tax: declaredTax,
                actual_tax: actualTax,
                honesty:  honesty ? 1 : 0,
                prefiled: isPrefiled ? 1 : 0,
                audit: audit ? 1 : 0,
                fine: fine
            },
            success: (response) => {
                console.log(response);
            }
        })
        .done( (response) => {

        })
        .fail( () => {

        })
    }
</script>
<div style="margin: 5vh auto">



<?php
if ($conditionParameter == 1) {
    include($_SERVER["DOCUMENT_ROOT"] . "/resources/templates/group2.php");
}
else {
    include($_SERVER["DOCUMENT_ROOT"] . "/resources/templates/group2inverted.php");
}
?>
</div>

<div style="text-align: center">
        <div class="input-group">
            <input type="text" class="form-control" id="incomeInput" autocomplete="off" placeholder="Enter tax amount you decide to declare" aria-label="Declare Income" id="incomeInput" name="income">
            <div class="btn btn-light" id="submitButton" value="">Pre-file Taxes </div>
        </div>
    <div class="input-group">
        <div id="inputFeedback"></div>
    </div>

</div>

<script>

    $(function() {

        let tableIsDeactivated = false;

        let condition = <?php echo $condition ?>;

        let signContainer = $(".signContainer");
        let cueContainer = $("#cue_container");


        let randomCondition = <?php echo $currentCondition ?>;


        if (condition == 2) {
            $("#c0Container").hide();
            $("#c1Container").hide();
        }
        else if(condition == 1) {
            signContainer.hide();
            cueContainer.hide();
        }

        signContainer.mouseenter( function(e) {
            if (!tableIsDeactivated) {
               console.log("Mouse Over Sign Container!");
                let mouseEvent = new MouseEvent("mouseover");
                let angleInfo = 0;
                ShowCont('box', mouseEvent, true, angleInfo);
            }
        });

        signContainer.mouseleave( function(e) {
            if (!tableIsDeactivated) {
                console.log("Mouse Leave Sign Container!");
                let mouseEvent = new MouseEvent("mouseout");
                displayContentForSignContainer(condition, randomCondition, angle, false);
                HideCont('box', mouseEvent, true);
            }
        });

        let income = <?php echo $income ?>;
        let taxRate = <?php echo $taxRate ?>;

        $("#submitButton").click(function (event) {
            let button = event.target

            if (!button.disabled) {
                console.log("Prefile taxes clicked");

                let taxAmount = document.getElementById("reported_tax").value;
                if (taxAmount != null) {
                    let taxDue = income * taxRate
                    let isCompliant = taxAmount >= taxDue;
                    performAudit(taxAmount, isCompliant);
                    button.disabled = true
                }
            }

        });

        $("#incomeInput").change( (e) => {
            let inputIsValid = validateInput();
            if (inputIsValid) {
                document.getElementById("reported_tax").value = e.target.value
            }
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
            $('#signContainerOuter').hide();
            showRotatedIndicator(angle);
        }
        else
        {
            $('#signContainerOuter').show();
            $('#signContainerInner').hide();
        }
    }

    function showRotatedIndicator(angle) {
        $('#signContainerInner').show();
        let rotation = 'rotate(' + angle + 'deg)';
        document.getElementById("cue_arrow").style.transform = rotation;
    }

    function performAudit(paraTaxAmount, paraHonesty = true, paraPrefiled = true) {
        auditIsPrefiled = paraPrefiled
        let reportedTax = parseInt(paraTaxAmount)
        document.getElementById("tax").value = <?php echo $income * $taxRate ?>;
        let actualIncome = <?php echo $income ?>

            let netIncome = 0; //what the participant earns after tax

        let probability = <?php echo $auditProbability?>;
        let actualTax = <?php echo $income * $taxRate ?>; //actual income
        let taxRate = <?php echo $taxRate ?>;

        let honesty = actualTax == reportedTax;
        let randomNr = Math.random();
        let audit = (randomNr <= probability);
        let fine = 0;

        netIncome = actualIncome - reportedTax;

        console.log("testing " + randomNr + " against probability " + probability);

        if (audit) {
            fine = calculateFine(actualTax, reportedTax);

            if (fine !== 0) {
                netIncome = netIncome - fine;
                setModalBodyContent("You were audited. The audit has found that you under-reported your tax amount. You were " +
                    "fined " + fine + " ECU. Your income in this round is " + netIncome + ". ");
            }
            else
            {
                setModalBodyContent("You were audited. The audit has found that you correctly reported your tax amount. ");
            }

            if (netIncome < 0) { netIncome = 0; }
            document.getElementById("wasAudited").value = "true";

        }
        else {
            document.getElementById("wasAudited").value = false;
            setModalBodyContent("You were not audited.");
            console.log("No Audit");
        }

        document.getElementById("reported_tax").value = "" + reportedTax;
        document.getElementById("actual_income").value = "" + actualIncome;
        document.getElementById("net_income").value = "" + netIncome;
        document.getElementById("wasHonest").value = honesty;
        document.getElementById("fine").value = "" + fine;
        document.getElementById("auditComplete").value = 1;

        //save audit data
        let saveURL ='<?php echo $saveURL; ?>';
        saveAuditData(saveURL, actualIncome, taxRate, reportedTax, actualTax, honesty, audit, fine, paraPrefiled);

        //prepare & save MLWEB Data. Also disables Table on success.
        prepareMlwebSave();
    }

    function setModalBodyContent(text) {
        $("#modalBody").text(text);
    }

    function prepareMlwebSave(isPrefiled = 1) {
        let saveURL ='<?php echo $saveURL; ?>';
        let subjectID = document.getElementById('subjectID').value;
        let experimentID = document.getElementById('experimentID').value;
        let round = document.getElementById('round').value;
        let condition = document.getElementById('condition').value;
        let choice = document.getElementById('choice').value;
        let procdata = document.getElementById('procdata').value;

        saveProcessData(saveURL, subjectID, experimentID, round, choice, condition, procdata);
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

        timefunction(txt1, txt2, txt3);
        disableButtons();
    }

    function calculateFine(actualTax, reportedTax) {
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
        let button = document.getElementById("submitButton")
        button.disabled = true;
        button.classList.add("disabled_button");

        let input = document.getElementById("incomeInput").value;
        let taxAmount = <?php echo $income * $taxRate; ?> ;
        let inputInt = parseInt(input);

        if (isNaN(inputInt)) {
            document.getElementById("inputFeedback").innerText = "Please enter numbers only!";
            return false;
        }
        else if (inputInt < 0 || inputInt > taxAmount) {
            document.getElementById("inputFeedback").innerText = "Please enter values of a minimum of 0 and a maximum of the amount of tax due!";
            return false;
        }
        else {
            console.log("valid input... " + inputInt);
            document.getElementById("inputFeedback").innerText = "";
            document.getElementById("submitButton").disabled = false;
            button.classList.remove("disabled_button");

            return true;
        }
    }

    function disableButtons() {
        let elements = document.getElementsByClassName("auditButton");
        for (let i = 0; i < elements.length; i++) {
            elements[i].style.visibility = 'hidden';
        }
    }



</script>

<?php

?>


