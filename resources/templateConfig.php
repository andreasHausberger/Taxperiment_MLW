<?php
/**
 * Created by PhpStorm.
 * User: andreas
 * Date: 21.11.19
 * Time: 11:36
 */

$incomeLabel = "Einkommen";
$taxLabel = "Steuerrate";
$auditLabel = "Prüfwahrscheinlichkeit";
$fineLabel = "Strafe";
$sureGainLabel = "Sicherer Ausgang";
$evRiskyLabel = "EW: Hinterziehung";

$taxPercentage = doubleval($taxRate) * 100;
$auditPercentage = doubleval($auditProbability) * 100;
$taxDue = intVal($income) * doubleval($taxRate);
$fine = $taxDue * $fineRate;

$incomeContent = "$income ECU";
$taxContent = "$taxPercentage%";
$auditContent = "$auditPercentage%";
$fineContent = "$fine ECU";
$evRiskyContent = "$evEvasion ECU";
$sureGainContent = "$sureGain ECU";

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
        "label" => "$incomeLabel^$taxLabel`$auditLabel^$fineLabel`$sureGainLabel^$evRiskyLabel",
        "content" => "$incomeContent^$taxContent`$auditContent^$fineContent`$sureGainContent^$evRiskyContent"),
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
        "label" => "$fineLabel^$auditLabel`$taxLabel^$incomeLabel`$evRiskyLabel^$sureGainLabel",
        "content" => "$fineContent^$auditContent`$taxContent^$incomeContent`$evRiskyContent^$sureGainContent"),
    8 => array(
        "label" => "$taxLabel^$incomeLabel`$fineLabel^$auditLabel`$sureGainLabel^$evRiskyLabel",
        "content" => "$taxContent^$incomeContent`$fineContent^$auditContent`$sureGainContent^$evRiskyContent"),
);

$currentBox = $mouselabBoxArray[$condition];

$mlwFieldArray = [$incomeBox, $taxRateBox, $fineRateBox, $auditProbabilityBox];

$mlwFields = getRandomizedMLWFields([$incomeBox, $taxRateBox], [$fineRateBox, $auditProbabilityBox]);

function getRandomizedMLWFields($paraRow1, $paraRow2)
{
//    shuffle($paraRow1);
    shuffle($paraRow2);

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