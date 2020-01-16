<?php
 $postArray = $_POST;

require_once($_SERVER['DOCUMENT_ROOT'] . '/resources/config.php');

if (!isset($connection)) {
    $connection = new mysqli(DB_Host, DB_User, DB_Password, DB_Name);
    echo "Reestablished connection";
}

$page = $postArray['page'];
 $condition = $postArray['condition'];
 $subjectName = $postArray['subject'];

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
    $query = $connection->prepare("INSERT INTO risk_aversion (subject_name, row, result) VALUES (?, ?, ?) ");
    $query->bind_param('sis', $subjectName, $rowNumber, $result);

    if ($query->execute()) {
        console_log("Inserted row $rowNumber for subject $subjectName with result $result!");
    }
    else {
        echo "Could not insertrow $rowNumber for subject $subjectName with result $result!";
    }

    $rowNumber += 1;

 }

$nextPage = intval($page) + 1;

$host = $_SERVER['HTTP_HOST'];
$url = $host . '/public/include/intro/index.php?condition=' . $condition . '&sname=' . $subjectName . '&page=' . $nextPage;

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HEADER, 0);

curl_exec($ch);

curl_close($ch);