<?php
/**
 * Created by PhpStorm.
 * User: andreas
 * Date: 10.12.18
 * Time: 16:58
 */

// echo "made it here";

$experimentID = -1;

if (isset($_GET['expid'])) {
    $experimentID = $_GET['expid'];
}
else {
    echo "No Experiment ID!";
    die();
}

require("../../../resources/config.php");
require("../../dataLoader.php");


parse_str($roundData, $expRounds);
parse_str($_POST['data'], $dataStuff);

$dataArray = $dataStuff['data'];

var_dump($dataArray);

global $expRounds, $dataArray;
$participant = $dataArray['pname'];
$participantID = $dataArray['pid'];
$condition = $dataArray['condition'];

if (isset($_POST['data']) && isset($_POST['roundData'])) {
    $data = $_POST['data'];
    $roundData = $_POST['roundData'];

    parse_str($roundData, $expRounds);
    parse_str($data, $dataArray);

    $participant = $dataArray['pname'];
    $condition = $dataArray['condition'];
    $experimentID = $_GET['expid'];
}


$round = (isset($_GET['round']) ? $_GET['round'] : -1);
$mode = (isset($_GET['mode']) ? $_GET['mode'] : 0); //mode: 1 is for slider and 2 is for audit
$mostRecentScore = (isset($_POST['score']) ? $_POST['score'] : -1); // if we just had a slider round, there should be a most recent score posted


$round = (int) $round;
$mode = (int) $mode;
$mostRecentScore = (int) $mostRecentScore;

if ($round < 1 || $mode == 0) {
    echo "There is a problem.";
}

elseif ($round <= 18) {
    $pages = array(
        -1 => "error.html",
        1 => "slider.php",
        2 => "audit.php" ,
    );

    $page = (string) $pages[$mode];

    require_once("../../templates/header.php");
    include ($page);
    require_once("../../templates/footer.php");
}
else {
    // redirect to end of experiment
    echo "Something went wrong. sorry.";
}
