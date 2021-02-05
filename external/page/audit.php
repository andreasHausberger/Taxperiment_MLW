<?php

$saveURL =  "../external/save/save.php";

$roundData = loadMouselabTableData($round, $participantID);

//Prepare Data

//require_once($_SERVER["DOCUMENT_ROOT"] . "/public/dataLoader.php");

$currentRoundIndex = 1;
$condition = 4;
$feedback = 0;

$expRoundArray = $expRounds['data'];
$randomisedRoundOrderArray = json_decode($roundOrder);
//$randomisedConditionArray = json_decode($conditionOrder);
//$currentRoundIndex = $_GET['round'] - 1;
$currentRound = $expRoundArray[$randomisedRoundOrderArray[$currentRoundIndex]];
$currentCondition = 3;

$taxRate = $roundData["tax_rate"]; //$currentRound['tax_rate'];
$auditProbability = $roundData["audit_probability"];  //$currentRound['audit_probability'];
$fineRate = $roundData["fine_rate"]; //$currentRound['fine_rate'];
$income = $roundData["income"] + 1000; //$currentRound['income'];

$subjectID = $dataArray['pid'];
//var_dump($subjectID);
$experimentID = $_GET['expid'];
$currentRound = $_GET['round'];
//$condition = $_GET['condition'];
$nextRound = $_GET['round'] + 1;
$nextMode = $_GET['mode'] == 2 ? 1 : 2;
?>

<script>

    $(document).keypress(
        function(event){
            if (event.which == '13') {
                event.preventDefault();
            }
        });

    $(document).ready( () => {



        $("#submitButton").on("click", (e) => {
            console.log("prefiled tax: ");
            let button = e.target;
            let input = document.getElementById("incomeInput");
            input.disabled = true;
            button.classList.add("disabled_button");
        })
    });

    function saveProcessData(url, subjectID, experimentID, round, choice, procdata) {
        $.ajax({
            url: url,
            type: "post",
            data: {
                action: "ajax_mlweb",
                subject_id: subjectID,
                experiment_id: experimentID,
                round: round,
                choice: choice,
                procdata: procdata
            },
            success: (response) => {
                console.log(response.message);
            }

        })
        .done( (response) => {

        })
        .fail( () => {

        })
    }

    function saveAuditData(url, netIncome, taxDue, declaredTax, actualTax, honesty, audit, fine) {
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
                honesty: honesty,
                audit: audit,
                fine: fine
            },
            success: (response) => {

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
    include($_SERVER["DOCUMENT_ROOT"] .  "/resources/templates/group2.php"); ?>
</div>

<div style="text-align: center">
        <div class="input-group">
            <input type="text" class="form-control" id="incomeInput" placeholder="Enter tax amount you decide to declare" aria-label="Declare Income" id="incomeInput" name="income">
            <div class="btn btn-light" id="submitButton" value="">Pre-file Taxes </div>
        </div>

    <!-- Modal -->
    <div class="modal fade" id="auditModal" role="dialog" aria-labelledby="auditModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Audit Result</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalBody">
                    ...
                </div>
            </div>
        </div>
    </div>

</div>

<script>

    $(document).keypress(
        function(event){
            if (event.which == '13') {
                event.preventDefault();
            }
        });

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

        $("#submitButton").click(function () {
            console.log("Prefile taxes clicked");
            let taxAmount = $("#incomeInput").val();

            if (taxAmount != null) {
                let taxDue = income * taxRate
                let isCompliant = taxAmount >= taxDue;
                performAudit(taxAmount, isCompliant);
            }
        })

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

        //save audit data
        let saveURL ='<?php echo $saveURL; ?>';
        saveAuditData(saveURL, actualIncome, taxRate, reportedTax, actualTax, honesty, audit, fine);

        //prepare & save MLWEB Data
        prepareMlwebSave();
        $("#auditModal").modal("show");
    }

    function setModalBodyContent(text) {
        $("#modalBody").text(text);
    }

    function prepareMlwebSave() {
        let saveURL ='<?php echo $saveURL; ?>';
        let subjectID = document.getElementById('subjectID').value;
        let experimentID = document.getElementById('experimentID').value;
        let round = document.getElementById('round').value;
        let choice = document.getElementById('choice').value;
        let procdata = document.getElementById('procdata').value;

        saveProcessData(saveURL, subjectID, experimentID, round, choice, procdata);
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

    function disableButtons() {
        let elements = document.getElementsByClassName("auditButton");
        for (let i = 0; i < elements.length; i++) {
            elements[i].style.visibility = 'hidden';
        }
    }



</script>

<?php

?>


