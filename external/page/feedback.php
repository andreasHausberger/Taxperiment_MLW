<?php

$incomeGuaranteed = 1000;
$incomeSlider = 400;

$incomeTotal = $incomeGuaranteed + $incomeSlider;
$taxRate = 0.2;
$taxPaid = 200;

?>

<h1> Feedback </h1>
<br>

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
            Earnings slider task (4 correct):
        </td>
        <td>
            + <?php echo $incomeSlider?> ECU
        </td>
    </tr>
    <tr>
        <td>
            Total income before tax:
        </td>
        <td>
            = <?php echo $incomeTotal?> ECU
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
    <tr>
        <td>
            Total income after Tax:
        </td>
        <td>
            = <?php echo $incomeTotal - $taxPaid ?> ECU
        </td>
    </tr>

</table>
