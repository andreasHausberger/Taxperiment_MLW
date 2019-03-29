<?php
/**
 * Created by PhpStorm.
 * User: andreas
 * Date: 29.03.19
 * Time: 14:52
 */

include "../public/templates/header.php";
include "./config.php";

if (getenv("CLEARDB_DATABASE_URL") != null) {
    $url = parse_url(getenv("CLEARDB_DATABASE_URL"));

    $server = $url["host"];
    $username = $url["user"];
    $password = $url["pass"];
    $db = substr($url["path"], 1);

    $connection = new mysqli($server, $username, $password, $db);
} else {
    $connection = new mysqli("localhost",
        "root",
        "root",
        "mlweb");
}

$headerQuery = "SHOW columns FROM audit";
$resultQuery = "SELECT a.*, m.condnum FROM audit a JOIN mlweb m ON a.pid = m.subject";

$questionnaireHeaderQuery = "SHOW columns FROM questionnaire";
$questionnaireResultQuery = "SELECT * FROM questionnaire";

if (isset($connection)) {

    // get audit data
    $headerResult = $connection->query($headerQuery);
    if ($headerResult != null) {
        while ($row = $headerResult->fetch_assoc()) {
            $headers[] = $row["Field"];
        }
        $headers[] = "condnum";

    }


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

