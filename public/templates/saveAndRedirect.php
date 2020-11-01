<?php
 $postArray = $_POST;

require_once($_SERVER["DOCUMENT_ROOT"] . "/code/Database.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/code/QueryBuilder.php");

$db = new Database();

$riskQB = new QueryBuilder( 'risk_aversion');

$page = postParamValue('page');
$condition = postParamValue('condition');
$subjectName = postParamValue('subject');



 $results = [
     $postArray['row_1'],
     $postArray['row_2'],
     $postArray['row_3'],
     $postArray['row_4'],
     $postArray['row_5'],
     $postArray['row_6'],
     $postArray['row_7'],
     $postArray['row_8'],
     $postArray['row_9'],
     $postArray['row_10']
 ];
 $rowNumber = 1;

foreach ($results as $result) {
    $riskQB->addString("r" . $rowNumber, $results[$rowNumber - 1]);
    $rowNumber += 1;
 }
$updateQuery = $riskQB->buildInsert("");
$insertID = $db->insertQuery($updateQuery);

if (!$insertID) {
    echo "Error!";
} else {
    $nextPage = intval($page) + 1;

    $host = $_SERVER['HTTP_HOST'];
    $url = $host . '/public/include/intro/index.php?condition=' . $condition . '&sname=' . $subjectName . '&page=' . $nextPage;

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, 0);

    curl_exec($ch);

    curl_close($ch);
}

