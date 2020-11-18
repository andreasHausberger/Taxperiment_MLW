<?php
/**
 * Created by PhpStorm.
 * User: andreas
 * Date: 29.03.19
 * Time: 14:52
 */

include "../public/templates/header.php";
include "./config.php";
require_once "resources/code/code.php";

require_once($_SERVER["DOCUMENT_ROOT"] . "/code/Database.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/code/DatabaseHelper.php");

$dbHelper = new DatabaseHelper(new Database());

if (!isset($connection)) {
    $connection = new mysqli(DB_Host, DB_User, DB_Password, DB_Name);
}

$headerQuery = "SHOW columns FROM audit";
$resultQuery = "select 
                    p.id as person_id, 
                    p.name, 
                    e.id as experiment_id, 
                    e.start, 
                    e.finished_experiment, 
                    e.finished_questionnaire, 
                    a.round, 
                    a.actual_income, 
                    a.net_income,
                    a.actual_tax, 
                    a.declared_tax, 
                    a.honesty, 
                    a.audit, 
                    a.fine, 
                    a.selected  
                from 
                    participant p, 
                    audit a, 
                    experiment e 
                where 
                    a.pid = p.id and 
                    a.exp_id = e.id";

$questionnaireHeaderQuery = "SHOW columns FROM questionnaire";
$questionnaireResultQuery = "SELECT * FROM questionnaire where pid != 123";

if (isset($connection)) {

    $headers = array("participant_id", "participant_name", "experiment_id", "started", "finished_experiment", "finished_questionnaire", "experiment_round", "actual_income", "net_income", "actual_tax", "declared_tax", "honesty", "audit", "fine", "selected");


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


    $expRoundQuery = "
                    SELECT
                        ero.id,
                        ero.exp_id as experiment_id,
                        ero.round_order,
                        ero.condition_order
                    FROM
                        exp_round_order ero
    ";
    $expRoundHeadersQuery = "SHOW columns FROM exp_round_order";

    $expRoundsFilename = "./tmp/expRounds.csv";

    $dbHelper->createCSV("risk_aversion", "risk_aversion", "Risk Aversion");
    $dbHelper->createCSV("exp_round", "exp_round", "Experiment Round Data");

    $expRoundDataQuery = " SELECT 
	        ero.id,
	        ero.exp_id,
	exp.participant AS participant_id,
	ero.round_order,
	ero.condition_order
FROM 
	exp_round_order ero
	LEFT JOIN experiment exp ON ero.exp_id = exp.id";

    $dbHelper->createCustomCSV($expRoundDataQuery, "exp_round_order", ["ID", "Experiment ID", "Participant ID", "Round Order", "Condition Order"], "Exp. Round Order");
    $dbHelper->createCSV("participant", "participant", "Participant");
    $dbHelper->createCSV("comprehension", "comprehension", "Comprehension Task");

}
else {
    echo "ERROR: Could not establish DB connection!";
}

