<?php
/**
 * Created by PhpStorm.
 * User: andreas
 * Date: 29.03.19
 * Time: 14:52
 */

include "../public/templates/header.php";
include "./config.php";

if (!isset($connection)) {
    $connection = new mysqli(DB_Host, DB_User, DB_Password, DB_Name);
}

$headerQuery = "SHOW columns FROM audit";
$resultQuery = "select p.id as person_id, p.name, e.id as experiment_id, e.start, e.finished_experiment, e.finished_questionnaire, a.round, a.actual_income, a.net_income, a.actual_tax, a.declared_tax, a.honesty, a.audit, a.fine, a.selected  from participant p, audit a, experiment e where a.pid = p.id and a.exp_id = e.id";

$questionnaireHeaderQuery = "SHOW columns FROM questionnaire";
$questionnaireResultQuery = "SELECT * FROM questionnaire where pid != 123";

if (isset($connection)) {

    $headers = array("participant_id", "participant_id", "experiment_id", "started", "finished_experiment", "finished_questionnaire", "experiment_round", "actual_income", "net_income", "actual_tax", "declared_tax", "honesty", "audit", "fine", "selected");


    $auditResult = $connection->query($resultQuery);

    if ($auditResult != null) {
        while ($row = $auditResult->fetch_row()) {
            $resultRows[] = $row;
        }
    }

    $dataString = "";

    $dataString = implode(",", $headers);

    foreach ($resultRows as $resultRow) {
        $rowString = " \n " . implode(",", $resultRow);
        $dataString .= $rowString;
    }

    $filename = './tmp/audit.csv';

    if (!$handle = fopen($filename, 'w+')) {
        die("Cannot open file ($filename)");

    }

    if (!fwrite($handle, $dataString)) {
        die("Cannot write to file ($filename)");
        exit;
    }

    fclose($handle);

    echo "<p> Download Audit data: </p> <a href='./tmp/audit.csv'>audit.csv</a>";


    // get questionnaire data

    $questionnaireHeaderResult = $connection->query($questionnaireHeaderQuery);
    if ($questionnaireHeaderResult != null) {
        while ($qRow = $questionnaireHeaderResult->fetch_assoc()) {
            $qHeaders[] = $qRow["Field"];
        }
    }

    $questionnaireResult = $connection->query($questionnaireResultQuery);

    if ($questionnaireResult != null) {
        while ($qr = $questionnaireResult->fetch_row()) {
            $qResultRows[] = $qr;
        }
    }

    $qDataString = implode(",", $qHeaders);

    foreach ($qResultRows as $qresultRow) {
        $qRowString = " \n " . implode(",", $qresultRow);
        $qDataString .= $qRowString;
    }


    $filename = './tmp/questionnaire.csv';

    if (!$handle = fopen($filename, 'w+')) {
        die("Cannot open file ($filename)");

    }

    if (!fwrite($handle, $qDataString)) {
        die("Cannot write to file ($filename)");
        exit;
    }

    fclose($handle);

    echo "<p> Download Questionnaire data: </p> <a href='./tmp/questionnaire.csv'>questionnaire.csv</a>";




}
else {
    echo "ERROR: Could not establish DB connection!";
}

