<?php
/**
 * Created by PhpStorm.
 * User: andreas
 * Date: 21.11.19
 * Time: 11:36
 */

$incomeLabel = "Income";
$taxLabel = "Tax Due";
$auditLabel = "Audit Probability";
$fineLabel = "Fine";
$sureGainLabel = "Sure Outcome: Pay Tax";
$evRiskyLabel = "Expected Value: Don't Pay Tax";

$taxPercentage = doubleval($taxRate) * 100;
$auditPercentage = doubleval($auditProbability) * 100;
$taxDue = intVal($income) * doubleval($taxRate);
$fine = $taxDue + ($taxDue * $fineRate);

$taxRatePercentagePoints = intval($taxRate * 100);

$incomeContent = "$income ECU";
$taxContent = "$taxRatePercentagePoints% = $taxDue ECU";
$auditContent = "$auditPercentage%";
$fineContent = "$fine ECU";
$evRiskyContent = "$evEvasion ECU";
$sureGainContent = "$sureGain ECU";

$cellHeight = "150";
$cellWidth = "150";

$heightString = $cellHeight . "^" . $cellHeight . "^" . $cellHeight;
$widthString = $cellWidth . "^" . $cellWidth;

$incomeBox = "<!--cell a0(tag:a0)-->
                <TD class=\"leftColumnCell\">
                    <DIV ID=\"a0_cont\" style=\"position: relative; height: 50px; width: 100px;\">
                        <DIV ID=\"a0_txt\"
                             STYLE=\"position: absolute; left: 0px; top: 0px; height: 50px; width: 100px; clip: rect(0px 100px 50px 0px); z-index: 1;\">
                            <TABLE>
                                <TD ID=\"a0_td\" align=center valign=center width=95 height=45 class=\"actTD\">income_inner</TD>
                            </TABLE>
                        </DIV>
                        <DIV ID=\"a0_box\"
                             STYLE=\"position: absolute; left: 0px; top: 0px; height: 50px; width: 100px; clip: rect(0px 100px 50px 0px); z-index: 2;\">
                            <TABLE>
                                <TD ID=\"a0_tdbox\" align=center valign=center width=95 height=45 class=\"boxTD\">income</TD>
                            </TABLE>
                        </DIV>
                        <DIV ID=\"a0_img\"
                             STYLE=\"position: absolute; left: 0px; top: 0px; height: 50px; width: 100px; z-index: 5;\"><A
                                    HREF=\"javascript:void(0);\" NAME=\"a0\" onMouseOver=\"ShowCont('a0',event)\"
                                    onMouseOut=\"HideCont('a0',event)\"><IMG NAME=\"a0\" SRC=\"/resources/library/mlwebphp_100beta/transp.gif\" border=0 width=100
                                                                           height=50></A></DIV>
                    </DIV>
                </TD>
                <!--end cell-->";

$taxRateBox = "<!--cell a1(tag:a1)-->
                <TD class=\"leftColumnCell\">
                    <DIV ID=\"a1_cont\" style=\"position: relative; height: 50px; width: 100px;\">
                        <DIV ID=\"a1_txt\"
                             STYLE=\"position: absolute; left: 0px; top: 0px; height: 50px; width: 100px; clip: rect(0px 100px 50px 0px); z-index: 1;\">
                            <TABLE>
                                <TD ID=\"a1_td\" align=center valign=center width=95 height=45 class=\"actTD\">tax_inner</TD>
                            </TABLE>
                        </DIV>
                        <DIV ID=\"a1_box\"
                             STYLE=\"position: absolute; left: 0px; top: 0px; height: 50px; width: 100px; clip: rect(0px 100px 50px 0px); z-index: 2;\">
                            <TABLE>
                                <TD ID=\"a1_tdbox\" align=center valign=center width=95 height=45 class=\"boxTD\">tax</TD>
                            </TABLE>
                        </DIV>
                        <DIV ID=\"a1_img\"
                             STYLE=\"position: absolute; left: 0px; top: 0px; height: 50px; width: 100px; z-index: 5;\"><A
                                    HREF=\"javascript:void(0);\" NAME=\"a1\" onMouseOver=\"ShowCont('a1',event)\"
                                    onMouseOut=\"HideCont('a1',event)\"><IMG NAME=\"a1\" SRC=\"/resources/library/mlwebphp_100beta/transp.gif\" border=0 width=100
                                                                           height=50></A></DIV>
                    </DIV>
                </TD>
                <!--end cell--></TR>";

$auditProbabilityBox = " <!--cell b0(tag:b0)-->
                <TD class=\"leftColumnCell\">
                    <DIV ID=\"b0_cont\" style=\"position: relative; height: 50px; width: 100px;\">
                        <DIV ID=\"b0_txt\"
                             STYLE=\"position: absolute; left: 0px; top: 0px; height: 50px; width: 100px; clip: rect(0px 100px 50px 0px); z-index: 1;\">
                            <TABLE>
                                <TD ID=\"b0_td\" align=center valign=center width=95 height=45 class=\"actTD\">audit_inner</TD>
                            </TABLE>
                        </DIV>
                        <DIV ID=\"b0_box\"
                             STYLE=\"position: absolute; left: 0px; top: 0px; height: 50px; width: 100px; clip: rect(0px 100px 50px 0px); z-index: 2;\">
                            <TABLE>
                                <TD ID=\"b0_tdbox\" align=center valign=center width=95 height=45 class=\"boxTD\">audit</TD>
                            </TABLE>
                        </DIV>
                        <DIV ID=\"b0_img\"
                             STYLE=\"position: absolute; left: 0px; top: 0px; height: 50px; width: 100px; z-index: 5;\"><A
                                    HREF=\"javascript:void(0);\" NAME=\"b0\" onMouseOver=\"ShowCont('b0',event)\"
                                    onMouseOut=\"HideCont('b0',event)\"><IMG NAME=\"b0\" SRC=\"/resources/library/mlwebphp_100beta/transp.gif\" border=0 width=100
                                                                           height=50></A></DIV>
                    </DIV>
                </TD>
                <!--end cell-->";

$fineRateBox = "<!--cell b1(tag:b1)-->
                <TD class=\"rightColumnCell\">
                    <DIV ID=\"b1_cont\" style=\"position: relative; height: 50px; width: 100px;\">
                        <DIV ID=\"b1_txt\"
                             STYLE=\"position: absolute; left: 0px; top: 0px; height: 50px; width: 100px; clip: rect(0px 100px 50px 0px); z-index: 1;\">
                            <TABLE>
                                <TD ID=\"b1_td\" align=center valign=center width=95 height=45 class=\"actTD\">fine_inner</TD>
                            </TABLE>
                        </DIV>
                        <DIV ID=\"b1_box\"
                             STYLE=\"position: absolute; left: 0px; top: 0px; height: 50px; width: 100px; clip: rect(0px 100px 50px 0px); z-index: 2;\">
                            <TABLE>
                                <TD ID=\"b1_tdbox\" align=center valign=center width=95 height=45 class=\"boxTD\">fine</TD>
                            </TABLE>
                        </DIV>
                        <DIV ID=\"b1_img\"
                             STYLE=\"position: absolute; left: 0px; top: 0px; height: 50px; width: 100px; z-index: 5;\"><A
                                    HREF=\"javascript:void(0);\" NAME=\"b1\" onMouseOver=\"ShowCont('b1',event)\"
                                    onMouseOut=\"HideCont('b1',event)\"><IMG NAME=\"b1\" SRC=\"/resources/library/mlwebphp_100beta/transp.gif\" border=0 width=100
                                                                           height=50></A></DIV>
                    </DIV>
                </TD>
                <!--end cell-->";


$mouselabBoxArray = array(
    1 => array(
        "label" => "$fineLabel^$auditLabel`$taxLabel^$incomeLabel`$evRiskyLabel^$sureGainLabel",
        "content" => "$fineContent^$auditContent`$taxContent^$incomeContent`$sureGainContent^$evRiskyContent"),
    2 => array(
        "label" => "$incomeLabel^$taxLabel`$auditLabel^$fineLabel`$sureGainLabel^$evRiskyLabel",
        "content" => "$incomeContent^$taxContent`$auditContent^$fineContent`$sureGainContent^$evRiskyContent"),
    3 => array(
        "label" => "$taxLabel^$incomeLabel`$fineLabel^$auditLabel",
        "content" => "$taxContent^$incomeContent`$fineContent^$auditContent"),
    4 => array(
        "label" => "$fineLabel^$auditLabel`$taxLabel^$incomeLabel`$sureGainLabel^$evRiskyLabel",
        "content" => "$fineContent^$auditContent`$taxContent^$incomeContent`$sureGainContent^$evRiskyContent"),


    5 => array(
        "label" => "$auditLabel^$fineLabel`$incomeLabel^$taxLabel`$sureGainLabel^$evRiskyLabel",
        "content" => "$auditContent^$fineContent`$incomeContent^$taxContent`$sureGainContent^$evRiskyContent"),
    6 => array(
        "label" => "$incomeLabel^$taxLabel`$auditLabel^$fineLabel`$sureGainLabel^$evRiskyLabel",
        "content" => "$incomeContent^$taxContent`$auditContent^$fineContent`$sureGainContent^$evRiskyContent"),
    7 => array(
        "label" => "$taxLabel^$incomeLabel`$fineLabel^$auditLabel`$sureGainLabel^$evRiskyLabel",
        "content" => "$taxContent^$incomeContent`$fineContent^$auditContent`$sureGainContent^$evRiskyContent"),
    8 => array(
        "label" => "$taxLabel^$incomeLabel`$fineLabel^$auditLabel`$sureGainLabel^$evRiskyLabel",
        "content" => "$taxContent^$incomeContent`$fineContent^$auditContent`$sureGainContent^$evRiskyContent"),
);


$currentBox = $mouselabBoxArray[$currentCondition];

if($condition == 3 || $condition == 4) {
    if($currentCondition == 1) {
        $currentBox = array(
            "label" => "$fineLabel^$auditLabel`$incomeLabel^$taxLabel`$evRiskyLabel^$sureGainLabel",
            "content" => "$fineContent^$auditContent`$incomeContent^$taxContent`$sureGainContent^$evRiskyContent");
    }
    else if($currentCondition == 7) {
        $currentBox = array(
            "label" => "$taxLabel^$incomeLabel`$auditLabel^$fineLabel`$sureGainLabel^$evRiskyLabel",
            "content" => "$taxContent^$incomeContent`$auditContent^$fineContent`$sureGainContent^$evRiskyContent");
    }
}

$mlwFieldArray = [$incomeBox, $taxRateBox, $fineRateBox, $auditProbabilityBox];


function getRandomizedMLWFields($paraRow1, $paraRow2)
{
//    shuffle($paraRow1);
//    shuffle($paraRow2);

    return "
    <tr>
    $paraRow1[1]
    $paraRow1[0]
    </tr>
    <tr>
    $paraRow2[0]
    $paraRow2[1]
    </tr>
    ";
}

//Section: Risk Tasks

$riskTaskArray = [
    [
        "rowName" => "row_1",
        "probA1" => "10",
        "ecuA1" => "200",
        "probA2" => "90",
        "ecuA2" => "160",
        "probB1" => "10",
        "ecuB1" => "385",
        "probB2" => "90",
        "ecuB2" => "10",
    ],
    [
        "rowName" => "row_2",
        "probA1" => "20",
        "ecuA1" => "200",
        "probA2" => "80",
        "ecuA2" => "160",
        "probB1" => "20",
        "ecuB1" => "385",
        "probB2" => "80",
        "ecuB2" => "10",
    ],
    [
        "rowName" => "row_3",
        "probA1" => "30",
        "ecuA1" => "200",
        "probA2" => "70",
        "ecuA2" => "160",
        "probB1" => "30",
        "ecuB1" => "385",
        "probB2" => "70",
        "ecuB2" => "10",
    ],
    [
        "rowName" => "row_4",
        "probA1" => "40",
        "ecuA1" => "200",
        "probA2" => "60",
        "ecuA2" => "160",
        "probB1" => "40",
        "ecuB1" => "385",
        "probB2" => "60",
        "ecuB2" => "10",
    ],
    [
        "rowName" => "row_5",
        "probA1" => "50",
        "ecuA1" => "200",
        "probA2" => "50",
        "ecuA2" => "160",
        "probB1" => "50",
        "ecuB1" => "385",
        "probB2" => "50",
        "ecuB2" => "10",
    ],
    [
        "rowName" => "row_6",
        "probA1" => "60",
        "ecuA1" => "200",
        "probA2" => "40",
        "ecuA2" => "160",
        "probB1" => "60",
        "ecuB1" => "385",
        "probB2" => "40",
        "ecuB2" => "10",
    ],
    [
        "rowName" => "row_7",
        "probA1" => "70",
        "ecuA1" => "200",
        "probA2" => "30",
        "ecuA2" => "160",
        "probB1" => "70",
        "ecuB1" => "385",
        "probB2" => "30",
        "ecuB2" => "10",
    ],
    [
        "rowName" => "row_8",
        "probA1" => "80",
        "ecuA1" => "200",
        "probA2" => "20",
        "ecuA2" => "160",
        "probB1" => "80",
        "ecuB1" => "385",
        "probB2" => "20",
        "ecuB2" => "10",
    ],
    [
        "rowName" => "row_9",
        "probA1" => "90",
        "ecuA1" => "200",
        "probA2" => "10",
        "ecuA2" => "160",
        "probB1" => "90",
        "ecuB1" => "385",
        "probB2" => "10",
        "ecuB2" => "10",
    ],
    [
        "rowName" => "row_10",
        "probA1" => "100",
        "ecuA1" => "200",
        "probA2" => "0",
        "ecuA2" => "160",
        "probB1" => "100",
        "ecuB1" => "385",
        "probB2" => "0",
        "ecuB2" => "10",
    ],
];