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

$incomeContent = "$income ECU";
$taxContent = "Tax($taxPercentage%): $taxDue ECU";
$auditContent = "$auditPercentage% chance";
$fineContent = "Payback + " . $fineRate . "00%";
$evRiskyContent = "EV Risky: " . $evEvasion;
$sureGainContent = "Sure Gain: " . $sureGain;



$mouselabBoxArray = array(
    1 => array(
        "label" =>"$incomeLabel^$taxLabel`$auditLabel^$fineLabel`$sureGainLabel^$evRiskyLabel",
        "content" => "$incomeContent^$taxContent`$auditContent^$fineContent`$sureGainContent^$evRiskyContent"),
    2 => array(
        "label" =>"$incomeLabel^$taxLabel`$auditLabel^$fineLabel`$sureGainLabel^$evRiskyLabel",
        "content" => "$incomeContent^$taxContent`$auditContent^$fineContent`$sureGainContent^$evRiskyContent"),
    3 => array(
        "label" =>"$taxLabel^$incomeLabel`$fineLabel^$auditLabel",
        "content" => "$taxContent^$incomeContent`$fineContent^$auditContent"),
    4 => array(
        "label" =>"$fineLabel^$auditLabel`$taxLabel^$incomeLabel`$sureGainLabel^$evRiskyLabel",
        "content" => "$fineContent^$auditContent`$taxContent^$incomeContent`$sureGainContent^$evRiskyContent"),


    5 => array(
        "label" =>"$auditLabel^$fineLabel`$incomeLabel^$taxLabel`$sureGainLabel^$evRiskyLabel",
        "content" => "$auditContent^$fineContent`$incomeContent^$taxContent`$sureGainContent^$evRiskyContent"),
    6 => array(
        "label" =>"$incomeLabel^$taxLabel`$auditLabel^$fineLabel`$sureGainLabel^$evRiskyLabel",
        "content" => "$incomeContent^$taxContent`$auditContent^$fineContent`$sureGainContent^$evRiskyContent"),
    7 => array(
        "label" =>"$fineLabel^$auditLabel`$taxLabel^$incomeLabel`$evRiskyLabel^$sureGainLabel",
        "content" => "$fineContent^$auditContent`$taxContent^$incomeContent`$evRiskyContent^$sureGainContent"),
    8 => array(
        "label" =>"$taxLabel^$incomeLabel`$fineLabel^$auditLabel`$sureGainLabel^$evRiskyLabel",
        "content" => "$taxContent^$incomeContent`$fineContent^$auditContent`$sureGainContent^$evRiskyContent"),
);

$currentBox = $mouselabBoxArray[$condition];