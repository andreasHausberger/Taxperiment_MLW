<?php

$feedbackData = loadFeedbackData($round, $participantID);

$incomeGuaranteed = 1000;
$actualIncome = $feedbackData["actual_income"];
$incomeSlider = $feedbackData["actual_income"];
$netIncome = $feedbackData["net_income"];
$taxRate = $feedbackData["tax_rate"];
$taxDue = $feedbackData["actual_tax"];

$taxPaid = $feedbackData["declared_tax"];
$audit = $feedbackData["audit"];
$honesty = $feedbackData["honesty"];
$fineRate = $feedbackData["fine_rate"];
$backPay = $taxDue - $taxPaid;
$fine = floor($fineRate * $backPay);
$incomeTotal = $incomeGuaranteed + $incomeSlider;

$finalIncome = 0;

if ($audit && !$honesty) {
    $finalIncome = $incomeTotal - $backPay - ($fineRate * $backPay);

    if ($finalIncome < 0) {
        $finalIncome = 0;
    }
}
else {
    $finalIncome = $incomeTotal - $taxPaid;
}

$correctSliderAmount = $incomeSlider / 100;


$auditText = "";
$fineText = "";

if ($audit == 1) {
    $auditText = "<p class=\"text-danger\">You were <u> audited </u></p>";

    if ($honesty == 0) {
        $fineText = "The outcome of the audit was that you did not pay enough taxes.";
    }
}
else {
    $auditText = "<p class=\"text-body\"> You were <u>not</u> audited in this round.";
}

?>

<div class="text-body">
    <?php echo $auditText; ?>
    <p>
        <?php echo $fineText; ?>
    </p>

    <p>
        <b>Income in this round after filed taxes</b>
    </p>
</div>

<table class="mlwTable table">
    <tr>
        <td>
            Guaranteed Earnings:
        </td>
        <td>
            <?php echo $incomeGuaranteed?> ECU
        </td>
    </tr>
    <tr>
        <td>
            Earnings slider task (<?php echo $correctSliderAmount; ?> correct):
        </td>
        <td>
            + <?php echo $incomeSlider; ?> ECU
        </td>
    </tr>
    <tr>
        <td>
            Total income before tax:
        </td>
        <td>
            = <?php echo $actualIncome + $incomeGuaranteed; ?> ECU
        </td>
    </tr>
    <tr>
        <td>
            Tax paid (Tax due: <?php echo $taxRate * 100; ?>% = <?php echo $taxRate * $incomeTotal ?> ECU)
        </td>
        <td>
            - <?php echo $taxPaid; ?> ECU
        </td>
    </tr>
    <?php
        if ($audit) {
            echo "
            <tr>
        <td>
            Payment of Missing Tax: 
        </td>
        <td>
            - $backPay ECU
        </td>
    </tr>
    <tr>
        <td>
           Fine ($fineRate x evaded amount):
        </td>
        <td>
            - $fine ECU
        </td>
    </tr>
            ";
        }
    ?>
    <tr>
        <td>
            Total income after Tax:
        </td>
        <td>
            = <?php echo $finalIncome ?> ECU
        </td>
    </tr>

</table>
