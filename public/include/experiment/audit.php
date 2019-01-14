



<div>
    <div>
        <h1> Tax Audit </h1>
    </div>
    <br>
    <div>
        <h3>Don't Forget: </h3>
    </div>
    <ul>
        <li>
            <b>
                Audit Probability
            </b>
            <p> The likelihood that you will be audited. A probability of 0.2 means that in two of ten cases, you will be audited. </p>
        </li>
        <li>
            <b>
                Fine Rate
            </b>
            <p> The number that determines how high your potential fine is. A fine rate of 3 means that that fine is 3 * ((actual income) - (self reported income)). (Note: Fines only have to be paid if you were audited and under-reported your earnings). </p>
        </li>
        <li>
            <b>
                Tax Rate:
            </b>
            <p>
                The number that determines how much taxes you have to pay. A tax rate of 0.2 means that 20% of your reported income are automatically subtracted.
            </p>
        </li>
    </ul>
</div>

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

<script>


    //is always called after the button is pushed.
    function performAudit(txt1, txt2, txt3) {
        let reportedValue = parseInt(document.getElementById("inputValue")); //self reported score
        document.getElementById("reportedIncome").value = reportedValue;

        let probability = <?php echo $auditProbability?>;
        let mostRecentScore = <?php echo $mostRecentScore ?>; //actual income
        let taxRate = <?php echo $taxRate ?>;

        let honesty = mostRecentScore == reportedValue;



        let randomNr = Math.random();

        console.log("testing " + randomNr + " against probability " + probability);

        if (randomNr <= probability) {


            let fine = audit(mostRecentScore);

            mostRecentScore = mostRecentScore - fine;

            document.getElementById("income").value = "" + mostRecentScore;

            document.getElementById("wasAudited").value = "true";

            document.getElementById("wasHonest").value = honesty;

            console.log("Participant was audited");

        }
        else {

            let taxAmount = Math.(reportedValue * taxRate);
            reportedValue = reportedValue - taxAmount;

            document.getElementById("income").value = "" + mostRecentScore;

            document.getElementById("wasAudited").value = "false";

            document.getElementById("wasHonest").value = honesty;

            console.log("No Audit");
        }

        //does JS stuff in MLWEB, calls save.php
        //timefunction(txt1, txt2, txt3);


    }

    //checks the input value in case of an audit, and calculates a fine if needed. Returns 0 (in case of honest input) or else the amount of the fine in int.
    function audit(mostRecentScore) {
        let input = document.getElementById('inputValue');
        input = parseInt(input);
        let fineRate = <?php echo $fineRate; ?>;

        if (input < mostRecentScore) {
            //find the difference, and multiply it with the fine rate.

            let fine = (mostRecentScore-input) * fineRate;

            alert("You were audited! You declared an income of " + input + " while you earned "
                + mostRecentScore + " in the last round. As a result, a fine of " + fineRate + " was subtracted from your score" );

            return fine;
        }

        return 0;
    }


</script>
<?php include ("../../../resources/templates/presentation1.php");
?>



<form action=<?php echo "index.php?round=" . ($_GET['round'] + 1) . "&mode=1&expid=$experimentID&pid=$participantID" ?> method="post">


    <label for="inputValue">Value: </label>
    <input type="text" id="inputValue">
    <br>

    <input type="submit" class="formButton" name="Continue" value="Continue" onclick="performAudit('submit','submit','submit')">
</form>

