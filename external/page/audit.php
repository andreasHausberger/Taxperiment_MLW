<?php

$saveURL =  "../external/save/save.php";

//Prepare Data

require_once($_SERVER["DOCUMENT_ROOT"] . "/public/dataLoader.php");

$currentRoundIndex = 1;
$condition = 4;
$feedback = 0;

$expRoundArray = $expRounds['data'];
$randomisedRoundOrderArray = json_decode($roundOrder);
//$randomisedConditionArray = json_decode($conditionOrder);
//$currentRoundIndex = $_GET['round'] - 1;
$currentRound = $expRoundArray[$randomisedRoundOrderArray[$currentRoundIndex]];
$currentCondition = 3;

$taxRate = 0.4; //$currentRound['tax_rate'];
$auditProbability = 0.1;  //$currentRound['audit_probability'];
$fineRate = 1; //$currentRound['fine_rate'];
$income = 900; //$currentRound['income'];

$subjectID = $dataArray['pid'];
//var_dump($subjectID);
$experimentID = $_GET['expid'];
$participantID = $_GET['pid'];
$currentRound = $_GET['round'];
//$condition = $_GET['condition'];
$nextRound = $_GET['round'] + 1;
$nextMode = $_GET['mode'] == 2 ? 1 : 2;
$saveURL

?>

<script>
    $(document).ready( () => {
        $("#submitButton").on("click", (e) => {
            console.log("prefiled tax: ");
            let button = e.target;
            let input = document.getElementById("incomeInput");
            input.disabled = true;
            button.classList.add("disabled_button");
        })
    });

    function saveProcessData(url, procdata, round, id) {
        $.ajax({

        })
    }
</script>
<div style="margin: 5vh auto">
<?php
    include($_SERVER["DOCUMENT_ROOT"] .  "/resources/templates/group2.php"); ?>
</div>

<div style="text-align: center">
        <div class="input-group">
            <input type="text" class="form-control" id="incomeInput" placeholder="Declare Income" aria-label="Declare Income" id="incomeInput" name="income">
            <div class="btn btn-light" id="submitButton" value="">Pre-File Taxes </div>
        </div>
</div>

<?php

?>


